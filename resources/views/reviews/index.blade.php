<!DOCTYPE html>
<html>
<head>
    <title>Reviews</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <button class="btn-back" onclick="window.history.back()">Back</button>
        <h2 class="mb-4">Reviews</h2>
        <button class="btn btn-primary mb-3" id="addReviewBtn" data-toggle="modal" data-target="#reviewModal">Add Review</button>
        <table class="table table-bordered" id="reviewsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Checkout</th>
                    <th>User</th>
                    <th>Description</th>
                    <th>Rating</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Add/Edit Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm">
                        @csrf
                        <input type="hidden" id="reviewId">
                        <div class="form-group">
                            <label for="checkout_id">Checkout:</label>
                            <select class="form-control" id="checkout_id" name="checkout_id" required>
                                @foreach($checkouts as $checkout)
                                    <option value="{{ $checkout->checkout_id }}">{{ $checkout->checkout_id }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="checkoutIdError"></div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                            <div class="invalid-feedback" id="descriptionError"></div>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                            <div class="invalid-feedback" id="ratingError"></div>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            <div class="invalid-feedback" id="photoError"></div>
                        </div>
                        <button type="button" id="saveBtn" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#reviewsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('reviews.index') }}",
                columns: [
                    {data: 'review_id', name: 'review_id'},
                    {data: 'checkout_id', name: 'checkout.checkout_id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'description', name: 'description'},
                    {data: 'rating', name: 'rating'},
                    {data: 'photo', name: 'photo'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $('#reviewModal').on('hidden.bs.modal', function () {
                $('#reviewForm')[0].reset();
                $('#checkout_id').removeClass('is-invalid');
                $('#description').removeClass('is-invalid');
                $('#rating').removeClass('is-invalid');
                $('#photo').removeClass('is-invalid');
                $('#checkoutIdError').text('');
                $('#descriptionError').text('');
                $('#ratingError').text('');
                $('#photoError').text('');
            });

            $('#reviewForm').validate({
                rules: {
                    checkout_id: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    rating: {
                        required: true,
                        min: 1,
                        max: 5
                    },
                    photo: {
                        extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    checkout_id: {
                        required: "Please select a checkout."
                    },
                    description: {
                        required: "Please enter a description."
                    },
                    rating: {
                        required: "Please enter a rating.",
                        min: "Rating must be at least 1.",
                        max: "Rating must be no more than 5."
                    },
                    photo: {
                        extension: "Please upload a valid image file (jpg, jpeg, png, gif)."
                    }
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    var name = element.attr('name');
                    error.appendTo($('#' + name + 'Error'));
                    element.addClass('is-invalid');
                },
                success: function(label, element) {
                    $(element).removeClass('is-invalid');
                    label.remove();
                }
            });

            $('#saveBtn').click(function() {
                if ($('#reviewForm').valid()) {
                    var formData = new FormData($('#reviewForm')[0]);
                    var reviewId = $('#reviewId').val();
                    var url = reviewId ? "{{ url('reviews') }}/" + reviewId : "{{ url('reviews') }}";
                    var method = reviewId ? 'PUT' : 'POST';

                    $.ajax({
                        url: url,
                        method: method,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            table.ajax.reload();
                            $('#reviewModal').modal('hide');
                        },
                        error: function(response) {
                            var errors = response.responseJSON.errors;
                            if (errors) {
                                if (errors.checkout_id) {
                                    $('#checkout_id').addClass('is-invalid');
                                    $('#checkoutIdError').text(errors.checkout_id[0]);
                                }
                                if (errors.description) {
                                    $('#description').addClass('is-invalid');
                                    $('#descriptionError').text(errors.description[0]);
                                }
                                if (errors.rating) {
                                    $('#rating').addClass('is-invalid');
                                    $('#ratingError').text(errors.rating[0]);
                                }
                                if (errors.photo) {
                                    $('#photo').addClass('is-invalid');
                                    $('#photoError').text(errors.photo[0]);
                                }
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.editbtn', function() {
                var reviewId = $(this).data('id');
                $.get("{{ url('reviews') }}/" + reviewId + "/edit", function(data) {
                    $('#reviewId').val(data.review_id);
                    $('#checkout_id').val(data.checkout_id);
                    $('#description').val(data.description);
                    $('#rating').val(data.rating);
                    $('#photo').val(''); 
                    $('#reviewModal').modal('show');
                });
            });

            $(document).on('click', '.deletebtn', function() {
                var reviewId = $(this).data('id');
                if (confirm("Are you sure you want to delete this review?")) {
                    $.ajax({
                        url: "{{ url('reviews') }}/" + reviewId,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            table.ajax.reload();
                        }
                    });
                }
            });

            $('#addReviewBtn').click(function() {
                $('#reviewModalLabel').text('Add Review');
                $('#reviewForm')[0].reset();
                $('#reviewId').val('');
                $('#reviewModal').modal('show');
            });
        });
    </script>
</body>
</html>
