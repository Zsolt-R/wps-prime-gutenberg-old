import { SelectControl } from '@wordpress/components';
import { optionsList } from './spacing-value-list';

export const MarginOptions = ( props ) => {
	const { atts, setAttributes } = props;

	const {
		marginAll,
		marginTop,
		marginBottom,
		marginRight,
		marginLeft,
		marginVertical,
		marginHorizontal,
	} = atts;

	return (
		<>
			<SelectControl
				label="Margin top"
				labelPosition="top"
				value={ marginTop }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { marginTop: setting } )
				}
			/>

			<SelectControl
				label="Margin bottom"
				labelPosition="top"
				value={ marginBottom }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { marginBottom: setting } )
				}
			/>

			<SelectControl
				label="Margin right"
				labelPosition="top"
				value={ marginRight }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { marginRight: setting } )
				}
			/>

			<SelectControl
				label="Margin left"
				labelPosition="top"
				value={ marginLeft }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { marginLeft: setting } )
				}
			/>

			<SelectControl
				label="Margin vertical"
				labelPosition="top"
				value={ marginVertical }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { marginVertical: setting } )
				}
			/>

			<SelectControl
				label="Margin horizontal"
				labelPosition="top"
				value={ marginHorizontal }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { marginHorizontal: setting } )
				}
			/>

			<SelectControl
				label="Margin all"
				labelPosition="top"
				value={ marginAll }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { marginAll: setting } )
				}
			/>
		</>
	);
};
