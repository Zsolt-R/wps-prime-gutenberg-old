import { __ } from '@wordpress/i18n';
import { ImageUploaderUI } from '../components';

export const BackgroundImage = ( props ) => {
	const { atts, setAttributes } = props;

	const instructions = (
		<p>
			{ __(
				'To edit the background image, you need permission to upload media.',
				'wps-gutenberg-blocks'
			) }
		</p>
	);

	const onUpdateImage = ( image ) => {
		let imageUrl = '';
		const bgSize = atts.bgImageSize ? atts.bgImageSize : 'full';

		if ( image ) {
			const img = image.sizes[ bgSize ];
			if ( img.url ) {
				imageUrl = img.url;
			}
		}

		setAttributes( {
			bgImageId: image.id,
			bgImageSize: bgSize,
			bgImageUrl: imageUrl,
		} );
	};

	const onRemoveImage = () => {
		setAttributes( {
			bgImageId: undefined,
			bgImageUrl: '',
			bgImageSize: 'full',
			bgImageBehaviour: '',
			bgImagePosition: '',
		} );
	};

	return (
		<div className="u-margin-bottom">
			<ImageUploaderUI
				title={ __( 'Background image', 'wps-gutenberg-blocks' ) }
				fallback={ instructions }
				allowedMedia={ [ 'image' ] }
				mediaId={ atts.bgImageId }
				onRemove={ onRemoveImage }
				onUpdate={ onUpdateImage }
			/>
		</div>
	);
};
