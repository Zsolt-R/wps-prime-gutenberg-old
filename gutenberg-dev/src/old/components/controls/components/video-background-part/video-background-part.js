export const VideoBackgroundPart = ( props ) => {
	const { videoUrl, ytVideoUrl, placehlderUrl } = props;
	return (
		<>
			{ videoUrl && ! ytVideoUrl && (
				<div className="wps-bg-video-wrapper">
					<video
						className="wps-bg-video"
						poster={ placehlderUrl }
						playsInline
						autoPlay
						muted
						loop
					>
						<source src={ videoUrl } type="video/mp4" />
					</video>
				</div>
			) }
			{ ytVideoUrl && (
				<span
					className="wps-ytube-video"
					data-video-bg-id={ ytVideoUrl }
				></span>
			) }
		</>
	);
};
