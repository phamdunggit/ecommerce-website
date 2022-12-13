$(document).ready(function() {

    loadcart();
    loadwishlist()
    function loadcart(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method:"GET",
            url: "/load-cart-data",
            success: function (response) {
                $(".cart-count").html(response.count);
    
                // console.log(response.count);
            }
        });
    }
    function loadwishlist(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method:"GET",
            url: "/load-wishlist-data",
            success: function (response) {
                $(".wishlist-count").html(response.count);
                // console.log(response.count);
            }
        });
    }


    $(document).on('click','.increment-btn', function (e) {
        e.preventDefault();
        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 999) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    $('.addToCartBtn').click(function(e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function(response) {
                loadcart();
                console.log(response);
                // swal("",response.status);
            }
        });

    });
    $(document).on('click','.decrement-btn', function (e) {
        e.preventDefault();
        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    // $('.delete-cart-item').click(function (e) { 
    $(document).on('click','.delete-cart-item', function (e) {

        
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/delete-cart-item",
            data: {
                'prod_id':product_id,
            },

            success: function (response) {
                // window.location.reload();
                
                $('.cart-items').load(location.href+" .cart-items");
                loadcart();
                swal("",response.status,"success");
            }
        });
    });

    $(document).on('click','.remove-item-wishlist', function (e) {
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/delete-wishlist-item",
            data: {
                'prod_id':product_id,
            },

            success: function (response) {
                // window.location.reload();
                loadwishlist();
                $('.wishlist-items').load(location.href+" .wishlist-items");
                swal("",response.status,"success");
            }
        });
    });
    $(document).on('click','.changeQuantity', function (e) {
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var prod_qty=$(this).closest('.product_data').find('.qty-input').val();
        data={
            'prod_id':product_id,
            'prod_qty':prod_qty,
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/update-cart",
            data: data,
            success: function (response) {
                $('.cart-items').load(location.href+" .cart-items");
                // window.location.reload();
                
            }
        });
    });
    $('.addToWishlist').click(function(e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/add-to-wishlist",
            data: {
                'product_id': product_id,
            },
            success: function(response) {
                loadwishlist();
                swal("",response.status,"success");
            }
        });

    });
    $.fn.digits = function(){ 
        return this.each(function(){ 
            $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
        })
    }
    $(".price").digits();
});
