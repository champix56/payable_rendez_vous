function getConsultants(){
    fetch('http://localhost/c/wp-json/rdv_plugin/v1/consultants',{
        headers:{
            'X-WP-Nonce':wpApiSettings.nonce
        }
    }).then(
        f=>f.json(),f=>{console.log(f);return {}}
    ).then(r=>{
   // document.querySelector(".rdv_custom_menu").append(JSON.stringify(r))
   console.log(r);
        
    });
}