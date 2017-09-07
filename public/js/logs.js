$(document).ready(function () {
    $('.grid-stack-item-content').on('keypress', '#activity-widget-search', function (e) {
        var handler = $(this)
        overlay = handler.closest('.grid-stack-item-content');

        if (e.which === 13) {
            overlay.LoadingOverlay('show');
            $.ajax({
                url: handler.closest('form').attr('action'),
                method: 'POST',
                data: {
                    search: handler.val(),
                },
                success: function (response) {
                    var grid = handler.closest('.grid-stack-item-content'), content = grid.find('.card__content');
                    if ($(response).attr('class').length <= 0) {
                        return false;
                    }
                    var classname = $(response).attr('class').split(' ')[0],
                            container = handler.closest('.' + classname);

                    if (container.length > 0) {
                        container.html($(response).html());
                    } else {
                        var ajaxContainer = $(response).closest('.widget-ajax-response');
                        if (ajaxContainer.length > 0) {
                            content.html(ajaxContainer.html());
                        } else {
                            content.html(response);
                        }
                    }
                    overlay.LoadingOverlay('hide');
                },
            });
            return false;
        }

    });
    ready('.pagination-ajax', function (element) {
        $(element).click(function (e) {

            var handler = $(this), grid = handler.closest('.grid-stack-item-content'), content = grid.find('.card__content');

            content.LoadingOverlay('show');

            $.ajax({
                url: handler.attr('href'),
                success: function (response) {

                    var html = $(response).closest('.widget-ajax-response').html();

                    if (!$('.jquery-modal').length) {
                        if (html === undefined) {
                            if ($(response).find('.card__content').length) {
                                content.html($(response).find('.card__content').html());
                            } else {
                                content.html(response);
                            }
                        } else {
                            content.html(html);
                        }

                    } else if ($('.jquery-modal').is(":visible")) {
                        $('.jquery-modal').find('.card__content').html(html);
                    } else {
                        content.html(html);
                    }
                    content.LoadingOverlay('hide');
                },
                error: function (error) {
                    content.LoadingOverlay('hide');
                }
            })
            return false;
        });
    });
});