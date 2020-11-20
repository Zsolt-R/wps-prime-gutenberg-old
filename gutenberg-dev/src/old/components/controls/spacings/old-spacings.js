const { addFilter } = wp.hooks;
import { __ } from '@wordpress/i18n';
import classnames from 'classnames';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TabPanel } from '@wordpress/components';
import { assign } from 'lodash';
import { MarginOptions } from './margins';
import { PaddingOptions } from './paddings';
import { attributesMargins, attributesPaddings } from './attributes';
const targetBlockList = [
	//'core/image',
	//'core/paragraph',
	//'core/column',
	//'core/columns',
	//'core/media-text',
	'wps-gutenberg/grid',
];

export const SpacingOptions = ( props ) => {
	return (
		<>
			<MarginOptions />
			<PaddingOptions />
		</>
	);
};

const addSpacingControlAttribute = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! targetBlockList.includes( name ) ) {
		return settings;
	}

	const newSettings = {
		...settings,
		attributes: {
			...settings.attributes, // spread in old attributes so we don't lose them!
			...attributesMargins,
			...attributesPaddings,
		},
		edit( props ) {
			const { attributes, setAttributes } = props;

			return (
				<>
					{ settings.edit( props ) }
					<InspectorControls>
						<PanelBody
							title={ __(
								'Margins & Paddings',
								'wps-gutenberg-blocks'
							) }
							initialOpen={ false }
						>
							<PanelBody
								title={ __( 'Margin', 'wps-gutenberg-blocks' ) }
								initialOpen={ false }
							>
								<MarginOptions
									setAttributes={ setAttributes }
									atts={ attributes }
								/>
							</PanelBody>
							<PanelBody
								title={ __(
									'Padding',
									'wps-gutenberg-blocks'
								) }
								initialOpen={ false }
							>
								<PaddingOptions
									setAttributes={ setAttributes }
									atts={ attributes }
								/>
							</PanelBody>
						</PanelBody>
					</InspectorControls>
				</>
			);
		},
		save( props ) {
			return <>{ settings.save( props ) }</>;
		},
	};

	return newSettings;
};
//addFilter(
//	'blocks.registerBlockType',
//	'wps-gutenberg/spacings',
//	addSpacingControlAttribute
//);

const addSpacingClasses = ( saveElementProps, blockType, attributes ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! targetBlockList.includes( blockType.name ) ) {
		return saveElementProps;
	}

	assign( attributes, {
		spacing: classnames( 'test' ),
	} );

	return saveElementProps;
};
//addFilter(
//	'blocks.getSaveContent.extraProps',
//	'wps-gutenberg/get-save-content/spacings',
//	addSpacingClasses
//);
