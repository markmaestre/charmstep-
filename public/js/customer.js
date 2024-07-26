   
$(document).ready(function () {
  
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/customers",
            type: 'GET',
            dataType: 'json',
            error: function (xhr, error, thrown) {
                console.error('AJAX Error:', error, thrown);
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status' },
            { data: 'role', name: 'role' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

   
    function validateForm() {
        var isValid = true;
       
        $('.form-control, .form-select').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        
        if ($('#name').val().trim() === '') {
            $('#name').addClass('is-invalid');
            $('#nameError').text('Name is required.');
            isValid = false;
        }

      
        var email = $('#email').val().trim();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '' || !emailPattern.test(email)) {
            $('#email').addClass('is-invalid');
            $('#emailError').text('Valid email is required.');
            isValid = false;
        }

      
        if ($('#status').val() === '') {
            $('#status').addClass('is-invalid');
            $('#statusError').text('Status is required.');
            isValid = false;
        }

      
        if ($('#role').val() === '') {
            $('#role').addClass('is-invalid');
            $('#roleError').text('Role is required.');
            isValid = false;
        }

       
        if (!$('#userId').val() && $('#password').val().trim() === '') {
            $('#password').addClass('is-invalid');
            $('#passwordError').text('Password is required.');
            isValid = false;
        }

      
        if ($('#password').val().trim() !== $('#password_confirmation').val().trim()) {
            $('#password_confirmation').addClass('is-invalid');
            $('#passwordConfirmationError').text('Passwords do not match.');
            isValid = false;
        }

        return isValid;
    }

 
    $('#saveBtn').on('click', function () {
        if (validateForm()) {
            var id = $('#userId').val();
            var method = id ? 'PUT' : 'POST';
            var url = id ? `/customers/${id}` : '/customers';
            var data = $('#userForm').serialize();

            $.ajax({
                type: method,
                url: url,
                data: data,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $("#userModal").modal("hide");
                    table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
    });


    $('#table').on('click', '.editbtn', function () {
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: `/customers/${id}`,
            dataType: 'json',
            success: function (data) {
                $("#userId").val(data.id);
                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#status").val(data.status);
                $("#role").val(data.role);
                $("#password").val(''); 
                $("#password_confirmation").val('');
                $("#saveBtn").text('Update');
                $("#userModal").modal('show');
            },
            error: function () {
                console.error('Error loading user data.');
            }
        });
    });


    $('#table').on('click', '.deletebtn', function () {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                type: "DELETE",
                url: `/customers/${id}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    console.error('Error deleting user:', error);
                }
            });
        }
    });

    
    $('#createUserBtn').on('click', function () {
        $("#userId").val('');
        $("#userForm")[0].reset();
        $("#saveBtn").text('Save');
        $("#userModal").modal('show');
    });
});