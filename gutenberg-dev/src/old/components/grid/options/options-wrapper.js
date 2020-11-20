import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import { assign } from 'lodash';
import { __ } from '@wordpress/i18n';
import classnames from 'classnames';
import {
	SelectControl,
	ToggleControl,
	TextControl,
	PanelBody,
} from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';

import { ConditionalWrapper } from '../../utility';

const blockList = [ 'wps-gutenberg/grid' ];

const addWrapperAttributes = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! blockList.includes( name ) ) {
		return settings;
	}

	// Use Lodash's assign to gracefully handle if attributes are undefined
	settings.attributes = assign( settings.attributes, {
		hasWrapper: {
			type: 'boolean',
			default: false,
		},
		wrapperSize: {
			type: 'string',
			default: '',
		},
		wrapperClass: {
			type: 'string',
			default: '',
		},
	} );

	return settings;
};

addFilter(
	'blocks.registerBlockType',
	'wps-gutenberg/grid/attributes/wrapper',
	addWrapperAttributes
);

const withWrapperControl = createHigherOrderComponent( ( BlockEdit ) => {
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
						title={ __( 'Wrapper', 'wps-gutenberg-blocks' ) }
						initialOpen={ false }
					>
						<ToggleControl
							label="Enable"
							help={
								props.attributes.hasWrapper
									? 'Content width is contained to the width of the wrapper.'
									: 'Content width is not contained.'
							}
							checked={ props.attributes.hasWrapper }
							onChange={ () =>
								props.setAttributes( {
									hasWrapper: ! props.attributes.hasWrapper,
								} )
							}
						/>
						<SelectControl
							label="Wrapper width"
							labelPosition="top"
							value={ props.attributes.wrapperSize }
							options={ [
								{ label: 'Default', value: '' },
								{ label: 'Extra Slim', value: 'extra-slim' },
								{ label: 'Slim', value: 'slim' },
								{ label: 'Wide', value: 'wide' },
								{ label: 'Extra Wide', value: 'extra-wide' },
							] }
							onChange={ ( setting ) =>
								props.setAttributes( { wrapperSize: setting } )
							}
						/>
						<TextControl
							label="CSS class"
							value={ props.attributes.wrapperClass }
							onChange={ ( setting ) =>
								props.setAttributes( { wrapperClass: setting } )
							}
						/>
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
}, 'withWrapperControl' );

addFilter(
	'editor.BlockEdit',
	'wps-gutenberg/grid/with-wrapper-control',
	withWrapperControl
);

const withWrapper = createHigherOrderComponent( ( BlockListBlock ) => {
	return ( props ) => {
		// Do nothing if it's another block than our defined ones.
		if ( ! blockList.includes( props.name ) ) {
			return <BlockListBlock { ...props } />;
		}

		const { wrapperClass, wrapperSize, hasWrapper } = props.attributes;

		const wrapperClasses = classnames(
			'o-wrapper',
			wrapperSize && `o-wrapper--size-${ wrapperSize }`,
			wrapperClass
		);

		return (
			<ConditionalWrapper
				condition={ hasWrapper }
				wrapper={ ( children ) => (
					<div className={ wrapperClasses }>{ children }</div>
				) }
			>
				<BlockListBlock { ...props } />
			</ConditionalWrapper>
		);
	};
}, 'withWrapper' );

//addFilter(
//	'editor.BlockListBlock',
//	'wps-gutenberg/grid/with-wrapper',
//	withWrapper,
//	98
//);

const modifySaveAddWrapper = ( element, blockType, attributes ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! blockList.includes( blockType.name ) ) {
		return element;
	}

	const { hasWrapper, wrapperSize, wrapperClass } = attributes;

	const wrapperClasses = classnames(
		'o-wrapper',
		wrapperSize && `o-wrapper--size-${ wrapperSize }`,
		wrapperClass
	);

	return (
		<ConditionalWrapper
			condition={ hasWrapper }
			wrapper={ ( children ) => (
				<div className={ wrapperClasses }>{ children }</div>
			) }
		>
			{ element }
		</ConditionalWrapper>
	);
};
//addFilter(
//	'blocks.getSaveElement',
//	'wps-gutenberg/grid/wrapper',
//	modifySaveAddWrapper,
//	1
//);
