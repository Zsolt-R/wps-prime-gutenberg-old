

export const read_more_init = ($) => {
    const container = $('.term-description-has-read-more');
    const toggleButton = $(container).find('.term-description__read-more');


    if (!container.length > 0) {
        return;
    }

    $(toggleButton).on('click', function () {
        container.toggleClass('term-description-is-open');
    });
}