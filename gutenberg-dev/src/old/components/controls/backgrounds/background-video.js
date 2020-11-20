import { __ } from '@wordpress/i18n';
import { ImageUploaderUI } from '../components';
import { TextControl } from '@wordpress/components';

export const VideoBackgroundSettings = ( props ) => {
	const { atts, setAttributes } = props;

	const onUpdateImage = ( image ) => {
		let imageUrl = '';

		if ( image ) {
			const img = image.sizes.full;
			if ( img.url ) {
				imageUrl = img.url;
			}
		}

		setAttributes( {
			videoPlaceholderId: image.id,
			videoPlaceholderUrl: imageUrl,
		} );
	};

	const onRemoveImage = () => {
		setAttributes( {
			videoPlaceholderId: undefined,
			videoPlaceholderUrl: '',
		} );
	};

	const instructions = (
		<p>
			{ __(
				'To edit the background image, you need permission to upload media.',
				'wps-gutenberg-blocks'
			) }
		</p>
	);

	return (
		<div className="u-margin-bottom">
			<ImageUploaderUI
				title={ __( 'Placeholder Image', 'wps-gutenberg-blocks' ) }
				fallback={ instructions }
				allowedMedia={ [ 'image' ] }
				mediaId={ atts.videoPlaceholderId }
				onRemove={ onRemoveImage }
				onUpdate={ onUpdateImage }
			/>
			<hr />
			<TextControl
				label="Youtube Video url"
				value={ atts.videoUrlYoutube }
				onChange={ ( setting ) =>
					props.setAttributes( {
						videoUrlYoutube: setting,
					} )
				}
			/>
			<TextControl
				label="Self hosted video media url"
				value={ atts.videoUrlHosted }
				onChange={ ( setting ) =>
					props.setAttributes( {
						videoUrlHosted: setting,
					} )
				}
			/>
		</div>
	);
};
