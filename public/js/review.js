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