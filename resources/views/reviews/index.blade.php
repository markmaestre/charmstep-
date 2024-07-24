@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Reviews</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">Add Review</button>
    <table class="table" id="reviewTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Checkout ID</th>
                <th>Description</th>
                <th>Rating</th>
                <th>Photo</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Reviews will be loaded here via AJAX -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Review Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reviewForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="review_id" id="reviewId">
                    <div class="mb-3">
                        <label for="checkout_id" class="form-label">Checkout ID</label>
                        <select class="form-select" id="checkout_id" name="checkout_id" required></select>
                        <div class="invalid-feedback checkout_idFeedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        <div class="invalid-feedback descriptionFeedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                        <div class="invalid-feedback ratingFeedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                        <div class="invalid-feedback photoFeedback"></div>
                        <div id="photoPreview"></div>
                    </div>
                    <button type="button" class="btn btn-primary" id="reviewSubmit">Submit</button>
                    <button type="button" class="btn btn-primary d-none" id="reviewUpdate">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
