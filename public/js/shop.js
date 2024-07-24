$(document).ready(function() {
    $('.addToCartBtn').click(function() {
        var itemId = $(this).data('id');
        var userId = $('#userId').val();
        var quantity = $(this).siblings('.quantityInput').val();

        $.ajax({
            type: 'POST',
            url: '/api/cart/add',
            data: {
                item_id: itemId,
                user_id: userId,
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.success);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Error adding item to cart: ' + xhr.responseText);
            }
        });
    });
});