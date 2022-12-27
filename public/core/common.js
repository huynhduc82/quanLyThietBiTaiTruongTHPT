let ajax_request = async function (url, data, done_fun) {
    await $.ajax({
        url: url,
        data: JSON.stringify(data),
        dataType: 'json',
        enctype: "multipart/form-data",
        contentType: 'application/json',
        cache: false,
        processData: false,
        success: function (dataJson) {
            done_fun(dataJson);
        },
        error: function () {
            message_box_error('Tác vụ thất bại !');
        },
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
};

let ajax_requests = function (url, data, done_fun) {
     $.ajax({
        url: url,
        data: JSON.stringify(data),
        // dataType: 'json',
        enctype: "multipart/form-data",
        contentType: 'application/json',
        cache: false,
        processData: false,
        success: function () {
        },
        error: function () {
        },
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
};

let ajax_get_data = function (url, data, done_fun) {
    $.ajax({
        url: url,
        data: JSON.stringify(data),
        dataType: 'json',
        enctype: "multipart/form-data",
        contentType: 'application/json',
        cache: false,
        processData: false,
        success: function () {
        },
        error: function () {
        },
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
};
