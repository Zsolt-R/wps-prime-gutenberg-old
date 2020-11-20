import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import { assign } from 'lodash';
import { __ } from '@wordpress/i18n';
import { PanelBody, TextControl } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
//import { attributesBackground } from './attributes';

const blockList = [ 'wps-gutenberg/grid-block' ]; // 'wps-gutenberg/grid',

const addCustomClassAttributes = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! blockList.includes( name ) ) {
		return settings;
	}

	// Use Lodash's assign to gracefully handle if attributes are undefined
	//settings.attributes = assign( settings.attributes, attributesBackground );

	return settings;
};

addFilter(
	'blocks.registerBlockType',
	'wps-gutenberg/grid/attributes/custom-classes',
	addCustomClassAttributes
);

const withCustomCssClasses = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		// Do nothing if it's another block than our defined ones.
		if ( ! blockList.includes( props.name ) ) {
			return <BlockEdit { ...props } />;
		}

		return (
			<>
				<BlockEdit { ...props } />
				<InspectorControls>
					<PanelBody
						title={ __( 'Advanced', 'wps-gutenberg-blocks' ) }
						initialOpen={ false }
					>
						<TextControl
							label="Custom CSS Class"
							value={ props.attributes.outerCssClass }
							onChange={ ( setting ) =>
								props.setAttributes( {
									outerCssClass: setting,
								} )
							}
						/>
						<TextControl
							label="Custom Inner CSS Class"
							value={ props.attributes.innerCssClass }
							onChange={ ( setting ) =>
								props.setAttributes( {
									innerCssClass: setting,
								} )
							}
						/>
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
}, 'withCustomCssClasses' );

//addFilter(
//	'editor.BlockEdit',
//	'wps-gutenberg/grid/with-background-control',
//	withCustomCssClasses
//);
