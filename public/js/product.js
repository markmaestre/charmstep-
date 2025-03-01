$(document).ready(function () {
    var table = $('#itemTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/items',
            dataSrc: ''
        },
        columns: [
            { data: 'item_id' },
            { data: 'product_name' },
            { data: 'description' },
            { data: 'quantity' },
            { data: 'size' },
            { data: 'price' },
            {
                data: 'image',
                render: function (data) {
                    if (data) {
                        return '<img src="/storage/' + data + '" width="50" alt="Product Image">';
                    } else {
                        return 'No Image';
                    }
                }
            },
            {
                data: 'item_id',
                render: function (data) {
                    return '<a href="#" class="editbtn" data-toggle="modal" data-target="#itemModal" data-id="' + data + '"><i class="fas fa-edit" aria-hidden="true" style="font-size:24px; color:blue"></i></a>';
                }
            },
            {
                data: 'item_id',
                render: function (data) {
                    return '<a href="#" class="deletebtn" data-id="' + data + '"><i class="fa fa-trash" style="font-size:24px; color:red"></i></a>';
                }
            }
        ]
    });

    $('#itemModal').on('show.bs.modal', function (e) {
        $('#form').trigger('reset');
        $('#itemId').val(''); 

        var id = $(e.relatedTarget).data('id');
        if (id) {
            $('#itemId').val(id); 

            $.ajax({
                type: 'GET',
                url: '/api/items/' + id,
                dataType: 'json',
                success: function (data) {
                    $('#product_name').val(data.product_name);
                    $('#description').val(data.description);
                    $('#quantity').val(data.quantity);
                    $('#size').val(data.size);
                    $('#price').val(data.price);

                    if (data.image) {
                        $('#imagePreview').attr('src', '/storage/' + data.image);
                    } else {
                        $('#imagePreview').attr('src', '/storage/images/no-image.jpg');
                    }
                },
                error: function () {
                    console.log('Error fetching item data');
                    alert('Error fetching item data.');
                }
            });
        } else {
            $('#imagePreview').attr('src', '/storage/images/no-image.jpg');
        }
    });

    $('#form').validate({
        rules: {
            product_name: "required",
            quantity: {
                required: true,
                number: true
            },
            price: {
                required: true,
                number: true
            }
        },
        messages: {
            product_name: "Please enter the product name",
            quantity: {
                required: "Please enter the quantity",
                number: "Please enter a valid number"
            },
            price: {
                required: "Please enter the price",
                number: "Please enter a valid number"
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            var id = $('#itemId').val();
            var type = id ? 'PUT' : 'POST';
            var url = id ? '/api/items/' + id : '/api/items';

            $.ajax({
                type: type,
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data) {
                    alert(data.success);
                    $('#itemModal').modal('hide');
                    table.ajax.reload();
                },
                error: function (xhr) {
                    console.log('Error saving item. Please check the console for more details.');
                    console.error(xhr.responseText);
                    alert('Error saving item: ' + xhr.responseText);
                }
            });
        }
    });

    $(document).on('click', '.deletebtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                type: 'DELETE',
                url: '/api/items/' + id,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data) {
                    alert('Item deleted successfully.');
                    table.ajax.reload();
                },
                error: function (xhr) {
                    console.log('Error deleting item. Please check the console for more details.');
                    console.error(xhr.responseText);
                    alert('Error deleting item: ' + xhr.responseText);
                }
            });
        }
    });
});
