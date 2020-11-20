import { __ } from '@wordpress/i18n';
import { PanelColorSettings } from '@wordpress/block-editor';
import {CustomColorSelect} from '../custom-color-select';

export const BackgroundColorOptions = ( props ) => {
	const {
		atts: { setBackgroundColor, backgroundColor },
	} = props;

	
	// Customizer colors injected via localize
	const colors = [];

	const colorList = colors.map((color)=>{
		
		const slug = color.id.replace('background-', '');
			
		return {
			name:color.label,
			slug,
			color:color.value
		}
	});
	

	return (
		<>
		<CustomColorSelect
			title={ __( 'Background Color' ) }
			colors={wpsCustomizer.backgroundColors}
			callback={(value)=>{
				console.log(value);
			}}
		/>
		<PanelColorSettings
			title={ __( 'Background Color' ) }
			initialOpen={ false }
			colorSettings={ [
				{					
					label: __( 'Background' ),
					onChange: (hex)=>{						
						setBackgroundColor(hex);
					},
					value: backgroundColor.color,	
					disableCustomColors: true,
					//colors:colorList
				},
			] }
		/>
		</>
	);
};

/**
 *  colors.map(
						(item)=>{
							return { 'name':item.label,'slug':item.id, 'color':item.value }
					}
 */
