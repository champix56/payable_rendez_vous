
    function showAddAvailabilityPanel() {
        reset_consultant_add_unavailability();
        //document.querySelector('#rdv_consultant_add_availabilities').style.display = "block";
        jQuery('#rdv_consultant_add_availabilities').slideDown(900);//style.display = "block";
    }
    function reset_consultant_add_availability() {
        //document.querySelector('#rdv_consultant_add_availabilities').style.display = "none";
        jQuery('#rdv_consultant_add_availabilities').slideUp(900);//.style.display = "none";

    }

    function showAddUnAvailabilityPanel() {
        reset_consultant_add_availability();
        document.querySelector('#rdv_consultant_add_unavailabilities').style.display = "block";
    }
    function reset_consultant_add_unavailability() {
        document.querySelector('#rdv_consultant_add_unavailabilities').style.display = "none";

    }
    