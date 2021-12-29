document.addEventListener('DOMContentLoaded', function() {
    const select=document.querySelector('#client_take_apointment_select_consultant');
    //debugger;
    if(undefined!=select){
        //console.log(select);
        select.addEventListener('change',getConsultantDatas);
    }
    const selectPresta=document.querySelector('#client_take_apointment_select_prestation_type');
    //debugger;
    if(undefined!=select){
        //console.log(select);
        selectPresta.addEventListener('change',getPrestationTypeDatas);
    }
});
function getConsultantDatas(evt) {
    const block =   
    document.querySelector('.consultant-viewer');
    const infos=block.querySelector('.infos');
    infos.innerHTML="";
    block.querySelector('img').src=adminMenuBaseUrl()+'/wp-content/plugins/payable_rendez_vous/img/loading.svg';
    
    wpAdminFetch("/wp-json/rdv_plugin/v1/consultants/"+evt.target.value)
        .then(f=>f.json())
        .then(r=>{
            console.log(r);
            block.querySelector('img').src=r.avatar;
            if(r.availabilities.length===0)infos.innerHTML="<h5>Aucunes dispos</h5>";
            else {
                infos.innerHTML="<h4>Liste des dispos:</h4>";
                let lastDayTreat=0;
                const tb=document.createElement('table');
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