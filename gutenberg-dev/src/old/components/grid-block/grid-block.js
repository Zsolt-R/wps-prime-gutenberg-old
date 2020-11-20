import save from './save';
import Edit from './edit';
import { attributes, spacingAttributes } from './attributes';
import { createHigherOrderComponent, compose } from '@wordpress/compose';
import { withSelect } from '@wordpress/data';
import classnames from 'classnames';
import { registerBlockType } from '@wordpress/blocks';
import { GridBlockIcon } from '../../icons';

registerBlockType( 'wps-gutenberg/grid-block', {
	title: 'Grid Block',
	category: 'common',
	icon: GridBlockIcon,
	description: 'Individual grid layout sub element (block)',
	keywords: [ 'example', 'test' ],
	parent: [ 'wps-gutenberg/grid' ],
	attributes: {
		...attributes,
		...spacingAttributes,
	},
	supports: {
		className: false,
		customClassName: false,
	},
	edit: Edit,
	save,
} );

// Add custom class to wrapper element
const withCustomClassName = createHigherOrderComponent( ( BlockListBlock ) => {
	return ( props ) => {
		if ( props.name === 'wps-gutenberg/grid-block' ) {
			/* eslint-disable */
			const classes = classnames(
				'wps-grid-block',
				'wps-col',
				props.attributes.columnWidthPhone && `wps-col-phone-${ props.attributes.columnWidthPhone }`,
				props.attributes.columnWidthPortable &&`wps-col-portable-${ props.attributes.columnWidthPortable }`,
				props.attributes.columnWidthLap && `wps-col-lap-${ props.attributes.columnWidthLap }`,
				props.attributes.columnWidthLapAndUp && `wps-col-lap-and-up-${ props.attributes.columnWidthLapAndUp }`,
				props.attributes.columnWidthDesk && `wps-col-desktop-${ props.attributes.columnWidthDesk }`,
				props.attributes.marginAll && `u-margin-${ props.attributes.marginAll }`,
				props.attributes.marginTop && `u-margin-top-${ props.attributes.marginTop }`,
				props.attributes.marginBottom && `u-margin-bottom-${ props.attributes.marginBottom }`,
				props.attributes.marginRight && `u-margin-right-${ props.attributes.marginRight }`,
				props.attributes.marginLeft && `u-margin-left-${ props.attributes.marginLeft }`,
				props.attributes.marginVertical && `u-margin-vertical-${ props.attributes.marginVertical }`,
				props.attributes.marginHorizontal &&`u-margin-horizontal-${ props.attributes.marginHorizontal }`,
				props.attributes.paddingAll && `u-padding-${ props.attributes.paddingAll }`,
				props.attributes.paddingTop && `u-padding-top-${ props.attributes.paddingTop }`,
				props.attributes.paddingBottom &&	`u-padding-bottom-${ props.attributes.paddingBottom }`,
				props.attributes.paddingRight && `u-padding-right-${ props.attributes.paddingRight }`,
				props.attributes.paddingLeft && `u-padding-left-${ props.attributes.paddingLeft }`,
				props.attributes.paddingVertical && `u-padding-vertical-${ props.attributes.paddingVertical }`,
				props.attributes.paddingHorizontal && `u-padding-horizontal-${ props.attributes.paddingHorizontal }`,
				props.attributes.cssClass,
				props.innerBlocksCount === 0 ? 'has-no-inner-blocks':''
				
			 );
			 /* eslint-enable */	

			return <BlockListBlock { ...props } className={ classes } />;
		}
		return <BlockListBlock { ...props } />;
	};
}, 'withClientIdClassName' );

const withCustomEverything = compose( [
	withSelect( ( select, { clientId } ) => {
		const { getBlockCount } = select( 'core/block-editor' );
		return {
			innerBlocksCount: getBlockCount( clientId ),
		};
	} ),
	withCustomClassName,
] );

wp.hooks.addFilter(
	'editor.BlockListBlock',
	'wps-gutenberg/grid-block',
	withCustomEverything
);
