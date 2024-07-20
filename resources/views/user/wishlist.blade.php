<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .modal-body img {
            display: block;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Wishlist</h2>
    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#wishlistModal">Add Wishlist Item</button>
    <table class="table table-bordered" id="wishlistTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand Name</th>
                <th>Size</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dynamic content will be loaded here -->
        </tbody>
    </table>
</div>

<!-- Wishlist Modal -->
<div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="wishlistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wishlistModalLabel">Wishlist Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="wform">
                <div class="modal-body">
                    <input type="hidden" id="wishlistId" name="wishlist_id">
                    <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" required>
                    </div>
                    <div class="form-group">
                        <label for="size">Size</label>
                        <input type="text" class="form-control" id="size" name="size" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div id="imagePreview"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="wishlistSubmit">Save</button>
                    <button type="button" class="btn btn-primary" id="wishlistUpdate">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $("#wishlistUpdate").hide();

   
        $.ajax({
            type: "GET",
            url: "/api/wishlists",
            dataType: 'json',
            success: function (data) {
                $.each(data, function (key, value) {
                    if (value.user_id === {{ Auth::user()->id }}) {  // Only display wishlists of the logged-in user
                        var img = value.image ? "<img src='/storage/" + value.image.replace('public/', '') + "' width='200px' height='200px' />" : "";
                        var tr = $("<tr>");
                        tr.append($("<td>").html(value.wishlist_id));
                        tr.append($("<td>").html(value.brand_name));
                        tr.append($("<td>").html(value.size));
                        tr.append($("<td>").html(img));
                        tr.append("<td align='center'><a href='#' data-toggle='modal' data-target='#wishlistModal' id='editbtn' data-id=" + value.wishlist_id + "><i class='fas fa-edit' aria-hidden='true' style='font-size:24px; color:blue'></i></a></td>");
                        tr.append("<td><a href='#' class='deletebtn' data-id=" + value.wishlist_id + "><i class='fa fa-trash' style='font-size:24px; color:red'></a></i></td>");
                        $("#wishlistTable tbody").append(tr);
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error('Error loading wishlist data:', error);
                console.log(xhr.responseText);
                alert("Error loading wishlist data.");
            }
        });


        $("#wishlistSubmit").on('click', function (e) {
            e.preventDefault();
            var data = $('#wform')[0];
            let formData = new FormData(data);
            $.ajax({
                type: "POST",
                url: "/api/wishlists",
                data: formData,
                contentType: false,
                processData: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function (data) {
                    $("#wishlistModal").modal("hide");
                    var img = data.wishlist.image ? "<img src='/storage/" + data.wishlist.image.replace('public/', '') + "' width='200px' height='200px' />" : "";
                    var tr = $("<tr>");
                    tr.append($("<td>").html(data.wishlist.wishlist_id));
                    tr.append($("<td>").html(data.wishlist.brand_name));
                    tr.append($("<td>").html(data.wishlist.size));
                    tr.append($("<td>").html(img));
                    tr.append("<td align='center'><a href='#' data-toggle='modal' data-target='#wishlistModal' id='editbtn' data-id=" + data.wishlist.wishlist_id + "><i class='fas fa-edit' aria-hidden='true' style='font-size:24px; color:blue'></i></a></td>");
                    tr.append("<td><a href='#' class='deletebtn' data-id=" + data.wishlist.wishlist_id + "><i class='fa fa-trash' style='font-size:24px; color:red'></i></a></td>");
                    $("#wishlistTable tbody").prepend(tr);
                },
                error: function (error) {
                    alert("Error creating wishlist item.");
                }
            });
        });

        // Load wishlist item into modal for editing
        $('#wishlistModal').on('show.bs.modal', function (e) {
            $("#wishlistSubmit").show();
            $("#wishlistUpdate").hide();
            $("#wform").trigger("reset");
            $('#wishlistId').remove();
            $('#imagePreview').html('');
            var id = $(e.relatedTarget).data('id');
            if (id) {
                $("#wishlistSubmit").hide();
                $("#wishlistUpdate").show();
                $('<input>').attr({ type: 'hidden', id: 'wishlistId', name: 'wishlist_id', value: id }).appendTo('#wform');
                $.ajax({
                    type: "GET",
                    url: `/api/wishlists/${id}`,
                    success: function (data) {
                        $("#wishlistId").val(data.wishlist_id);
                        $("#brand_name").val(data.brand_name);
                        $("#size").val(data.size);
                        if (data.image) {
                            $("#imagePreview").html(`<img src='/storage/${data.image.replace('public/', '')}' width='200px' height='200px' />`);
                        }
                    },
                    error: function () {
                        alert("Error loading wishlist item data.");
                    }
                });
            }
        });

        // Update wishlist item
        $("#wishlistUpdate").on('click', function (e) {
            e.preventDefault();
            var id = $('#wishlistId').val();
            var $row = $('tr td > a[data-id="' + id + '"]').closest('tr');
            let formData = new FormData($('#wform')[0]);
            formData.append('_method', 'PUT');
            $.ajax({
                type: "POST",
                url: `/api/wishlists/${id}`,
                data: formData,
                contentType: false,
                processData: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function (data) {
                    $("#wishlistModal").modal("hide");
                    var img = data.wishlist.image ? "<img src='/storage/" + data.wishlist.image.replace('public/', '') + "' width='200px' height='200px' />" : "";
                    $row.find('td:eq(0)').html(data.wishlist.wishlist_id);
                    $row.find('td:eq(1)').html(data.wishlist.brand_name);
                    $row.find('td:eq(2)').html(data.wishlist.size);
                    $row.find('td:eq(3)').html(img);
                },
                error: function () {
                    alert("Error updating wishlist item.");
                }
            });
        });

        // Delete wishlist item
        $(document).on("click", ".deletebtn", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            var $row = $(this).closest("tr");
            $.ajax({
                type: "DELETE",
                url: `/api/wishlists/${id}`,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function () {
                    $row.remove();
                },
                error: function () {
                    alert("Error deleting wishlist item.");
                }
            });
        });
    });
</script>

</body>
</html>
