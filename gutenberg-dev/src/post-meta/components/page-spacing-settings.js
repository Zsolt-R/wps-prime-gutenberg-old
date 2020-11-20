import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import {  ToggleControl  } from '@wordpress/components';

const WpsPrimeThemePageMeta = () => {    
   
   const postType = useSelect(
    ( select ) => select( 'core/editor' ).getCurrentPostType(),
    []
    );

    const [ meta, setMeta ] = useEntityProp(
        'postType',
        postType,
        'meta'
    );   

    const hideTitle = meta['_wps_prime_hide_title'];
    const marginTop = meta['_wps_prime_page_margin_top_reset'];
    const marginBottom = meta['_wps_prime_page_margin_bottom_reset'];   
    const hideFooter = meta['_wps_prime_hide_footer'];   

    function updateHideTitle( newValue ) {
        setMeta( { ...meta, '_wps_prime_hide_title': newValue } );
    }

    function updateMarginTop( newValue ) {
        setMeta( { ...meta, '_wps_prime_page_margin_top_reset': newValue } );
    }

    function updateMarginBottom( newValue ) {
        setMeta( { ...meta, '_wps_prime_page_margin_bottom_reset': newValue } );
    } 
    
    function updateFooterVisibility( newValue ) {
        setMeta( { ...meta, '_wps_prime_hide_footer': newValue } );
    } 
     
    return (
        <PluginDocumentSettingPanel name="wps-prime-theme-custom-settings" title="Custom settings">
            <ToggleControl            
            label="Hide title"
            help="Hide the main title (visually)"
            checked={ hideTitle }
            onChange={ updateHideTitle }
        />  
           <ToggleControl            
            label="Reset top space"
            help="Remove the space between the header and main content area"
            checked={ marginTop }
            onChange={ updateMarginTop }
        />       
        <ToggleControl         
            label="Reset bottom space"
            help="Remove the space between the main content area and footer"
            checked={ marginBottom }
            onChange={ updateMarginBottom }
        />
        <ToggleControl         
            label="Hide footer"
            help="Remove the footer completely"
            checked={ hideFooter }
            onChange={ updateFooterVisibility }
        />
        </PluginDocumentSettingPanel>
    );
};
if (window.pagenow === 'page') {
    registerPlugin('wps-prime-theme-page-meta', {
        render: WpsPrimeThemePageMeta,
        icon: false,
        priority:11
    });
}