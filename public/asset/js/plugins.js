+(function ($) {
    $.fn.extend({
            "modal": function (callback) {
                $('body').append('<div class="modal-backdrop"></div>');
                var _this = $(this);
                var target = _this.attr('data-target');
                var modal = $('#' + target);
                _this.click(function(event) { 
                    if (modal.css('display') == 'none') {
                        modal.show();
                        $('.modal-backdrop').show();
                    } else{
                        modal.hide();
                        $('.modal-backdrop').hide();
                    }
                });

            modal.find('.closes').click(function(event) {
                modal.hide();
                $('.modal-backdrop').hide();
            });

            modal.find('.success').click(function() {
                var b = callback();
                if (b) {
                    modal.hide();
                    $('.modal-backdrop').hide();
                }
            });
        }
    });
})(jQuery);