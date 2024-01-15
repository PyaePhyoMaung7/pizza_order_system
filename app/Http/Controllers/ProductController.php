<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ProductController;

class ProductController extends Controller
{
    //direct product list page
    public function list(){
        $pizzas = Product::select('products.id','image','products.name','price','view_count','c.name as category')->when(request('searchKey'),function($query){
            $query->where('products.name','like','%'.request('searchKey').'%');
        })
        ->leftJoin('categories as c','products.category_id','c.id')
        ->orderBy('products.created_at','desc')
        ->paginate(3);



        $pizzas->appends(request()->all());
        return view('admin.products.pizzaList',compact("pizzas"));
    }

    //direct product create page
    public function createPage(){
        $categories = Category::all('id','name');
        return view('admin.products.create',compact('categories'));
    }

    //create product
    public function create(Request $request){
        $this->productValidationCheck($request, 'create');
        $data = $this->requestProductInfo($request);

        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;


        Product::create($data);
        return redirect()->route('product#list');
    }

    //delete product
    public function delete($id){
        $dbImage = Product::where('id',$id)->first()->image;
        Storage::delete('public/'.$dbImage);

        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product deleted successfully!']);
    }

    //show product
    public function show($id){
        $pizza = Product::select('products.*','c.name as category')
        ->where('products.id',$id)
        ->leftJoin('categories as c','products.category_id','c.id')
        ->first();
        return view('admin.products.show',compact('pizza'));
    }

    //edit product
    public function editPage($id){
        $pizza = Product::where('id',$id)->first();
        $categories = Category::all('id','name');
        return view('admin.products.edit',compact('pizza','categories'));
    }

    //update product
    public function update(Request $request){
        $this->productValidationCheck($request, 'update');
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){

            $oldImage = Product::where('id',$request->pizzaId)->first()->image;
            Storage::delete('public/'.$oldImage);

            $newImageName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$newImageName);

            $data['image'] = $newImageName;
        }

        Product::where('id',$request->pizzaId)->update($data);

        return redirect()->route('product#list',$request->pizzaId)->with(['updateSuccess'=>'Product updated successfully!']);


    }

    //product validation check
    private function productValidationCheck($request, $action){
        $validationRules = [
            'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            // 'pizzaImage'=>['required'.$request->pizzaId,'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'pizzaPrice'=>'required',
            'pizzaWaitingTime'=>'required',
        ];

        $validationRules['pizzaImage'] = $action == 'create'? ['required','mimes:jpg,jpeg,png,webp', 'max:2048']:['mimes:jpg,jpeg,png,webp', 'max:2048'];

        Validator::make($request->all(),$validationRules)->validate();
    }

    //make product data into array
    private function requestProductInfo($request){
        return [
            'category_id'=>$request->pizzaCategory,
            'name'=>$request->pizzaName,
            'description'=>$request->pizzaDescription,
            'price'=>$request->pizzaPrice,
            'waiting_time'=>$request->pizzaWaitingTime,

        ];
    }
}
