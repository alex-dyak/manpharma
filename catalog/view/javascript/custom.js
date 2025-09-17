$(document).ready(function (){
    $('.js-add-to-cart').click(function (){
        $.ajax({
            url: '/metric/ajax.php',
            method: 'post',
            data: {key: 'add-cart'},
            success: function(data){
                console.log(data)
            }
        });
    })
})