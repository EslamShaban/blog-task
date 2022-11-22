$(document).ready(function () {

    $('#create-post-form').validate({

        rules: {

            title: "required",
            description: "required",
            image: {
                required: true,
                extension: 'jpg|jpeg|png'
            },
        },

        messages: {
            title: "The title field is required",
            description: "The description field is required",
            image: {
                required: "The image field is required",
                extension: "The image field must be png,jpg,jpeg"
            }
        },

        errorElement: "span",
        errorClass: "is-invalid"

    });

    $('#store-comment').validate({

        rules: {
            comment: "required",
        },

        messages: {
            comment: "The comment field is required",
        },

        errorElement: "span",
        errorClass: "is-invalid"

    });

});
