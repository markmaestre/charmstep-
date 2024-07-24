$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
    $('#register-form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
                maxlength: 255,
                remote: {
                    url: '/api/check-email', 
                    type: 'post',
                    data: {
                        email: function() {
                            return $('#email').val();
                        }
                    }
                }
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            },
            role: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                maxlength: "Your name must not exceed 255 characters"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
                maxlength: "Your email must not exceed 255 characters",
                remote: "This email is already taken"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            },
            role: {
                required: "Please select a role"
            }
        },
        submitHandler: function(form) {
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
                    window.location.href = response.redirect_url; // Redirect to login page
                },
                error: function(response) {
                    $('.error').remove();
                    $('.is-invalid').removeClass('is-invalid');
                    if (response.responseJSON.errors) {
                        let errors = response.responseJSON.errors;
                        for (let field in errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field).after('<span class="error">' + errors[field][0] + '</span>');
                        }
                    } else {
                        alert(response.responseJSON.message);
                    }
                }
            });
        }
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

    $('input, select').on('input change', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.error').remove();
    });
});
