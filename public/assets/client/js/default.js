;(function($) {

    $(function() {
        $(".file-input").fileinput({
            showUpload: false,
            showPreview: false,
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg']
        });
    });

})(jQuery);
