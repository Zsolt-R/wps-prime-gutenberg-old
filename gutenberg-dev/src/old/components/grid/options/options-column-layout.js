import { getColumns } from '../../../constants';
import GridColIcon from '../../../icons';
import classnames from 'classnames';

export const ColumnLayoutOptions = ( { columns, onChange } ) => {
	return (
		<div className="wps-gb-columns-layout">
			{ getColumns().map( ( column ) => (
				<div
					key={ column.value }
					className={ classnames( 'wps-gb-columns-layout__item', {
						'is-active': columns === column.value,
					} ) }
					onClick={ () => onChange( column.value ) }
				>
					<span className="wps-gb-columns-layout__item-icon">
						<GridColIcon
							columns={ column.value }
							height="27"
							className="wps-gb-columns-layout__item-symbol"
						/>
					</span>
					<span className="wps-gb-columns-layout__item-label">{ `${
						column.value
					} ${ column.value > 1 ? `blocks` : `block` }` }</span>
				</div>
			) ) }
		</div>
	);
};
