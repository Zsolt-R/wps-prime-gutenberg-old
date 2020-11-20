import { SelectControl } from '@wordpress/components';
export const SpacingItemsOptions = ( { spacing, setAttributes } ) => {
	return (
		<>
			<SelectControl
				label="Spacing between blocks"
				labelPosition="top"
				value={ spacing }
				options={ [
					{ label: 'Default', value: '' },
					{ label: 'Flush', value: 'none' },
					{ label: 'Tiny', value: 'tiny' },
					{ label: 'Small', value: 'small' },
					{ label: 'Large', value: 'large' },
					{ label: 'Huge', value: 'huge' },
				] }
				onChange={ ( setting ) =>
					setAttributes( { itemSpacing: setting } )
				}
			/>
		</>
	);
};
