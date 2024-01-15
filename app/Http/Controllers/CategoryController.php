<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    //direct category list page
    public function listPage(){
        $categories = Category::when(request('searchKey'),function($query){
            $query->where('name','like','%'.request('searchKey').'%')
                ->orWhere('created_at','like','%'.request('searchKey').'%');
        })
        ->orderBy('id','desc')
        ->paginate(3);

        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //direct category create page
    public function createPage(){
        return view('admin.category.create');
    }

    //create new category
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->transformCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted!']);
    }

    //edit category
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update category
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->transformCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess'=>'Category Updated']);
    }

    //check category validation
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => ['required','min:4','unique:categories,name,'.$request->categoryId],
        ])->validate();
    }


    //change category array
    private function transformCategoryData($request){
        return [
            'name' => $request->categoryName,
        ];
    }


}
