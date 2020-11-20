import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import { assign } from 'lodash';
import { __ } from '@wordpress/i18n';
import { PanelBody, TabPanel } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import { attributesMargins, attributesPaddings } from './attributes';

import { MarginOptions } from './margins';
import { PaddingOptions } from './paddings';

const blockList = [ 'wps-gutenberg/grid', 'wps-gutenberg/grid-block' ];

const addSpacingAttributes = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! blockList.includes( name ) ) {
		return settings;
	}

	// Use Lodash's assign to gracefully handle if attributes are undefined
	settings.attributes = assign( settings.attributes, {
		...attributesMargins,
		...attributesPaddings,
	} );

	return settings;
};

addFilter(
	'blocks.registerBlockType',
	'wps-gutenberg/grid/attributes/spacing',
	addSpacingAttributes
);

const withSpacingControl = createHigherOrderComponent( ( BlockEdit ) => {
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
							'Margins / Paddings',
							'wps-gutenberg-blocks'
						) }
						initialOpen={ false }
					>
						<TabPanel
							className="block-spacing-settings"
							activeClass="active-tab"
							tabs={ [
								{
									name: 'margins',
									title: 'Margins',
									className: 'tab-margins',
								},
								{
									name: 'paddings',
									title: 'Paddings',
									className: 'tab-paddings',
								},
							] }
						>
							{ ( tab ) => {
								if ( tab.name === 'margins' ) {
									return (
										<MarginOptions
											setAttributes={
												props.setAttributes
											}
											atts={ props.attributes }
										/>
									);
								}
								return (
									<PaddingOptions
										setAttributes={ props.setAttributes }
										atts={ props.attributes }
									/>
								);
							} }
						</TabPanel>
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
}, 'withSpacingControl' );
addFilter(
	'editor.BlockEdit',
	'wps-gutenberg/grid/with-spacing-control',
	withSpacingControl
);
