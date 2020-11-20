import classnames from 'classnames';
import { InnerBlocks } from '@wordpress/block-editor';
import { ConditionalWrapper } from '../utility';
import { VideoBackgroundPart } from '../controls/components/';

export default function save( props ) {
	const { attributes } = props;

	const hasBgVideo =
		attributes.videoUrlYoutube || attributes.videoUrlHosted ? true : false;

/* eslint-disable */
	const  holderBackgrounds = classnames(
		attributes.bgImageBehaviour && `u-background-${ attributes.bgImageBehaviour }`,
		attributes.bgImagePosition && `u-background-pos-${ attributes.bgImagePosition }`,
		hasBgVideo && 'has-background-video',
		attributes.videoUrlHosted && 'has-background-video-hosted',
		attributes.videoUrlYoutube && 'has-background-video-streamed',
		attributes.videoPlaceholderUrl && 'has-background-video-placeholder'
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
		attributes.bgImageUrl || hasBgVideo ? holderBackgrounds : ''
	);

	const wrapperClasses = classnames(
		'o-wrapper',
		attributes.wrapperSize &&
			`o-wrapper--size-${ attributes.wrapperSize }`,
		attributes.wrapperClass
	);

	const styles = attributes.bgImageUrl
		? { backgroundImage: `url(${ attributes.bgImageUrl })` }
		: {};


	const gridClasses = classnames(		
		'wps-row',
		attributes.itemSpacing && `wps-row--spacing-${ attributes.itemSpacing }`,
		attributes.vAlign && `wps-row--vAlign-${ attributes.vAlign }`,
		attributes.hAlign && `wps-row--hAlign-${ attributes.hAlign }`,		
		attributes.equalHeightCols && 'wps-row--equal-height-col',
		attributes.fullHeightCols && 'wps-row--full-height-col',
		attributes.fullHeightRow && 'wps-row--full-height-row',
	);
		/* eslint-enable  */

	//const bgColor = getColorClassName('color',props.attributes);

	return (
		<ConditionalWrapper
			condition={ holderClasses || ! _.isEmpty( styles ) } //eslint-disable-line
			wrapper={ ( children ) => (
				<div
					className={ classnames( 'o-holder', holderClasses ) }
					id={ attributes.holderID ? attributes.holderID : false }
					style={ styles }
				>
					<VideoBackgroundPart
						videoUrl={ attributes.videoUrlHosted }
						ytVideoUrl={ attributes.videoUrlYoutube }
						placehlderUrl={ attributes.videoPlaceholderUrl }
					/>
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
					<InnerBlocks.Content />
				</div>
			</ConditionalWrapper>
		</ConditionalWrapper>
	);
}
