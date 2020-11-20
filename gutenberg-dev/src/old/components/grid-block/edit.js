import { __ } from '@wordpress/i18n';
import classnames from 'classnames';
import {
	PanelBody,
	SelectControl,
	TextControl,
	TabPanel,
} from '@wordpress/components';

import { InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { MarginOptions, PaddingOptions } from '../controls/inline-spacings';

const Edit = ( props ) => {
	const { setAttributes, attributes } = props;

	const options = [
		{ label: '---', value: '' },
		{ label: '1 columns - 1/12', value: '1/12' },
		{ label: '2 columns - 1/6', value: '2/12' },
		{ label: '3 columns - 1/4', value: '3/12' },
		{ label: '4 columns - 1/3', value: '4/12' },
		{ label: '5 columns - 5/12', value: '5/12' },
		{ label: '6 columns - 1/2', value: '6/12' },
		{ label: '7 columns - 7/12', value: '7/12' },
		{ label: '8 columns - 2/3', value: '8/12' },
		{ label: '9 columns - 3/4', value: '9/12' },
		{ label: '10 columns - 5/6', value: '10/12' },
		{ label: '11 columns - 11/12', value: '11/12' },
		{ label: '12 columns - 1/1', value: '12/12' },
		{ label: '20% - 1/5', value: '1/5' },
		{ label: '40% - 2/5', value: '2/5' },
		{ label: '60% - 3/5', value: '3/5' },
		{ label: '80% - 4/5', value: '4/5' },
	];

	/* eslint-disable  */
	const  innerBackgrounds = classnames(
		attributes.bgImageBehaviour && `u-background-${ attributes.bgImageBehaviour }`,
		attributes.bgImagePosition && `u-background-pos-${ attributes.bgImagePosition }`		
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
	console.log(attributes.backgroundColor);

	const styles = attributes.bgImageUrl
		? { backgroundImage: `url(${ attributes.bgImageUrl })` }
		: {};
	return (
		<>
			<InspectorControls>
				<PanelBody title="General Settings" initialOpen={ false }>
					<TextControl
						label="CSS Class"
						value={ attributes.cssClass }
						onChange={ ( setting ) =>
							setAttributes( {
								cssClass: setting,
							} )
						}
					/>
					<TextControl
						label="CSS ID"
						value={ attributes.cssId }
						onChange={ ( setting ) =>
							setAttributes( {
								cssId: setting,
							} )
						}
					/>
					<SelectControl
						label="Vertical align elements"
						labelPosition="top"
						value={ attributes.innerVAlign }
						options={ [
							{ label: 'Default (top)', value: '' },
							{ label: 'Middle', value: 'middle' },
							{ label: 'Bottom', value: 'bottom' },
						] }
						onChange={ ( setting ) =>
							setAttributes( { innerVAlign: setting } )
						}
					/>
				</PanelBody>
				<PanelBody title="Inner element" initialOpen={ false }>
					<TextControl
						label="CSS class"
						value={ attributes.innerClass }
						onChange={ ( setting ) =>
							setAttributes( {
								innerClass: setting,
							} )
						}
					/>

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
										setAttributes={ setAttributes }
										atts={ attributes }
										attsPrefix={ 'inner' }
									/>
								);
							}
							return (
								<PaddingOptions
									setAttributes={ setAttributes }
									atts={ attributes }
									attsPrefix={ 'inner' }
								/>
							);
						} }
					</TabPanel>
				</PanelBody>
				<PanelBody title="Column sizes" initialOpen={ false }>
					<SelectControl
						label="Desktop"
						labelPosition="top"
						value={ attributes.columnWidthDesk }
						options={ options }
						onChange={ ( setting ) =>
							setAttributes( { columnWidthDesk: setting } )
						}
					/>
					<SelectControl
						label="Laptop and up"
						labelPosition="top"
						value={ attributes.columnWidthLapAndUp }
						options={ options }
						onChange={ ( setting ) =>
							setAttributes( { columnWidthLapAndUp: setting } )
						}
					/>
					<SelectControl
						label="Laptop"
						labelPosition="top"
						value={ attributes.columnWidthLap }
						options={ options }
						onChange={ ( setting ) =>
							setAttributes( { columnWidthLap: setting } )
						}
					/>
					<SelectControl
						label="Portable"
						labelPosition="top"
						value={ attributes.columnWidthPortable }
						options={ options }
						onChange={ ( setting ) =>
							setAttributes( { columnWidthPortable: setting } )
						}
					/>
					<SelectControl
						label="Phone"
						labelPosition="top"
						value={ attributes.columnWidthPhone }
						options={ options }
						onChange={ ( setting ) =>
							setAttributes( { columnWidthPhone: setting } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<>
				<div className={ innerClasses } style={ styles }>
					<InnerBlocks
						templateLock={ false }
						renderAppender={ () => (
							<div className="wps-gb-grid-block__appender">
								<InnerBlocks.ButtonBlockAppender />
							</div>
						) }
					/>
				</div>
			</>
		</>
	);
};
export default Edit;
