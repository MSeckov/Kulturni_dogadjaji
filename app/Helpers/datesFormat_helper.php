<?php

/**
     * helper for formating dates from database using setings only for Serbia time
     *
    
     */

function date_f($object,$column1,$column2){
    setlocale(LC_TIME, array('sr_RS.UTF-8','sr_RS@euro','sr_RS','serbian'));
    $date_od = $object->$column1;
    $date_do = $object->$column2;
    if($date_od != $date_do){
        if(date('Y',strtotime($date_od)) == date('Y',strtotime($date_do))){
            if(date('M',strtotime($date_od)) == date('M',strtotime($date_do))){
            echo strftime("%d.", strtotime($date_od)).'- '.strftime("%d.%B %Y", strtotime($date_do));}
            else {
                echo strftime("%d.%B", strtotime($date_od)).'- '.strftime("%d.%B %Y", strtotime($date_do));
            }
        }
    else {
        echo strftime("%d.%B %Y", strtotime($date_od)).'- '.strftime("%d.%B %Y", strtotime($date_do));
    }
    }
    else {
        echo strftime("%d.%B %Y", strtotime($date_do));
    }
}