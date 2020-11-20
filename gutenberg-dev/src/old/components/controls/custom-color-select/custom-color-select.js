import { __ } from '@wordpress/i18n';
import classnames from 'classnames';
import { PanelBody } from '@wordpress/components';

const ColorBubble = (props) => {
    const {colors} = props;   

    const bubbles = colors.map((item)=>{
        const {label} = item; 

        const classes = classnames(
            'wps-color-bubble',
            item.id
        );
        return <div 
        className={classes} 
        title={label}
        onClick={()=>{
            props.callback(item);
        }}
        ></div>
    });
    return <div className="wps-color-bubble-control">{bubbles}</div>
}


export const CustomColorSelect = (props) => {

    const {    
        title = __('Colors','wps-gutenberg-blocks'),
        colors = [],
        callback = ()=>{},
        selected = null,
        value = null
    } = props;     
   

    return (
        <PanelBody
			title={ title }
            initialOpen={ false }
        >
        <div 
            className="wps-color-custom-control"             
        >
            <ColorBubble
                colors={colors}
                callback={callback}
            />
        </div>
        </PanelBody>
    )
}