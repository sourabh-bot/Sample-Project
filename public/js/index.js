var table = $(".user_table").DataTable({
    processing: true,
    serverSide: true,
    ajax: '/',
    columns:[
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'mobile_number', name: 'mobile_number'},
        {data: 'description', name: 'description'},
        {data: 'role', name: 'role'},
        {data: 'profile_image', name: 'profile_image'}
    ]
});

$(document).on('submit', '.user_form', function (e) {
    e.preventDefault();
    let url = $(this).attr('action');
    let method = $(this).attr('method');
    let data = new FormData(this);
    let form = $(this)[0];
    let formDataArray = $(this).serializeArray();
    $(this).find('input[type="file"]').each(function () {
        formDataArray.push({
            name: $(this).attr('name'),
            value: $(this).val()
        });
    });
    formDataArray = formDataArray.map(item=>item.name);
    $.ajax({
        url,
        method,
        data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (resp) {
            $('.alert').removeClass('d-none').addClass('alert-success d-block').text(resp.message);
            form.reset();
            formDataArray.forEach((item) => {
                let element = $(`[name="${item}"]`);
                $(element).removeClass('is-invalid');
                $(element).next('.invalid-feedback').text('');
            });
            table.ajax.reload();
            setTimeout(()=>{
                $('.alert').removeClass('alert-success d-block').addClass('d-none')
            }, 2000)
        },
        error: function (err) {
            let message = err.responseJSON.message;
            if (err.status == 422) {
                let errors = err.responseJSON.errors;
                let keys = Object.keys(err.responseJSON.errors)
                formDataArray.forEach((item) => {
                    let element = $(`[name="${item}"]`);
                    if (keys.includes(item)) {
                        $(element).addClass('is-invalid');
                        $(element).next('.invalid-feedback').text(errors[item][0]);
                    } else {
                        $(element).removeClass('is-invalid');
                        $(element).next('.invalid-feedback').text('');
                    }
                });
            }
            $('.alert').removeClass('d-none').addClass('alert-danger d-block').text(message);
            setTimeout(()=>{
                $('.alert').removeClass('alert-danger d-block').addClass('d-none')
            }, 2000)
        }
    })
});