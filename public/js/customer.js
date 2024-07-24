// Set up CSRF token for AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/api/customers",
            type: "GET",
            dataSrc: ''
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status' },
            { data: 'role', name: 'role' },
            {
                data: null,
                render: function (data, type, row) {
                    return "<a href='#' data-toggle='modal' data-target='#userModal' class='editbtn' data-id='" + data.id + "'><i class='fas fa-edit' aria-hidden='true' style='font-size:24px; color:blue'></i></a>";
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='deletebtn' data-id='" + data.id + "'><i class='fa fa-trash' style='font-size:24px; color:red'></i></a>";
                }
            }
        ]
    });

    // Add user via AJAX
    $('#userSubmit').on('click', function (e) {
        e.preventDefault();
        var data = $('#form').serialize();
        $.ajax({
            type: "POST",
            url: "/api/customers",
            data: data,
            dataType: "json",
            success: function (response) {
                $("#userModal").modal("hide");
                table.ajax.reload(); // Reload DataTable after successful operation
            },
            error: function (error) {
                console.log('Error creating user via AJAX.');
                console.log(error);
            }
        });
    });

    // Update user via AJAX
    $('#userUpdate').on('click', function (e) {
        e.preventDefault();
        var id = $('#userId').val();
        var data = $('#form').serialize();
        $.ajax({
            type: "PUT",
            url: `/api/customers/${id}`,
            data: data,
            dataType: "json",
            success: function (response) {
                $("#userModal").modal("hide");
                table.ajax.reload(); // Reload DataTable after successful operation
            },
            error: function (error) {
                console.log('Error updating user via AJAX.');
                console.log(error);
            }
        });
    });

    // Delete user via AJAX
    $('#tbody').on('click', '.deletebtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "DELETE",
            url: `/api/customers/${id}`,
            success: function (response) {
                table.ajax.reload(); // Reload DataTable after successful operation
            },
            error: function (error) {
                console.log('Error deleting user via AJAX.');
                console.log(error);
            }
        });
    });

    // Load user details into modal for editing
    $('#userModal').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id');
        $.ajax({
            type: "GET",
            url: `/api/customers/${id}`,
            dataType: 'json',
            success: function (data) {
                $("#userId").val(data.id);
                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#status").val(data.status);
                $("#role").val(data.role);
            },
            error: function () {
                console.log('Error loading user via AJAX.');
            }
        });
    });

   
    $('#userModal').on('hidden.bs.modal', function (e) {
        $("#form").trigger("reset");
        $("#userId").val('');
    });
});
