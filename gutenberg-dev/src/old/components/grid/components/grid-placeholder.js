import { Placeholder, IconButton } from '@wordpress/components';
import GridColIcon from '../../../icons';
import { getColumns } from '../../../constants';
import { __ } from '@wordpress/i18n';

export const GridPlaceholder = ( { onChange } ) => {
	return (
		<Placeholder
			icon="layout"
			label={ __( 'Choose Layout', 'wps-gutenberg-blocks' ) }
			instructions={ __(
				'Select a layout to start with:',
				'wps-gutenberg-blocks'
			) }
			//className={classes}
		>
			<ul className="wps-grid-column-picker">
				{ getColumns().map( ( column ) => (
					<li key={ column.value }>
						<IconButton
							icon={ <GridColIcon columns={ column.value } /> }
							onClick={ () => onChange( column.value ) }
							label={ column.label }
						/>
					</li>
				) ) }
			</ul>
		</Placeholder>
	);
};
