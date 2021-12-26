<?php
/**
 * 
 */
function nameOfDayOfWeek($num)
{
    $day = "";
    switch ($num) {
        case 1:
            $day = 'Lundi';
            break;
        case 2:
            $day = 'Mardi';
            break;
        case 3:
            $day = 'Merdredi';
            break;
        case 4:
            $day = 'Jeudi';
            break;
        case 5:
            $day = 'Vendredi';
            break;
        case 6:
            $day = 'Samedi';
            break;
        case 7:
            $day = 'Dimanche';
            break;

        default:
            $day="inconnu";
            break;
    }
    return $day;
}
?>