import { __ } from '@wordpress/i18n';
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { ResponsiveWrapper, Button, Spinner } from '@wordpress/components';
import { useSelect } from '@wordpress/data';

export const ImageUploaderUI = ( props ) => {
	const {
		title,
		fallback,
		allowedMedia,
		mediaId,
		onUpdate,
		onRemove,
	} = props;

	const media = useSelect( ( select ) => {
		const { getMedia } = select( 'core' );
		return mediaId ? getMedia( mediaId ) : null;
	} );

	return (
		<>
			<MediaUploadCheck fallback={ fallback }>
				<MediaUpload
					title={ title }
					onSelect={ onUpdate }
					allowedTypes={ allowedMedia }
					value={ mediaId }
					render={ ( { open } ) => (
						<Button
							className={
								! mediaId
									? 'editor-post-featured-image__toggle'
									: 'editor-post-featured-image__preview'
							}
							onClick={ open }
						>
							{ ! mediaId &&
								__(
									'Set background image',
									'wps-gutenberg-blocks'
								) }
							{ !! mediaId && ! media && (
								<>
									{ /*console.log( media, mediaId )*/ }
									<Spinner />
								</>
							) }
							{ !! mediaId && media && (
								<>
									<ResponsiveWrapper
										naturalWidth={
											media.media_details.width
										}
										naturalHeight={
											media.media_details.height
										}
									>
										<img
											src={ media.source_url }
											alt={ __(
												'Background image',
												'wps-gutenberg-blocks'
											) }
										/>
									</ResponsiveWrapper>
								</>
							) }
						</Button>
					) }
				/>
			</MediaUploadCheck>
			{ !! mediaId && media && (
				<MediaUploadCheck>
					<MediaUpload
						title={ __(
							'Background image',
							'image-selector-example'
						) }
						onSelect={ onUpdate }
						allowedTypes={ allowedMedia }
						value={ mediaId }
						render={ ( { open } ) => (
							<div>
								<Button
									className="editor-post-featured-image__button"
									onClick={ open }
									isDefault
									isLarge
								>
									{ __(
										'Replace image',
										'wps-gutenberg-blocks'
									) }
								</Button>
							</div>
						) }
					/>
				</MediaUploadCheck>
			) }
			{ !! mediaId && (
				<MediaUploadCheck>
					<div>
						<Button onClick={ onRemove } isLink isDestructive>
							{ __( 'Remove image', 'wps-gutenberg-blocks' ) }
						</Button>
					</div>
				</MediaUploadCheck>
			) }
		</>
	);
};
