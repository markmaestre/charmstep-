<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.css">
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
    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#importModal">Import Wishlist Items</button>
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
            <!-- Data will be populated here by JavaScript -->
        </tbody>
    </table>
    <div id="pagination" class="text-center"></div>
</div>

<!-- Modal for Adding/Editing Wishlist Item -->
<div class="modal fade" id="wishlistModal" tabindex="-1" role="dialog" aria-labelledby="wishlistModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wishlistModalLabel">Wishlist Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="wform">
                    <input type="hidden" id="wishlistId" name="wishlist_id">
                    <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="size">Size</label>
                        <input type="text" class="form-control" id="size" name="size" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        <div id="imagePreview"></div>
                    </div>
                    <button type="button" id="wishlistSubmit" class="btn btn-primary">Submit</button>
                    <button type="button" id="wishlistUpdate" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Importing Excel -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Wishlists from Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="importForm" method="POST" enctype="multipart/form-data" action="{{ route('wishlists.importExcel') }}">
                    @csrf
                    <div class="form-group">
                        <label for="file">Excel File</label>
                        <input type="file" class="form-control-file" id="file" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    const ITEMS_PER_PAGE = 5;
    let currentPage = 1;

    function loadWishlists(page = 1) {
        $.ajax({
            type: "GET",
            url: "/api/wishlists",
            dataType: 'json',
            success: function (data) {
                let wishlists = data.filter(item => item.user_id === {{ Auth::user()->id }});
                displayWishlists(wishlists, page);
                setupPagination(wishlists.length, page);
            },
            error: function (xhr, status, error) {
                console.error('Error loading wishlist data:', error);
                alert("Error loading wishlist data.");
            }
        });
    }

    function displayWishlists(wishlists, page) {
        $("#wishlistTable tbody").empty();
        let start = (page - 1) * ITEMS_PER_PAGE;
        let end = start + ITEMS_PER_PAGE;
        wishlists.slice(start, end).forEach(item => {
            let img = item.image ? `<img src='/storage/${item.image.replace('public/', '')}' width='200px' height='200px' />` : "";
            let tr = $("<tr>");
            tr.append($("<td>").html(item.wishlist_id));
            tr.append($("<td>").html(item.brand_name));
            tr.append($("<td>").html(item.size));
            tr.append($("<td>").html(img));
            tr.append(`<td align='center'><a href='#' data-toggle='modal' data-target='#wishlistModal' class='editbtn' data-id='${item.wishlist_id}'><i class='fas fa-edit' aria-hidden='true' style='font-size:24px; color:blue'></i></a></td>`);
            tr.append(`<td><a href='#' class='deletebtn' data-id='${item.wishlist_id}'><i class='fa fa-trash' style='font-size:24px; color:red'></i></a></td>`);
            $("#wishlistTable tbody").append(tr);
        });
    }

    function setupPagination(totalItems, page) {
        let totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);
        $("#pagination").empty();
        for (let i = 1; i <= totalPages; i++) {
            let button = $(`<button class='btn btn-${i === page ? 'primary' : 'secondary'}'>${i}</button>`);
            button.click(() => {
                currentPage = i;
                loadWishlists(i);
            });
            $("#pagination").append(button);
        }
    }

    function clearForm() {
        $("#wform")[0].reset();
        $("#wishlistId").val('');
        $("#imagePreview").html('');
        $("#wishlistSubmit").show();
        $("#wishlistUpdate").hide();
    }

    $("#wishlistSubmit").click(function () {
        let formData = new FormData($("#wform")[0]);
        $.ajax({
            type: "POST",
            url: "/api/wishlists",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                alert(response.success);
                loadWishlists(currentPage);
                clearForm();
                $("#wishlistModal").modal('hide');
            },
            error: function (xhr, status, error) {
                console.error('Error submitting wishlist form:', error);
                alert("Error submitting wishlist item.");
            }
        });
    });

    $(document).on('click', '.editbtn', function () {
        let id = $(this).data('id');
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
                $("#wishlistSubmit").hide();
                $("#wishlistUpdate").show();
            },
            error: function (xhr, status, error) {
                console.error('Error fetching wishlist item:', error);
                alert("Error fetching wishlist item.");
            }
        });
    });

    $("#wishlistUpdate").click(function () {
        let id = $("#wishlistId").val();
        let formData = new FormData($("#wform")[0]);
        $.ajax({
            type: "PUT",
            url: `/api/wishlists/${id}`,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                alert(response.success);
                loadWishlists(currentPage);
                clearForm();
                $("#wishlistModal").modal('hide');
            },
            error: function (xhr, status, error) {
                console.error('Error updating wishlist item:', error);
                alert("Error updating wishlist item.");
            }
        });
    });

    $(document).on('click', '.deletebtn', function () {
        if (confirm('Are you sure you want to delete this item?')) {
            let id = $(this).data('id');
            $.ajax({
                type: "DELETE",
                url: `/api/wishlists/${id}`,
                success: function (response) {
                    alert(response.success);
                    loadWishlists(currentPage);
                },
                error: function (xhr, status, error) {
                    console.error('Error deleting wishlist item:', error);
                    alert("Error deleting wishlist item.");
                }
            });
        }
    });

    $("#importForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
                alert(response.success);
                loadWishlists(currentPage);
                $("#importModal").modal('hide');
            },
            error: function (xhr, status, error) {
                console.error('Error importing Excel file:', error);
                alert("Error importing Excel file.");
            }
        });
    });

    loadWishlists();
});
</script>
</body>
</html>
