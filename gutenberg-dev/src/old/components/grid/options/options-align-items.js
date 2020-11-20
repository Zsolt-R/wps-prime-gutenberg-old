import { SelectControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
export const AlignItemsOptions = ( {
	horizontalAlign,
	setAttributes,
	height,
	verticalAlign,
} ) => {
	return (
		<>
			<SelectControl
				label="Vertical"
				labelPosition="top"
				value={ verticalAlign }
				options={ [
					{ label: 'Default', value: '' },
					{ label: 'Middle', value: 'middle' },
					{ label: 'Bottom', value: 'bottom' },
				] }
				onChange={ ( setting ) => setAttributes( { vAlign: setting } ) }
			/>
			<SelectControl
				label="Horizontal"
				labelPosition="top"
				value={ horizontalAlign }
				help={
					<>
						{ __( 'More info on MDN:' ) }{ ' ' }
						<a
							title="Open in a a new window"
							rel="noreferrer"
							target="_blank"
							href="https://developer.mozilla.org/en-US/docs/Web/CSS/justify-content"
						>
							link
						</a>
					</>
				}
				options={ [
					{ label: 'Default', value: '' },
					{ label: 'Center', value: 'center' },
					{ label: 'Right', value: 'right' },
					{
						label: 'Distribute space between',
						value: 'distribute-sb',
					},
					{
						label: 'Distribute space arround',
						value: 'distribute-sa',
					},
					{
						label: 'Distribute space evenly',
						value: 'distribute-se',
					},
				] }
				onChange={ ( setting ) => setAttributes( { hAlign: setting } ) }
			/>

			<ToggleControl
				label="Equal height columns"
				help={ __(
					'Make the columns inside equal their height to the tallest column',
					'wps-gutenberg-blocks'
				) }
				checked={ height.equalHeight }
				onChange={ () => {
					if ( height.fullHeightCols ) {
						setAttributes( {
							fullHeightCols: false,
						} );
					}

					setAttributes( {
						equalHeightCols: ! height.equalHeight,
					} );
				} }
			/>
			<ToggleControl
				label="Full height columns"
				help={ __(
					'Make the columns 100% height of the grid. Not compatible with vertical align.',
					'wps-gutenberg-blocks'
				) }
				checked={ height.fullHeightCols }
				onChange={ () => {
					if ( height.equalHeight ) {
						setAttributes( {
							equalHeightCols: false,
						} );
					}

					setAttributes( {
						fullHeightCols: ! height.fullHeightCols,
					} );
				} }
			/>
			<ToggleControl
				label="Full screen height row"
				help={ __(
					'Make the grid 100% the height of the screen',
					'wps-gutenberg-blocks'
				) }
				checked={ height.fullHeightRow }
				onChange={ () => {
					setAttributes( {
						fullHeightRow: ! height.fullHeightRow,
					} );
				} }
			/>
		</>
	);
};
