export const sticky_nav = ($) => {

    const { stickyTarget } = themeSettings;


    const mql = window.matchMedia("screen and (min-width: 81.25em)"); //1300

    const adminBar = $("#wpadminbar");

    const target = $(stickyTarget);

    const headerHeight = target.outerHeight();
    const loggedIn = adminBar.outerHeight();


    /**
     * Sticky header
     */
    if (mql.matches) {

        const loginAdjust = adminBar.length ? loggedIn : false;

        target.sticky({ topSpacing: loginAdjust }).on('sticky-end', function () {
            $(this).parent().css('height', headerHeight);
        });


    } else {
        target.unstick();
    }

    window.onresize = () => {
        if (!mql.matches) {
            target.unstick();
        }
    }
}