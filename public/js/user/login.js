$(function () {
    $('#user-login-form').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
            url: '/users/login',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (data, status, xhr) {
                $('#user-login-form :input').removeClass('is-invalid');
                $('div[id^="message-invalid-"]').text('');
                alert(data.message);

                switch (data.code) {
                    case '000':
                        if (localStorage.getItem('access_token') !== null) {
                            localStorage.removeItem('access_token');
                        }

                        localStorage.setItem('access_token', data.access_token);
                        location.href = '/';
                        break;
                    case '400':
                        for (let key in data.errors) {
                            $('#' + key).addClass('is-invalid')
                            $('#message-invalid-' + key).text(data.errors[key]);
                        }
                        break;
                }
            },
            error: function (xhr, status, error) {

            }
        });
    });
});