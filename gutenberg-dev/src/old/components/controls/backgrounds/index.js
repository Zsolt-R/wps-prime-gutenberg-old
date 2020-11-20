import { createHigherOrderComponent, compose } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import { assign } from 'lodash';
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';
import { BackgroundImage } from './background-image';
import { VideoBackgroundSettings } from './background-video';
import { BackgroundColorOptions } from './background-color';
import { BackgroundImageOptions } from './background-settings';
import { InspectorControls, withColors } from '@wordpress/block-editor';
import { attributesBackground, attributesBackgroundVideo } from './attributes';

const blockList = [ 'wps-gutenberg/grid', 'wps-gutenberg/grid-block' ];

const addBackgroundAttributes = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! blockList.includes( name ) ) {
		return settings;
	}

	// Use Lodash's assign to gracefully handle if attributes are undefined
	settings.attributes = assign( settings.attributes, attributesBackground );

	// Add video background atts to supported blocks
	if ( name === 'wps-gutenberg/grid' ) {
		settings.attributes = assign(
			settings.attributes,
			attributesBackgroundVideo
		);
	}
	return settings;
};

addFilter(
	'blocks.registerBlockType',
	'wps-gutenberg/grid/attributes/background',
	addBackgroundAttributes
);

const backgroundControl = createHigherOrderComponent( ( BlockEdit ) => {
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
						title={ __(
							'Background Image',
							'wps-gutenberg-blocks'
						) }
						initialOpen={ false }
					>
						<BackgroundImage
							setAttributes={ props.setAttributes }
							atts={ props.attributes }
						/>
						<BackgroundImageOptions
							setAttributes={ props.setAttributes }
							atts={ props.attributes }
						/>
					</PanelBody>
					<BackgroundColorOptions
						atts={ {
							backgroundColor: props.backgroundColor,
							setBackgroundColor: props.setBackgroundColor,
						} }
					/>
					{ props.name === 'wps-gutenberg/grid' && (
						<PanelBody
							title={ __(
								'Background Video',
								'wps-gutenberg-blocks'
							) }
							initialOpen={ false }
						>
							<VideoBackgroundSettings
								setAttributes={ props.setAttributes }
								atts={ props.attributes }
							/>
						</PanelBody>
					) }
				</InspectorControls>
			</>
		);
	};
}, 'backgroundControl' );

const withBackgroundControl = compose( [
	withColors( {
		backgroundColor: 'color',
	} ),
	backgroundControl,
] );

addFilter(
	'editor.BlockEdit',
	'wps-gutenberg/grid/with-background-control',
	withBackgroundControl
);
