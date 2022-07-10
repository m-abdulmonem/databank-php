<?php

function enLang($word){

    $ar = array(
        "PASSWORD_ERROR_0" => "Password No Match",
        "USERNAME_ERROR_0" => "Invalid Username Or Incorrect",
        "WELCOME"          => "Welcome to you",
        "AUTH_1"          => "1",
        "" => "",
    );

    return $ar[$word];
}