import { sticky_nav } from './components/sticky-navigation.js';
import { side_slide_menu_init } from './components/side-slide-menu-init';
import { mega_menu_init } from "./components/mega-menu-init";

jQuery(document).ready(function ($) {

    const { useSticky, megaMenu } = themeSettings;

    side_slide_menu_init($);

    if (megaMenu) {
        mega_menu_init($);
    }
    
    if (useSticky) {
        sticky_nav($);
    }
        
});