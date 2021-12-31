'use strict';
let availabilities=[];
let unavailabilities=[];
let prestaIsOpen=false;
let datetimeIsOpen=false;
document.addEventListener('DOMContentLoaded', function() {
    const select=document.querySelector('#client_take_apointment_select_consultant');
    //debugger;
    if(undefined!=select){
        //console.log(select);
        select.addEventListener('change',getConsultantDatas);
    }
    const selectPresta=document.querySelector('#client_take_apointment_select_prestation_type');
    //debugger;
    if(undefined!=selectPresta){
        //console.log(select);
        selectPresta.addEventListener('change',getPrestationTypeDatas);
    }
    const selectDate=document.querySelector('#client_take_apointment_date');

    if(undefined!=selectDate){
        //console.log(select);
       // debugger;

        selectDate.addEventListener('change',getDateTimeValidity);
    }
    const selectTime=document.querySelector('#client_take_apointment_time');

    if(undefined!=selectTime){
        //console.log(select);
       // debugger;

        selectTime.addEventListener('change',getDateTimeValidity);
    }
});
function getDateTimeValidity(evt) {
    const selectDate=document.querySelector('#client_take_apointment_date');
    const selectTime=document.querySelector('#client_take_apointment_time');
    //suppr.des class invalids
    selectTime.classList.remove('maybe-invalid-input','invalid-input');
    selectDate.classList.remove('maybe-invalid-input','invalid-input');
    hideMessageBox();
    const dateValue=selectDate.value;
    const timeValue=selectTime.value;
     //get day of week 0->6
     let dayOfWeek=moment(dateValue).format('e');
     //translate 0(sunday) to 6(saturday) -> 1(monday) to 7(sunday)
     dayOfWeek=(dayOfWeek==0)?7:Number(dayOfWeek);
    const timeParsable=Date.parse('1970-01-01T'+timeValue);
    const datetimeIsOk=checkAvailability(dateValue,timeValue);
    //isAvailable=typeof datetimeIsOk !== Object ? datetimeIsOk :-2;
    //si -1 pas dispo
    //pas dans les dispo
    if(-1===datetimeIsOk )//&& !isNaN(timeParsable))
    {
            selectDate.classList.add('invalid-input');
            selectTime.classList.add('invalid-input') ;
            isNaN(timeParsable)?
            ShowMessageBox(`<h3>ATTENTION</h3>Indisponibilité le ${getNameOfDay(dayOfWeek)}<br/>`)
            :ShowMessageBox(`<h3>ATTENTION</h3>Indisponibilité le ${getNameOfDay(dayOfWeek)} à ${timeValue}<br/>`);
            ;
    }
    else if(typeof datetimeIsOk === 'object' && !isNaN(timeParsable))
    {
            selectDate.classList.add('invalid-input');
            selectTime.classList.add('invalid-input') ;

            ShowMessageBox(`<h3>ATTENTION</h3>Indisponibilité du ${moment(datetimeIsOk.start).format('yyyy-MM-DD HH:mm:ss')} à ${moment(datetimeIsOk.end).format('yyyy-MM-DD HH:mm:ss')}<br/>`);
    } 
    else if(typeof datetimeIsOk === 'object' && isNaN(timeParsable))
    {
            selectDate.classList.add('maybe-invalid-input');
            selectTime.classList.add('maybe-invalid-input') ;

            ShowMessageBox(`<h3>ATTENTION</h3>Indisponibilité du ${moment(datetimeIsOk.start).format('yyyy-MM-DD HH:mm:ss')} à ${moment(datetimeIsOk.end).format('yyyy-MM-DD HH:mm:ss')}<br/>`);
    } 
    
    if(!isNaN(timeParsable) && datetimeIsOk ===1){
     
          if(!prestaIsOpen)jQuery('#client_take_apointment_presta_block').animate({width:'toggle'},400,'swing',()=>{prestaIsOpen=true});
        
    }
    else{
            if(prestaIsOpen)jQuery('#client_take_apointment_presta_block').animate({width:'toggle'},400,'swing',()=>{prestaIsOpen=false});
    }
}
/**
 * check if date and time is in unavailabilities 
 * @date {2021-12-31}
 * @param {any} date date inpit value
 * @param {any} time time input value
 * @returns {number|undefined}  undefined when (can be not available when it'll complet (date only gave) OR if in unavailability), -1 if not in availability OR undefined date undefined impossible to check OR 1 if in availabilities and not in unavailaties
 */
function checkAvailability(date,time, avails=availabilities, unavails=unavailabilities) {
    //no date can be check
    if(isNaN(Date.parse(date)))return undefined;
    //get day of week 0->6
    let dayOfWeek=Number(moment(date).format('e'));
    //translate 0(sunday) to 6(saturday) -> 1(monday) to 7(sunday)
    dayOfWeek=(dayOfWeek==0)?7:dayOfWeek;
    //is date and time parseable 
    const parsedDateAndTime=Date.parse(date+'T'+time);
    
    //check if day of week and time? is available
    const isAvail=avails.find(e=>{
        let isAvailable=dayOfWeek==Number(e.day_of_week);
        //if day not available
        if(!isAvailable)return false; 
        //si time not parsable whereas day available
        if(isNaN(parsedDateAndTime))return true;

        //generique time for checking only time
        const parsedTime = Date.parse('1970-01-01T'+time)
        //only time between start and end
        return Date.parse('1970-01-01T'+e.time_start) <= parsedTime && parsedTime <= Date.parse('1970-01-01T'+e.time_end);
    })
    
    const isUnAvail=unavails.find(e=>{
        //if no time
        if(isNaN(parsedDateAndTime)){
           const parsedDate=Date.parse(date+'T12:00:00');
           const start= Date.parse(e.start.substring(0,10));
           const end= Date.parse(e.end.substring(0,10)+'T23:59:59');
           //date at 12:00 is between start and end
           return start < parsedDate && parsedDate < end;
        }
        else{
            const start= Date.parse(e.start);
            const end= Date.parse(e.end);
            //date at 12:00 is between start and end
            return start < parsedDateAndTime && parsedDateAndTime < end;
        }
    });
    //if 
    if(isAvail && ! isUnAvail)return 1;
    if(isUnAvail)return isUnAvail;
    if(!isAvail )return -1;
    return 0;
}
function getConsultantDatas(evt) {
    const block =   
    document.querySelector('.consultant-viewer');
    const infos=block.querySelector('.infos');
    infos.innerHTML="";
    block.querySelector('img').src=adminMenuBaseUrl()+'/wp-content/plugins/payable_rendez_vous/img/loading.svg';
    if(evt.target.value==='-1'){
        if(prestaIsOpen)jQuery('#client_take_apointment_presta_block').animate({width:'toggle'},400,'swing',()=>{prestaIsOpen=false});
        if(datetimeIsOpen)jQuery('#client_take_apointment_datetime_block').animate({width:'toggle'},400,'swing',()=>{datetimeIsOpen=false})
        return;
    }
    wpAdminFetch("/wp-json/rdv_plugin/v1/consultants/"+evt.target.value)
        .then(f=>f.json())
        .then(r=>{
            console.log(r);
            block.querySelector('img').src=r.avatar;
            if(r.availabilities.length===0){
                if(prestaIsOpen)jQuery('#client_take_apointment_presta_block').animate({width:'toggle'},400,'swing',()=>{prestaIsOpen=false});
        if(datetimeIsOpen)jQuery('#client_take_apointment_datetime_block').animate({width:'toggle'},400,'swing',()=>{datetimeIsOpen=false})
                infos.innerHTML="<h5>Aucunes dispos</h5>";}
            else {
                infos.innerHTML="<h4>Liste des dispos:</h4>";
                let lastDayTreat=0;
                const tb=document.createElement('table');
                availabilities=r.availabilities;
                unavailabilities=r.unavailabilities;
                r.availabilities.map(element => {
                    let row=document.createElement('tr');
                    const firstCol=document.createElement('th');
                    if(lastDayTreat!==parseInt(element.day_of_week))
                    {
                        firstCol.innerHTML=getNameOfDay(parseInt(element.day_of_week));
                    }
                    else 
                    {
                        firstCol.innerHTML='&nbsp;';

                    }
                    row.append(firstCol);
                    const secCol=document.createElement('td');
                    secCol.innerHTML=" de "+element.time_start+" à "+element.time_end;
                    row.append(secCol);
                    tb.append(row);
                    lastDayTreat=parseInt(element.day_of_week);
                });
                infos.append(tb);
                if(!datetimeIsOpen)jQuery('#client_take_apointment_datetime_block').animate({width:'toggle'},400,'swing',()=>{datetimeIsOpen=true});
            }
            infos.style.display="block";
        })
}
function getPrestationTypeDatas(evt) {
     const loadingImg=document.querySelector('.loading-prestation-container');
     loadingImg.style.display="block";
     const infos = document.querySelector('.presta-infos'); 
     infos.style.display="none";
    infos.innerHTML="";
   
    wpAdminFetch("/wp-json/rdv_plugin/v1/prestations/"+evt.target.value)
        .then(f=>f.json())
        .then(r=>{
            console.log(r);

                infos.innerHTML=`<div class="flex" style="justify-content: space-between;">
                <div><h5>Prix</h5>${r.montant}&euro;</div>
                <div><h5>temps nominal</h5>${r.temps_nominal}</div>
            </div>
            <h5>Description</h5>${r.description}`;
            jQuery('.loading-prestation-container').fadeOut(700);
            setTimeout(()=>infos.style.display="block",700)
            ;
        });
}
initDisableableForm('client_take_apointment_form');