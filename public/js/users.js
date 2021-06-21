$(document).ready(function () {
    $('#users_data').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        ajax: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            'data': function (data) {
            },
            url: APP_URL + '/users-data'

        },
        columns: [
            {data: 'full_name', name: "full_name"},
            {data: 'username', name: "username"},
            {data: 'email', name: "email"},
            {data: 'role', name: "role"},
        ]
    });

});