import save from './save';
import edit from './edit';
import attributes from './attributes';
import classnames from 'classnames';
import { createHigherOrderComponent } from '@wordpress/compose';
import { registerBlockType } from '@wordpress/blocks';
import { GridIcon } from '../../icons';
import './options/options-holder';
import './options/options-wrapper';

registerBlockType( 'wps-gutenberg/grid', {
	title: 'Grid',
	category: 'common',
	icon: GridIcon,
	supports: {
		align: [ 'full' ],
		className: false,
		//html: false,
	},
	description: 'Grid layout wrapper element',
	keywords: [ 'wps', 'prime', 'wps-prime', 'grid', 'layout' ],
	attributes: {
		...attributes,
	},
	edit,
	save,
} );

// Add custom class to wrapper element
const withCustomClassName = createHigherOrderComponent( ( BlockListBlock ) => {
	return ( props ) => {
		if ( props.name === 'wps-gutenberg/grid' ) {
			const classNames = [ 'wps-grid' ];

			if ( props.attributes.vAlign ) {
				classNames.push(
					`is-aligned-vertical-${ props.attributes.vAlign }`
				);
			}
			if ( props.attributes.hAlign ) {
				classNames.push(
					`is-aligned-horizontal-${ props.attributes.hAlign }`
				);
			}

			const classes = classnames( classNames );

			return <BlockListBlock { ...props } className={ classes } />;
		}
		return <BlockListBlock { ...props } />;
	};
}, 'withClientIdClassName' );

wp.hooks.addFilter(
	'editor.BlockListBlock',
	'wps-gutenberg/grid-block',
	withCustomClassName
);
