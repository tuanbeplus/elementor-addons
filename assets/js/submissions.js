(function ($) {
    'use strict';

    /**
     * Submissions Widget - Show More functionality
     */
    function initSubmissions($container) {
        var $widget = $container.find('.bt-submissions');
        if (!$widget.length) return;

        var perPage = parseInt($widget.data('per-page'), 10) || 9;
        var $cards = $widget.find('.bt-submissions__card');
        var $btn = $widget.find('.bt-submissions__load-more');
        var totalCards = $cards.length;
        var shown = perPage;

        // Initial state: show first batch, hide rest
        $cards.each(function (index) {
            if (index < perPage) {
                $(this).removeClass('bt-submissions__card--hidden');
            } else {
                $(this).addClass('bt-submissions__card--hidden');
            }
        });

        // Hide button if all items are already visible
        if (shown >= totalCards) {
            $btn.addClass('bt-submissions__load-more--hidden');
        }

        $btn.on('click', function () {
            var nextBatch = shown + perPage;
            var delay = 0;

            $cards.each(function (index) {
                if (index >= shown && index < nextBatch) {
                    var $card = $(this);
                    setTimeout(function () {
                        $card.removeClass('bt-submissions__card--hidden');
                        $card.addClass('bt-submissions__card--reveal');
                    }, delay);
                    delay += 60;
                }
            });

            shown = nextBatch;

            if (shown >= totalCards) {
                $btn.addClass('bt-submissions__load-more--hidden');
            }
        });
    }

    // Elementor frontend handler
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/submissions.default', function ($scope) {
            initSubmissions($scope);
        });
    });

    // Fallback: init on DOM ready for non-Elementor contexts
    $(document).ready(function () {
        if (typeof elementorFrontend === 'undefined') {
            initSubmissions($(document));
        }
    });

})(jQuery);
