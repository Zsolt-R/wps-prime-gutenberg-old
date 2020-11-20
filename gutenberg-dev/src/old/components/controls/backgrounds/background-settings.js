import { __ } from '@wordpress/i18n';
import { SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';

export const BackgroundImageOptions = ( props ) => {
	const { atts, setAttributes } = props;
	const { bgImageId } = atts;

	const bgImage = useSelect( ( select ) => {
		const { getMedia } = select( 'core' );
		return bgImageId ? getMedia( bgImageId ) : null;
	} );

	let sizes = [ { label: 'Full', value: 'full' } ];

	if ( bgImage ) {
		sizes = Object.keys( bgImage.media_details.sizes ).map( ( key ) => {
			return { label: key, value: key };
		} );
	}

	const positions = [
		{ label: 'Default (top left)', value: '' },
		{ label: 'Center', value: 'center' },
		{ label: 'Center left', value: 'center-left' },
		{ label: 'Center right', value: 'center-right' },
		{ label: 'Top center', value: 'top-center' },
		{ label: 'Top right', value: 'top-right' },
		{ label: 'Bottom left', value: 'bottom-left' },
		{ label: 'Bottom center', value: 'bottom-center' },
		{ label: 'Bottom right', value: 'bottom-right' },
	];

	const behaviour = [
		{ label: 'Repeat', value: '' },
		{ label: "Don't repeat", value: 'no-repeat' },
		{ label: 'Cover', value: 'cover' },
		{ label: 'Contain', value: 'contain' },
	];

	/**
	 * missing_image_sizes
	 * media_details{
	 * original_image
	 * sizes{
	 * size:{
	 * height
	 * width
	 * source_url
	 * }
	 * }
	 * }
	 *
	 * @param setting
	 */
	return (
		<>
			<hr />
			<SelectControl
				label="Size"
				labelPosition="top"
				value={ atts.bgImageSize }
				options={ sizes }
				onChange={ ( setting ) => {
					let imageUrl = '';

					if ( bgImage ) {
						const image = bgImage.media_details.sizes[ setting ];
						if ( image.source_url ) {
							imageUrl = image.source_url;
						}
					}

					setAttributes( {
						bgImageSize: setting,
						bgImageUrl: imageUrl,
					} );
				} }
			/>
			<SelectControl
				label="Behaviour"
				labelPosition="top"
				help={ __(
					'Set how the background image behaves.',
					'wps-gutenberg-blocks'
				) }
				value={ atts.bgImageBehaviour }
				options={ behaviour }
				onChange={ ( setting ) =>
					setAttributes( { bgImageBehaviour: setting } )
				}
			/>
			<SelectControl
				label="Position"
				labelPosition="top"
				value={ atts.bgImagePosition }
				options={ positions }
				onChange={ ( setting ) =>
					setAttributes( { bgImagePosition: setting } )
				}
			/>
		</>
	);
};
