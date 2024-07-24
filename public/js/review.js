$(document).ready(function () {
    const ITEMS_PER_PAGE = 5;
    let currentPage = 1;

    function loadReviews(page = 1) {
        $.ajax({
            type: "GET",
            url: "/api/reviews",
            dataType: 'json',
            success: function (data) {
                const reviews = data;
                let html = '';
                reviews.forEach(review => {
                    html += `<tr>
                        <td>${review.review_id}</td>
                        <td>${review.checkout_id}</td>
                        <td>${review.description}</td>
                        <td>${review.rating}</td>
                        <td><img src="/storage/${review.photo}" alt="photo" width="100"></td>
                        <td><button class="btn btn-info btn-sm edit-review" data-id="${review.review_id}">Edit</button></td>
                        <td><button class="btn btn-danger btn-sm delete-review" data-id="${review.review_id}">Delete</button></td>
                    </tr>`;
                });
                $('#reviewTable tbody').html(html);

                // Setup pagination if needed
                setupPagination(reviews.length);
            }
        });
    }

    function populateCheckoutDropdown() {
        $.ajax({
            type: "GET",
            url: "/api/checkouts",
            dataType: 'json',
            success: function (data) {
                let options = '<option value="">Select Checkout ID</option>';
                data.forEach(checkout => {
                    options += `<option value="${checkout.checkout_id}">${checkout.checkout_id}</option>`;
                });
                $('#checkout_id').html(options);
            }
        });
    }

    function handleFormSubmit() {
        const form = $('#reviewForm')[0];
        const formData = new FormData(form);

        $.ajax({
            type: formData.get('review_id') ? "PUT" : "POST",
            url: formData.get('review_id') ? `/api/reviews/${formData.get('review_id')}` : "/api/reviews",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                $('#reviewModal').modal('hide');
                loadReviews(currentPage);
            },
            error: function (xhr) {
                const errors = xhr.responseJSON.errors;
                for (let key in errors) {
                    $(`#${key}`).addClass('is-invalid');
                    $(`.${key}Feedback`).text(errors[key][0]);
                }
            }
        });
    }

    function handleEditReview(id) {
        $.ajax({
            type: "GET",
            url: `/api/reviews/${id}`,
            dataType: 'json',
            success: function (data) {
                $('#reviewId').val(data.review_id);
                $('#checkout_id').val(data.checkout_id);
                $('#description').val(data.description);
                $('#rating').val(data.rating);
                $('#photoPreview').html(data.photo ? `<img src="/storage/${data.photo}" alt="photo" width="100">` : '');
                $('#reviewSubmit').hide();
                $('#reviewUpdate').show();
                $('#reviewModal').modal('show');
            }
        });
    }

    function handleDeleteReview(id) {
        $.ajax({
            type: "DELETE",
            url: `/api/reviews/${id}`,
            success: function () {
                loadReviews(currentPage);
            }
        });
    }

    $('#reviewSubmit').click(handleFormSubmit);
    $('#reviewUpdate').click(handleFormSubmit);
    $('#reviewTable').on('click', '.edit-review', function () {
        const id = $(this).data('id');
        handleEditReview(id);
    });
    $('#reviewTable').on('click', '.delete-review', function () {
        const id = $(this).data('id');
        handleDeleteReview(id);
    });

    populateCheckoutDropdown();
    loadReviews();
});
