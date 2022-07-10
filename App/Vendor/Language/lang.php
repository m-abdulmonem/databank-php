<?php
require_once "ar.php";
require_once "en.php";

function setLanguage(String $Language){
    if (!defined("MO_APP_LANGUAGE"))
        define("MO_APP_LANGUAGE",$Language);
}

function getLanguage(){
    return MO_APP_LANGUAGE;
}
function lang(String $word){
    $word = strtoupper($word);
    if (MO_APP_LANGUAGE == "ar")
        return ar($word);
    elseif (MO_APP_LANGUAGE == "en")
        return en($word);
    else
        return en($word);
}

function ar($word){

}


function en($word){
    return enLang($word);
}
