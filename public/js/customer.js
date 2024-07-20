$(document).ready(function () {
 
    function fetchUsers() {
        $.ajax({
            type: "GET",
            url: "/api/customers",
            dataType: 'json',
            success: function (data) {
                $("#tbody").empty(); 
                $.each(data, function (key, value) {
                    var tr = $("<tr>");
                    tr.append($("<td>").html(value.id));
                    tr.append($("<td>").html(value.name));
                    tr.append($("<td>").html(value.email));
                    tr.append($("<td>").html(value.status));
                    tr.append($("<td>").html(value.role));
                    tr.append("<td align='center'><a href='#' data-toggle='modal' data-target='#userModal' class='editbtn' data-id='" + value.id + "'><i class='fas fa-edit' aria-hidden='true' style='font-size:24px; color:blue'></i></a></td>");
                    tr.append("<td><a href='#' class='deletebtn' data-id='" + value.id + "'><i class='fa fa-trash' style='font-size:24px; color:red'></i></a></td>");
                    $("#tbody").append(tr);
                });
            },
            error: function () {
                console.log('Error fetching users via AJAX.');
            }
        });
    }


    fetchUsers();

    $("#userSubmit").on('click', function (e) {
        e.preventDefault();
        var data = $('#form').serialize();
        $.ajax({
            type: "POST",
            url: "/api/customers",
            data: data,
            dataType: "json",
            success: function (data) {
                $("#userModal").modal("hide");
                fetchUsers(); 
            },
            error: function (error) {
                console.log('Error creating user via AJAX.');
                console.log(error);
            }
        });
    });

    $("#userUpdate").on('click', function (e) {
        e.preventDefault();
        var id = $('#userId').val();
        var data = $('#form').serialize();
        $.ajax({
            type: "PUT",
            url: `/api/customers/${id}`,
            data: data,
            dataType: "json",
            success: function (data) {
                $("#userModal").modal("hide");
                fetchUsers(); 
            },
            error: function (error) {
                console.log('Error updating user via AJAX.');
                console.log(error);
            }
        });
    });


    $("#tbody").on('click', '.deletebtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "DELETE",
            url: `/api/customers/${id}`,
            success: function (data) {
                fetchUsers(); 
            },
            error: function (error) {
                console.log('Error deleting user via AJAX.');
                console.log(error);
            }
        });
    });


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
