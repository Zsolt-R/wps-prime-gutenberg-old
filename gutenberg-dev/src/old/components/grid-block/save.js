import classnames from 'classnames';
import { InnerBlocks } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes } = props;

	/* eslint-disable  */
	const  innerBackgrounds = classnames(
		attributes.bgImageBehaviour && `u-background-${ attributes.bgImageBehaviour }`,
		attributes.bgImagePosition && `u-background-pos-${ attributes.bgImagePosition }`		
	);
	
	const classes = classnames(		
		'wps-col',
		attributes.columnWidthPhone && `wps-col-phone-${ attributes.columnWidthPhone }`,
		attributes.columnWidthLap && `wps-col-lap-${ attributes.columnWidthLap }`,
		attributes.columnWidthLapAndUp && `wps-col-lap-and-up-${ attributes.columnWidthLapAndUp }`,
		attributes.columnWidthPortable && `wps-col-portable-${ attributes.columnWidthPortable }`,
		attributes.columnWidthDesk && `wps-col-desktop-${ attributes.columnWidthDesk }`,
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
		attributes.cssClass
	 );

	const innerClasses = classnames(
		'wps-col__inner',
		attributes.backgroundColor && `u-background-${ attributes.backgroundColor }`,
		attributes.innerMarginAll && `u-margin-${ attributes.innerMarginAll }`,
		attributes.innerMarginTop && `u-margin-top-${ attributes.innerMarginTop }`,
		attributes.innerMarginBottom && `u-margin-bottom-${ attributes.innerMarginBottom }`,
		attributes.innerMarginRight && `u-margin-right-${ attributes.innerMarginRight }`,
		attributes.innerMarginLeft && `u-margin-left-${ attributes.innerMarginLeft }`,
		attributes.innerMarginVertical && `u-margin-vertical-${ attributes.innerMarginVertical }`,
		attributes.innerMarginHorizontal &&`u-margin-horizontal-${ attributes.innerMarginHorizontal }`,
		attributes.innerPaddingAll && `u-padding-${ attributes.innerPaddingAll }`,
		attributes.innerPaddingTop && `u-padding-top-${ attributes.innerPaddingTop }`,
		attributes.innerPaddingBottom &&	`u-padding-bottom-${ attributes.innerPaddingBottom }`,
		attributes.innerPaddingRight && `u-padding-right-${ attributes.innerPaddingRight }`,
		attributes.innerPaddingLeft && `u-padding-left-${ attributes.innerPaddingLeft }`,
		attributes.innerPaddingVertical && `u-padding-vertical-${ attributes.innerPaddingVertical }`,
		attributes.innerPaddingHorizontal && `u-padding-horizontal-${ attributes.innerPaddingHorizontal }`,
		attributes.bgImageUrl && innerBackgrounds,
		attributes.innerVAlign && `wps-col__inner--vAlign-${attributes.innerVAlign}`,
		attributes.innerCssClass
	);
	/* eslint-enable */

	const styles = attributes.bgImageUrl
		? { backgroundImage: `url(${ attributes.bgImageUrl })` }
		: {};

	return (
		<div
			className={ classes }
			id={ attributes.cssId ? attributes.cssId : false }
		>
			<div className={ innerClasses } style={ styles }>
				<InnerBlocks.Content />
			</div>
		</div>
	);
}
