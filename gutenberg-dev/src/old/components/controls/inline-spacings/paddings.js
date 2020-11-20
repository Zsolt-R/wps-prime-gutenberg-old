import { SelectControl } from '@wordpress/components';
import { optionsList } from './spacing-value-list';

export const PaddingOptions = ( props ) => {
	const { atts, setAttributes, attsPrefix = '' } = props;

	/* eslint-disable */
	const paddingAll = attsPrefix ? atts[ attsPrefix + 'PaddingAll'] : atts.paddingAll;
	const paddingTop = attsPrefix ? atts[ attsPrefix + 'PaddingTop'] : atts.paddingTop;
	const paddingBottom = attsPrefix ? atts[ attsPrefix + 'PaddingBottom']: atts.paddingBottom;
	const paddingRight = attsPrefix? atts[ attsPrefix + 'PaddingRight']: atts.paddingRight;
	const paddingLeft = attsPrefix? atts[ attsPrefix + 'PaddingLeft']: atts.paddingLeft;
	const paddingVertical = attsPrefix? atts[ attsPrefix + 'PaddingVertical']: atts.paddingVertical;
	const paddingHorizontal = attsPrefix? atts[ attsPrefix + 'PaddingHorizontal']: atts.paddingHorizontal;
	

	const top = attsPrefix ? attsPrefix + 'PaddingTop' : 'paddingTop';
	const all = attsPrefix ? attsPrefix + 'PaddingAll' : 'paddingAll';
	const bottom = attsPrefix ? attsPrefix + 'PaddingBottom' : 'paddingBottom';
	const right = attsPrefix ? attsPrefix + 'PaddingRight' : 'paddingRight';
	const left = attsPrefix ? attsPrefix + 'PaddingLeft' : 'paddingLeft';
	const vertical = attsPrefix ? attsPrefix + 'PaddingVertical' : 'paddingVertical';
	const horizontal = attsPrefix ? attsPrefix + 'PaddingHorizontal'  : 'paddingHorizontal';
	/* eslint-enable */

	return (
		<>
			<SelectControl
				label="Padding top"
				labelPosition="top"
				value={ paddingTop }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ top ]: setting } )
				}
			/>

			<SelectControl
				label="Padding bottom"
				labelPosition="top"
				value={ paddingBottom }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ bottom ]: setting } )
				}
			/>

			<SelectControl
				label="Padding right"
				labelPosition="top"
				value={ paddingRight }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ right ]: setting } )
				}
			/>

			<SelectControl
				label="Padding left"
				labelPosition="top"
				value={ paddingLeft }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ left ]: setting } )
				}
			/>

			<SelectControl
				label="Padding vertical"
				labelPosition="top"
				value={ paddingVertical }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ vertical ]: setting } )
				}
			/>

			<SelectControl
				label="Padding horizontal"
				labelPosition="top"
				value={ paddingHorizontal }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ horizontal ]: setting } )
				}
			/>

			<SelectControl
				label="Padding all"
				labelPosition="top"
				value={ paddingAll }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ all ]: setting } )
				}
			/>
		</>
	);
};
