$(document).ready(function () {
    $("form").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 255,
            },
            email: {
                required: true,
                email: true,
                maxlength: 255,
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 255,
            },
            terms: {
                required: true,
            },
            venue: {
                required: true,
            },
            price: {
                required: true,
                number: true,
            },
            date: {
                required: true,
            },
            time: {
                required: true,
            },
            quantity: {
                required: true,
                digits: true,
            },
            image: {
                accept: "image/*",
            },
            aboutyou: {
                maxlength: 255,
            },
            location: {
                required: true,
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name must be at least 3 characters",
                maxlength: "Name cannot exceed 255 characters",
            },
            email: {
                required: "Email is required",
                email: "Please enter a valid email address",
                maxlength: "Email cannot exceed 255 characters",
            },
            password: {
                required: "Password is required",
                minlength: "Password must be at least 8 characters",
                maxlength: "Password cannot exceed 255 characters",
            },
            terms: {
                required: "You must accept the terms and conditions",
            },
            venue: {
                required: "Event Venue is required",
            },
            price: {
                required: "Event Price is required",
                number: "Please enter a valid price",
            },
            date: {
                required: "Event Date is required",
            },
            time: {
                required: "Event Time is required",
            },
            quantity: {
                required: "Event Quantity is Required",
                digits: "Please enter a valid Quantity",
            },
            image: {
                accept: "Please select a valid image file (JPEG, PNG, GIF, etc).",
            },
            aboutyou: {
                required: "Your Description is limited up to 255 character",
            },
            location: {
                required: "Please enter your location",
            },
            phone: {
                required: "Please enter your phone number",
                digits: "Please enter a valid phone number",
                minlength: "Phone number must be 10 digits",
                maxlength: "Phone number must be 10 digits",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("text-danger");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
        onfocusout: function (element) {
            $(element).valid();
        },
        submitHandler: function (form) {
            form.submit();
        },
    });
});
