$(function () {
    $('#user-registration-form').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
            url: '/users/register',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (data, status, xhr) {
                $('#user-registration-form :input').removeClass('is-invalid');
                $('div[id^="message-invalid-"]').text('');
                alert(data.message);

                switch (data.code) {
                    case '000':
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