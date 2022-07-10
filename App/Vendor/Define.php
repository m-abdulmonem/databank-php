<?php
/**
 * Created by PhpStorm.
 * User: Mohamad Abdul Monem
 * Date: 12/3/2018
 * Time: 1:53 AM
 */


/***
 *
 *  Errors Code
 *
 */
if (! defined("NOT_STRING"))
    define("NOT_STRING","Is not matching STRING");
if (! defined("NOT_UNIQUE"))
    define("NOT_UNIQUE","not matching UNIQUE");
if (! defined("NOT_EMAIL"))
    define("NOT_EMAIL","Is not EMAIL");
if (! defined("ERR_NULL"))
    define("ERR_NULL","Sorry The Input Is NULL");
if (! defined("NOT_INT"))
    define("NOT_INT","Input is not INTEGER");
if (! defined("NOT_URL"))
    define("NOT_URL","Input is not URL");

/***
 *
 *
 *
 *
 * Database Auth
 */

if (!defined("HOST_NAME")){
    define("HOST_NAME", "localhost");
}
if (!defined("DB_NAME")){
    define("DB_NAME", "databank");
}
if (!defined("USERNAME")){
    define("USERNAME", "root");
}
if (!defined("PASSWORD")){
    define("PASSWORD", "");
}

/***
 *
 * Status Code
 *
 */
if (! defined("FREE"))
    define("FREE",101);
if (! defined("NOT_FOUND"))
    define("NOT_FOUND",404);
if (! defined("SUCCESS"))
    define("SUCCESS",1);
if (! defined("FAILURE"))
    define("FAILURE",0);
if (!defined("UNAUTHENTICATED"))
    define("UNAUTHENTICATED",500);
/***
 *
 *
 * Database Tables
 *
 *
 */
if (!defined("TB_PASSWORDS")){
    define("TB_PASSWORDS", "passwords");
}
if (!defined("TB_USERS")){
    define("TB_USERS", "users");
}
if (!defined("TB_SITE_SETTINGS")){
    define("TB_SITE_SETTINGS", "settings");
}
if (!defined("TB_CATEGORIES")){
    define("TB_CATEGORIES", "categories");
}


/***
 *
 *
 * Files Dir
 *
 *
 */
const HEADER = "App/Views/site/header.php";
const FOOTER = "App/Views/site/footer.php";
const HEAD = "App/Views/site/head.php";
const DIR_PUBLIC = "Public/assts/";
const CSS = DIR_PUBLIC . "css/";
const JS = DIR_PUBLIC . "js/";
const IMG = DIR_PUBLIC . "img/";


/***
 *
 *
 * Encrypt and Decrypt
 *
 *
 */

if (! defined("ENCRYPT"))
    define("ENCRYPT","e");
if (! defined("DECRYPT"))
    define("DECRYPT","d");
