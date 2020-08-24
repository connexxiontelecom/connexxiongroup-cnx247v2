$(function() {
    "use strict";

    //Tinymce editor
    if ($("#content").length) {
        tinymce.init({
            selector: "#content",
            height: 400,
            theme: "silver",
            branding:false,
            plugins: [
                "advlist autolink lists link charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen"
            ],
            toolbar1:
                "undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

            image_advtab: true,
            templates: [
                {
                    title: "CNX247",
                    content: "Bringing your ideas to life"
                },
                {
                    title: "CNX247",
                    content: "Breath it"
                }
            ],
            content_css: []
        });
    }    
    //Tinymce editor
    if ($(".content").length) {
        tinymce.init({
            selector: ".content",
            height: 400,
            theme: "silver",
            branding:false,
            plugins: [
                "advlist autolink lists link charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen"
            ],
            toolbar1:
                "undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

            image_advtab: true,
            templates: [
                {
                    title: "CNX247",
                    content: "Bringing your ideas to life"
                },
                {
                    title: "CNX247",
                    content: "Breath it"
                }
            ],
            content_css: []
        });
    }
});