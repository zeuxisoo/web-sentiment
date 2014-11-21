;(function($) {

    $.fn.activeStyle = function(name, param, callback) {
        $(this).each(function() {
            var current_value   = $(this).data(name);
            var parameter_name  = $(this).data(param);
            var parameter_value = $.parseParams(window.location.href.split('?')[1])[parameter_name];

            return callback.call(this, current_value, parameter_value);
        });
    };

    $(function() {
        // Render input file type
        $(":file").filestyle({
            icon: false,
            buttonText: "Browse",
            buttonName: "btn-primary"
        });

        // Auto active tab
        $('a[data-tab]').activeStyle('tab', 'tab-param', function(current_value, parameter_value) {
            if (parameter_value === undefined || current_value == parameter_value) {
                $(this).parent().addClass('active');
                return false;
            }
        });

        // Topic tags
        $("#tags").tagit();

        // Sweet alert
        $("a[data-sweet-confirm]").on('click', function(e) {
            e.preventDefault();

            var href = $(this).prop('href');

            sweetAlert({
                title: "Are you sure?",
                text: "You will not be able to recover this vote action!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, vote it!",
                closeOnConfirm: true
            }, function(){
                window.location = href;
            });
        });

        // Swipe box
        $('a.swipebox').swipebox({
            hideBarsDelay: 0
        });

        // Turbolink and PJAX
        $(document).pjax('a', 'body');
        $(document).on('pjax:start', function() {
            NProgress.start();
        });
        $(document).on('pjax:end', function() {
            NProgress.done();
        });
    });

})(jQuery);
