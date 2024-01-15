$(document).ready(function(){

    //when plus button is clicked
    $('.btn-plus').click(function(){
        let $parentNode = $(this).parents('tr');
        let $price = Number($parentNode.find('#pizza_price').html().replace('kyats',''));
        let $quantity = Number($parentNode.find('#qty').val()) ;
        let $total = $parentNode.find('#total').html($price * $quantity + ' kyats');

        summaryCalculation();


    })

    //when minus button is clicked
    $('.btn-minus').click(function(){
        let $parentNode = $(this).parents('tr');
        let $price = Number($parentNode.find('#pizza_price').html().replace('kyats',''));
        let $quantity = Number($parentNode.find('#qty').val());

        let $total = $parentNode.find('#total').html($price * $quantity + ' kyats');

        summaryCalculation();


    })

    function summaryCalculation(){
        let $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index, row){
            $totalPrice += Number($(row).find('#total').text().replace('kyats',''));
        });

        $('#subTotal').html($totalPrice+' kyats');

        if($totalPrice == 0){
            $('#deliveryFees').html('0 kyats');
            $('#finalPrice').html('0');
            $('#orderBtn, #clearBtn').attr('disabled',true);
        }else{
            $('#deliveryFees').html('3000 kyats');
            $('#finalPrice').html($totalPrice+3000);
            $('#orderBtn, #clearBtn').attr('disabled',false);
        }


    }



});
