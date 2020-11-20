import pSBC from 'shade-blend-color';

export const mapCustomizerSettings = (values) => {

    if(values.length === 0){
        return;
    }
   
    values.forEach(element => {

        const {
            id= '', 
            target='',
            factor=undefined,
            suffix=''
        } = element;  

       if(!id && !target){ 
        return;
       }  
            
        wp.customize(id, function (value) {           
            value.bind(function (newval) {   
              document.documentElement.style.setProperty(
                target,
                newval
              );
              if(factor && suffix){ 
                document.documentElement.style.setProperty(
                    target+suffix,
                    pSBC(Number(factor), newval)
                  );
              }
            });
          });
       }
        
    );

}