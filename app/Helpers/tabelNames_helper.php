<?php

/**
     * little helper for formating table names
     *
    
     */
function tabname_f($name){
  return  str_replace('_',' ',ucfirst($name));
}