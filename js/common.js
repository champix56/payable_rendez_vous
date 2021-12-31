/**
 * 
 * @param {string} adr adress to fetch
 * @param {GET|POST|DELETE|PUT|PATCH|OPTION} method fetch http method
 * @param {string} body stringified content
 * @returns Promise
 */
function wpAdminFetch(adr,method='GET',body=undefined){
    return fetch(adminMenuBaseUrl()+adr,{
        headers:{
            'X-WP-Nonce':wpApiSettings.nonce
        },
        body:body,
        method:method
    });
}
function adminMenuBaseUrl(){
    const fullAdr=location.href;
    return fullAdr.substring(0,fullAdr.indexOf('/wp-admin'));

}/**
 * name of day
 * @param {number} dayOfWeekNumber 
 * @returns string
 */
function getNameOfDay(dayOfWeekNumber) {
    switch (dayOfWeekNumber) {
        case 1:return 'Lundi';
        case 2:return 'Mardi';
        case 3:return 'Mercredi';
        case 4:return 'Jeudi';
        case 5:return 'Vendredi';
        case 6:return 'Samedi';
        case 7:return 'Dimanche';
        default:
            return '';
    }
}
function hideMessageBox() {
   document.querySelector('#message').style.display='none';
  
}
function ShowMessageBox(message)
{
    const msgBox=document.querySelector('#message');
    if(!msgBox){console.log("Not message box defined in page");return null;}
    msgBox.querySelector('p').innerHTML=message;
    if(msgBox.style.display!=='block')jQuery('#message').slideDown();
}
function appendMessageBox(message) {
    const msgBox=document.querySelector('#message');
    if(!msgBox){console.log("Not message box defined in page");return null;}
    msgBox.querySelector('p').innerHTML+=message;
    if(msgBox.style.display!=='block')jQuery('#message').slideDown();
}
function initDisableableForm(formID,callback=undefined) {
   const form= document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form#'+formID).addEventListener('submit',function (evt) {
            if(form.querySelector('button[type="submit"]').disabled || form.disabled){evt.preventDefault();return}
            if(callback){evt.preventDefault();callback(evt);return;}
        });
    });
}
