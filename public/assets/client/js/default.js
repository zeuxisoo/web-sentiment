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

        //
        $("#tags").tagit();
    });

})(jQuery);
