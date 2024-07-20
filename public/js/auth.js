$(document).ready(function() {
    $('#register-form').on('submit', function(e) {
        e.preventDefault();

        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
            status: $('#status').val(),
            role: $('#role').val()
        };

        $.ajax({
            url: '/api/register',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message);
            },
            error: function(response) {
                if (response.responseJSON.errors) {
                    alert(response.responseJSON.errors);
                } else {
                    alert(response.responseJSON.message);
                }
            }
        });
    });
});

$('#login-form').on('submit', function(e) {
    e.preventDefault();
    var email = $('#login_email').val();
    var password = $('#login_password').val();

    $.ajax({
        url: '/api/login',
        method: 'POST',
        data: {
            email: email,
            password: password
        },
        success: function(response) {
            alert(response.message);
        },
        error: function(response) {
            alert(response.responseJSON.message);
        }
    });
});
