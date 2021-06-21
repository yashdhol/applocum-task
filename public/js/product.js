$(document).ready(function () {
    var orderimgRenderer = function (data, type, full, meta) {
        return full.image_url ? '<img src="' + data + '" height="42" width="42">' : '';
    };
    var createdByRenderer = function (data, type, full, meta) {
        return full.created_by ? full.created_by['full_name'] : '';
    };
    var perentCategoryRenderer = function (data, type, full, meta) {
        return full.category ? full.category['name'] : '-';
    };
    productTable = $('#product_data').DataTable({
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
            url: APP_URL + '/product-data'

        },
        columns: [
            {data: 'name', name: "name"},
            {data: 'description', name: "description"},
            {"className": '', data: 'category_id',
                "render": perentCategoryRenderer
            },
            {"className": '', data: 'created_by',
                "render": createdByRenderer
            },
            {"className": '', data: 'image_url',
                "render": orderimgRenderer
            },
            {data: 'timestamp', name: "timestamp"},
            {data: 'action', name: "action"},
        ]
    });

});
$(document).on('click', '.delete-products', function (e) {
    var idData = $(this).attr('data-id');
    e.preventDefault();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: APP_URL + '/products/' + idData,
        method: 'DELETE',
        success: function (result) {
            if (result.status = "success") {
                productTable.ajax.reload();
            }
        }
    });
});