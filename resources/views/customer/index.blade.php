@extends('layouts.master')

@section('content')

<head>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<div id="items" class="container">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#userModal">Add User <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
    <div class="card-body" style="height: 210px;">
        <input type="text" id='itemSearch' placeholder="--search--">
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <!-- DataTable rows are dynamically added here -->
            </tbody>
        </table>
    </div>
</div>

<!-- User Modal -->
<div id="userModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="userId">User ID:</label>
                        <input type="text" class="form-control" id="userId" name="userId" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="8">
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select class="form-control" id="role" name="role">
                            <option value="user">User</option>
                            <option value="seller">Seller</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="userSubmit">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/customer.js') }}"></script>
@endsection
