import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import { assign } from 'lodash';
import { __ } from '@wordpress/i18n';
import classnames from 'classnames';
import { TextControl, PanelBody } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';

import { ConditionalWrapper } from '../../utility';

const blockList = [ 'wps-gutenberg/grid' ];

const addHolderAttributes = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! blockList.includes( name ) ) {
		return settings;
	}

	// Use Lodash's assign to gracefully handle if attributes are undefined
	settings.attributes = assign( settings.attributes, {
		holderID: {
			type: 'string',
			default: '',
		},
		holderClass: {
			type: 'string',
			default: '',
		},
	} );

	return settings;
};
addFilter(
	'blocks.registerBlockType',
	'wps-gutenberg/grid/attributes/holder',
	addHolderAttributes
);

const withHolderControl = createHigherOrderComponent( ( BlockEdit ) => {
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
						title={ __( 'Holder', 'wps-gutenberg-blocks' ) }
						initialOpen={ false }
					>
						<TextControl
							label="CSS class"
							value={ props.attributes.holderClass }
							onChange={ ( setting ) =>
								props.setAttributes( { holderClass: setting } )
							}
						/>
						<TextControl
							label="CSS id"
							value={ props.attributes.holderID }
							onChange={ ( setting ) =>
								props.setAttributes( { holderID: setting } )
							}
						/>
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
}, 'withHolderControl' );
addFilter(
	'editor.BlockEdit',
	'wps-gutenberg/grid/with-holder-control',
	withHolderControl
);

const withHolder = createHigherOrderComponent( ( BlockListBlock ) => {
	return ( props ) => {
		// Do nothing if it's another block than our defined ones.
		if ( ! blockList.includes( props.name ) ) {
			return <BlockListBlock { ...props } />;
		}

		const {
			marginAll,
			marginTop,
			marginBottom,
			marginRight,
			marginLeft,
			marginVertical,
			marginHorizontal,
			paddingAll,
			paddingTop,
			paddingBottom,
			paddingRight,
			paddingLeft,
			paddingVertical,
			paddingHorizontal,
			bgImageUrl,
			bgImageBehaviour,
			bgImagePosition,
			holderClass,
			holderID,
		} = props.attributes;

		const spacingClasses = classnames(
			marginAll && `u-margin-${ marginAll }`,
			marginTop && `u-margin-top-${ marginTop }`,
			marginBottom && `u-margin-bottom-${ marginBottom }`,
			marginRight && `u-margin-right-${ marginRight }`,
			marginLeft && `u-margin-left-${ marginLeft }`,
			marginVertical && `u-margin-vertical-${ marginVertical }`,
			marginHorizontal && `u-margin-horizontal-${ marginHorizontal }`,
			paddingAll && `u-padding-${ paddingAll }`,
			paddingTop && `u-padding-top-${ paddingTop }`,
			paddingBottom && `u-padding-bottom-${ paddingBottom }`,
			paddingRight && `u-padding-right-${ paddingRight }`,
			paddingLeft && `u-padding-left-${ paddingLeft }`,
			paddingVertical && `u-padding-vertical-${ paddingVertical }`,
			paddingHorizontal && `u-padding-horizontal-${ paddingHorizontal }`
		);

		const backgrounds = classnames(
			bgImageBehaviour && `u-background-${ bgImageBehaviour }`,
			bgImagePosition && `u-background-pos-${ bgImagePosition }`
		);

		const holderClasses = classnames(
			holderClass,
			spacingClasses,
			bgImageUrl && backgrounds
		);

		const styles = bgImageUrl
			? { backgroundImage: `url(${ bgImageUrl })` }
			: {};

		return (
			<ConditionalWrapper
				condition={ holderClasses || ! _.isEmpty( styles ) }
				wrapper={ ( children ) => (
					<div
						className={ classnames( 'o-holder', holderClasses ) }
						id={ holderID ? holderID : false }
						style={ styles }
					>
						{ children }
					</div>
				) }
			>
				<BlockListBlock { ...props } />
			</ConditionalWrapper>
		);
	};
}, 'withHolder' );

//wp.hooks.addFilter(
//	'editor.BlockListBlock',
//	'wps-gutenberg/grid/with-holder',
//	withHolder,
//	99
//);

const modifySaveAddHolder = ( element, blockType, attributes ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! blockList.includes( blockType.name ) ) {
		return element;
	}

	const {
		marginAll,
		marginTop,
		marginBottom,
		marginRight,
		marginLeft,
		marginVertical,
		marginHorizontal,
		paddingAll,
		paddingTop,
		paddingBottom,
		paddingRight,
		paddingLeft,
		paddingVertical,
		paddingHorizontal,
		bgImageBehaviour,
		bgImagePosition,
		holderID,
		holderClass,
		bgImageUrl,
	} = attributes;

	const spacingClasses = classnames(
		marginAll && `u-margin-${ marginAll }`,
		marginTop && `u-margin-top-${ marginTop }`,
		marginBottom && `u-margin-bottom-${ marginBottom }`,
		marginRight && `u-margin-right-${ marginRight }`,
		marginLeft && `u-margin-left-${ marginLeft }`,
		marginVertical && `u-margin-vertical-${ marginVertical }`,
		marginHorizontal && `u-margin-horizontal-${ marginHorizontal }`,
		paddingAll && `u-padding-${ paddingAll }`,
		paddingTop && `u-padding-top-${ paddingTop }`,
		paddingBottom && `u-padding-bottom-${ paddingBottom }`,
		paddingRight && `u-padding-right-${ paddingRight }`,
		paddingLeft && `u-padding-left-${ paddingLeft }`,
		paddingVertical && `u-padding-vertical-${ paddingVertical }`,
		paddingHorizontal && `u-padding-horizontal-${ paddingHorizontal }`
	);

	const backgrounds = classnames(
		bgImageBehaviour && `u-background-${ bgImageBehaviour }`,
		bgImagePosition && `u-background-pos-${ bgImagePosition }`
	);

	const holderClasses = classnames(
		holderClass,
		spacingClasses,
		bgImageUrl && backgrounds
	);

	const styles = bgImageUrl
		? { backgroundImage: `url(${ bgImageUrl })` }
		: {};

	return (
		<ConditionalWrapper
			condition={ holderClasses || ! _.isEmpty( styles ) }
			wrapper={ ( children ) => (
				<div
					className={ classnames( 'o-holder', holderClasses ) }
					id={ holderID ? holderID : false }
					style={ styles }
				>
					{ children }
				</div>
			) }
		>
			{ element }
		</ConditionalWrapper>
	);
};

//addFilter(
//	'blocks.getSaveElement',
//	'wps-gutenberg/grid/wrap-holder',
//	modifySaveAddHolder,
//	2
//);
