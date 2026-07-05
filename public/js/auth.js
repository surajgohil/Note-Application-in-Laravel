$('#signupForm').submit(function(e){
    e.preventDefault();
    
    let name = $('#name').val();
    let email = $('#email').val();
    let password = $('#password').val();
    let confirmPassword = $('#confirmPassword').val();

    switch (true) {
        case !name:
            $('#nameError').show();
            break;
        case !email:
            $('#emailError').show();
            break;
        case !password:
            $('#passwordError').show();
            break;
        case !confirmPassword:
            $('#confirmPasswordError').show();
            break;
        case password !== confirmPassword:
            $('#confirmPasswordError').show();
            $('#confirmPasswordError').text('Passwords do not match');
            break;
        default:
            $(`.invalid-feedback`).hide();
    }

    let formData = new FormData($('#signupForm')[0]);

    ajaxRequest('/api/register', 'POST', formData, function(response) {

        if(response.status === true) {
            alert(response.message);
            window.location.href = response.redirectUrl;
        } else if (response.errors) {

            $(`.invalid-feedback`).hide();

            $.each(response.errors, function(key, value) {
                $(`#${key}Error`).show();
                $(`#${key}Error`).text(value[0]);
            });
        }
    });
});

$('#loginForm').submit(function(e){
    e.preventDefault();

    let email = $('#email').val();
    let password = $('#password').val();
    let formData = new FormData($('#loginForm')[0]);

    ajaxRequest('/api/login', 'POST', formData, function(response) {

        if(response.status === true) {
            alert(response.message);
            window.location.href = response.redirectUrl;
        } else if (response.status === false || response.errors) {

            $(`.invalid-feedback`).hide();
    
            $.each(response.errors, function(key, value) {
                $(`#${key}Error`).show();
                $(`#${key}Error`).text(value[0]);
            });
        }
    });
});

function ajaxRequest(url, method, data, callback) {
    $.ajax({
        url: url,
        method: method,
        headers: {
            'Accept': 'application/json',
        },
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            callback(response);
        },
        error: function(xhr, status, error) {
            switch(xhr.status) {
                case 422:
                    callback(xhr.responseJSON);
                    break;
                case 401:
                    callback(xhr.responseJSON);
                    break;
                default:
                    console.error(xhr, status, error);
            }
        }
    });
}