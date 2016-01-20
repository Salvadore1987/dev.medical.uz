$(document).ready(function () {
    $('#save').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'add_record',
            method: 'POST',
            data: {
                doctor_id: $('#doctor_id').val(),
                date: $('#date').val()
            },
            success: function (data) {
                if (data == true) {
                    top.location.href = "/";
                } else {
                    alert('Не удалось выполнить добавление!');
                }
            }
        });
    });

    $('.table button').each(function () {
        $(this).on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/activation',
                method: 'POST',
                data: {
                    id: $(this).attr('data-id')
                },
                success: function (data) {
                    if (data == true) {
                        top.location.href = "/";
                    } else {
                        alert('Не удалось выполнить обновление!');
                    }
                }
            });
        })
    });
});