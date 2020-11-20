import { times } from 'lodash';
import { __ } from '@wordpress/i18n';
import classnames from 'classnames';
import { withSelect, withDispatch } from '@wordpress/data';
import { compose } from '@wordpress/compose';
import { createBlock } from '@wordpress/blocks';
import { edit } from '@wordpress/icons';
import {
	InnerBlocks,
	BlockVerticalAlignmentToolbar,
	InspectorControls,
	BlockControls,
} from '@wordpress/block-editor';

import {
	PanelBody,
	ToolbarGroup,
	ToolbarButton,
	IsolatedEventContainer,
} from '@wordpress/components';

import {
	ColumnLayoutOptions,
	AlignItemsOptions,
	SpacingItemsOptions,
} from './options';
import { GridPlaceholder } from './components';
import { ConditionalWrapper } from '../utility';

/**
 *
 * https://getwithgutenberg.com/
 */

const Edit = ( props ) => {
	const {
		columns,
		attributes,
		setAttributes,
		updateAlignment,
		updateColumns,
	} = props;

	const allowedBlocks = [ 'wps-gutenberg/grid-block' ];	

	/*
	 * Change the layout (number of columns), resetting everything to the default
	 */
	const onChangeLayout = ( cols ) => {
		updateColumns( columns, cols );
	};

	if ( columns === 0 ) {
		return <GridPlaceholder onChange={ onChangeLayout } />;
	}

	/* eslint-disable  */

	const  holderBackgrounds = classnames(
		attributes.bgImageBehaviour && `u-background-${ attributes.bgImageBehaviour }`,
		attributes.bgImagePosition && `u-background-pos-${ attributes.bgImagePosition }`		
	);

	const holderClasses = classnames(
		attributes.marginAll && `u-margin-${ attributes.marginAll }`,
		attributes.marginTop && `u-margin-top-${ attributes.marginTop }`,
		attributes.marginBottom && `u-margin-bottom-${ attributes.marginBottom }`,
		attributes.marginRight && `u-margin-right-${ attributes.marginRight }`,
		attributes.marginLeft && `u-margin-left-${ attributes.marginLeft }`,
		attributes.marginVertical && `u-margin-vertical-${ attributes.marginVertical }`,
		attributes.marginHorizontal &&`u-margin-horizontal-${ attributes.marginHorizontal }`,
		attributes.paddingAll && `u-padding-${ attributes.paddingAll }`,
		attributes.paddingTop && `u-padding-top-${ attributes.paddingTop }`,
		attributes.paddingBottom &&	`u-padding-bottom-${ attributes.paddingBottom }`,
		attributes.paddingRight && `u-padding-right-${ attributes.paddingRight }`,
		attributes.paddingLeft && `u-padding-left-${ attributes.paddingLeft }`,
		attributes.paddingVertical && `u-padding-vertical-${ attributes.paddingVertical }`,
		attributes.paddingHorizontal && `u-padding-horizontal-${ attributes.paddingHorizontal }`,
		attributes.backgroundColor && `u-background-${ attributes.backgroundColor }`,
		attributes.holderClass,
		attributes.bgImageUrl && holderBackgrounds
	);
	/* eslint-enable */	

	const styles = attributes.bgImageUrl
		? { backgroundImage: `url(${ attributes.bgImageUrl })` }
		: {};

	const wrapperClasses = classnames(
		'o-wrapper',
		props.attributes.wrapperSize &&
			`o-wrapper--size-${ props.attributes.wrapperSize }`,
		props.attributes.wrapperClass
	);

	const gridClasses = classnames(
		'wps-row',
		attributes.itemSpacing &&
			`wps-row--spacing-${ attributes.itemSpacing }`,
		attributes.vAlign && `wps-row--vAlign-${ attributes.vAlign }`,
		attributes.hAlign && `wps-row--hAlign-${ attributes.hAlign }`,
		attributes.fullHeightRow && 'wps-row--full-height-row',
		attributes.equalHeightCols && 'wps-row--equal-height-col',
		attributes.fullHeightCols && 'wps-row--full-height-col'
	);

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Grid Layout', 'wps-gutenberg-blocks' ) }
					initialOpen={ false }
				>
					<ColumnLayoutOptions
						onChange={ onChangeLayout }
						columns={ columns }
					/>
				</PanelBody>
				<PanelBody
					title={ __( 'Align inner items', 'wps-gutenberg-blocks' ) }
					initialOpen={ false }
				>
					<SpacingItemsOptions
						spacing={ attributes.itemSpacing }
						setAttributes={ setAttributes }
					/>
					<AlignItemsOptions
						verticalAlign={ attributes.vAlign }
						horizontalAlign={ attributes.hAlign }
						height={ {
							equalHeight: attributes.equalHeightCols,
							fullHeightCols: attributes.fullHeightCols,
							fullHeightRow: attributes.fullHeightRow,
						} }
						setAttributes={ setAttributes }
					/>
				</PanelBody>
			</InspectorControls>
			<BlockControls>
				<BlockVerticalAlignmentToolbar
					onChange={ updateAlignment }
					value={ attributes.verticalAlignment }
				/>
				<ToolbarGroup>
					<ToolbarButton
						icon={ edit }
						label="Edit"
						onClick={ () => alert( 'Editing' ) }
					/>
				</ToolbarGroup>
			</BlockControls>
			<IsolatedEventContainer>
				<ConditionalWrapper
					condition={ holderClasses || ! _.isEmpty( styles ) }
					wrapper={ ( children ) => (
						<div
							className={ classnames(
								'o-holder',
								holderClasses
							) }
							id={
								attributes.holderID
									? attributes.holderID
									: false
							}
							style={ styles }
						>
							{ children }
						</div>
					) }
				>
					<ConditionalWrapper
						condition={ props.attributes.hasWrapper }
						wrapper={ ( children ) => (
							<div className={ wrapperClasses }>{ children }</div>
						) }
					>
						<div className={ gridClasses }>
							<InnerBlocks
								orientation="horizontal"
								allowedBlocks={ allowedBlocks }
								// /renderAppender={() => null}
								template={ null }
								templateLock="all"
							/>
						</div>
					</ConditionalWrapper>
				</ConditionalWrapper>
			</IsolatedEventContainer>
		</>
	);
};

function getColumnBlocks( currentBlocks, previous, columns ) {
	if ( columns > previous ) {
		// Add new blocks to the end
		return [
			...currentBlocks,
			...times( columns - previous, () =>
				createBlock( 'wps-gutenberg/grid-block' )
			),
		];
	}

	// A little ugly but... ideally we remove empty blocks first, and then anything with content from the end
	let cleanedBlocks = [ ...currentBlocks ];
	let totalRemoved = 0;

	// Reverse the blocks so we start at the end. This happens in-place
	cleanedBlocks.reverse();

	// Remove empty blocks
	cleanedBlocks = cleanedBlocks.filter( ( block ) => {
		if (
			totalRemoved < previous - columns &&
			block.innerBlocks.length === 0
		) {
			totalRemoved++;
			return false;
		}

		return true;
	} );

	// If we still need to remove blocks then do them from the beginning before flipping it back round
	return cleanedBlocks
		.slice( Math.max( 0, previous - columns - totalRemoved ) )
		.reverse();
}

export default compose( [
	withDispatch( ( dispatch, ownProps, registry ) => ( {
		/**
		 * Update all child Column blocks with a new vertical alignment setting
		 * based on whatever alignment is passed in. This allows change to parent
		 * to overide anything set on a individual column basis.
		 *
		 * @param {string} verticalAlignment the vertical alignment setting
		 */

		updateColumns( previous, columns ) {
			const { clientId } = ownProps;
			const { replaceBlock } = dispatch( 'core/block-editor' );
			const { getBlocks } = registry.select( 'core/block-editor' );
			const innerBlocks = getColumnBlocks(
				getBlocks( clientId ),
				previous,
				columns
			);

			// Replace the whole block with a new one so that our changes to both the attributes and innerBlocks are atomic
			// This ensures that the undo history has a single entry, preventing traversing to a 'half way' point where innerBlocks are changed
			// but the column attributes arent

			const blockCopy = createBlock(
				ownProps.name,
				{
					...ownProps.attributes,
					//className: removeGridClasses( ownProps.attributes.className ),
				},
				innerBlocks
			);

			replaceBlock( clientId, blockCopy );
		},

		updateAlignment( verticalAlignment ) {
			const { clientId, setAttributes } = ownProps;
			const { updateBlockAttributes } = dispatch( 'core/block-editor' );
			const { getBlockOrder } = registry.select( 'core/block-editor' );

			// Update own alignment.
			setAttributes( { verticalAlignment } );

			// Update all child Column Blocks to match
			const innerBlockClientIds = getBlockOrder( clientId );
			innerBlockClientIds.forEach( ( innerBlockClientId ) => {
				updateBlockAttributes( innerBlockClientId, {
					verticalAlignment,
				} );
			} );
		},
	} ) ),
	withSelect( ( select, { clientId } ) => {
		const { getBlockOrder, getBlockCount, getBlocksByClientId } = select(
			'core/block-editor'
		);
		return {
			columns: getBlockCount( clientId ),
			columnAttributes: getBlockOrder( clientId ).map(
				( innerBlockClientId ) =>
					getBlocksByClientId( innerBlockClientId )[ 0 ].attributes
			),
		};
	} ),
] )( Edit );
