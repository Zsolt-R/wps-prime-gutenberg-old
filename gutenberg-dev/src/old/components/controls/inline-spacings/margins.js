import { SelectControl } from '@wordpress/components';
import { optionsList } from './spacing-value-list';

export const MarginOptions = ( props ) => {
	const { atts, setAttributes, attsPrefix = '' } = props;

	/* eslint-disable */
	const marginAll = attsPrefix ? atts[ attsPrefix + 'MarginAll'] : atts.marginAll;
	const marginTop = attsPrefix ? atts[ attsPrefix + 'MarginTop'] : atts.marginTop;
	const marginBottom = attsPrefix ? atts[ attsPrefix + 'MarginBottom']: atts.marginBottom;
	const marginRight = attsPrefix? atts[ attsPrefix + 'MarginRight']: atts.marginRight;
	const marginLeft = attsPrefix? atts[ attsPrefix + 'MarginLeft']: atts.marginLeft;
	const marginVertical = attsPrefix? atts[ attsPrefix + 'MarginVertical']: atts.marginVertical;
	const marginHorizontal = attsPrefix? atts[ attsPrefix + 'MarginHorizontal']: atts.marginHorizontal;
	

	const top = attsPrefix ? attsPrefix + 'MarginTop' : 'marginTop';
	const all = attsPrefix ? attsPrefix + 'MarginAll' : 'marginAll';
	const bottom = attsPrefix ? attsPrefix + 'MarginBottom' : 'marginBottom';
	const right = attsPrefix ? attsPrefix + 'MarginRight' : 'marginRight';
	const left = attsPrefix ? attsPrefix + 'MarginLeft' : 'marginLeft';
	const vertical = attsPrefix ? attsPrefix + 'MarginVertical' : 'marginVertical';
	const horizontal = attsPrefix ? attsPrefix + 'MarginHorizontal'  : 'marginHorizontal';
	/* eslint-enable */

	return (
		<>
			<SelectControl
				label="Margin top"
				labelPosition="top"
				value={ marginTop }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ top ]: setting } )
				}
			/>

			<SelectControl
				label="Margin bottom"
				labelPosition="top"
				value={ marginBottom }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ bottom ]: setting } )
				}
			/>

			<SelectControl
				label="Margin right"
				labelPosition="top"
				value={ marginRight }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ right ]: setting } )
				}
			/>

			<SelectControl
				label="Margin left"
				labelPosition="top"
				value={ marginLeft }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ left ]: setting } )
				}
			/>

			<SelectControl
				label="Margin vertical"
				labelPosition="top"
				value={ marginVertical }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ vertical ]: setting } )
				}
			/>

			<SelectControl
				label="Margin horizontal"
				labelPosition="top"
				value={ marginHorizontal }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ horizontal ]: setting } )
				}
			/>

			<SelectControl
				label="Margin all"
				labelPosition="top"
				value={ marginAll }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { [ all ]: setting } )
				}
			/>
		</>
	);
};
