import { SelectControl } from '@wordpress/components';
import { optionsList } from './spacing-value-list';

export const PaddingOptions = ( props ) => {
	const { atts, setAttributes } = props;

	const {
		paddingAll,
		paddingTop,
		paddingBottom,
		paddingRight,
		paddingLeft,
		paddingVertical,
		paddingHorizontal,
	} = atts;

	return (
		<>
			<SelectControl
				label="Padding top"
				labelPosition="top"
				value={ paddingTop }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { paddingTop: setting } )
				}
			/>

			<SelectControl
				label="Padding bottom"
				labelPosition="top"
				value={ paddingBottom }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { paddingBottom: setting } )
				}
			/>

			<SelectControl
				label="Padding right"
				labelPosition="top"
				value={ paddingRight }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { paddingRight: setting } )
				}
			/>

			<SelectControl
				label="Padding left"
				labelPosition="top"
				value={ paddingLeft }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { paddingLeft: setting } )
				}
			/>

			<SelectControl
				label="Padding vertical"
				labelPosition="top"
				value={ paddingVertical }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { paddingVertical: setting } )
				}
			/>

			<SelectControl
				label="Padding horizontal"
				labelPosition="top"
				value={ paddingHorizontal }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { paddingHorizontal: setting } )
				}
			/>

			<SelectControl
				label="Padding all"
				labelPosition="top"
				value={ paddingAll }
				options={ optionsList }
				onChange={ ( setting ) =>
					setAttributes( { paddingAll: setting } )
				}
			/>
		</>
	);
};
