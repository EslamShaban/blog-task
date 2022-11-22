$(function () {

    $('#store-comment').on('submit', function (e) {
        e.preventDefault();

        let url = $(this).attr('action');
        let method = $(this).attr('method');
        let data = new FormData(this);

        $.ajax({
            url: url,
            method: method,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (html) {

                $('#post-comments').empty().append(html);
                $('#comment').val('');

            },

        });

    });

    $('#like-post').on('click', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            success: function (html) {
                console.log(html);
                $('#like-post').empty().append(html);
            },

        });

    });
});