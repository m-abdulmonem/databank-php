<?php

use MABDULMONEM\Vendor\Database\Database;

require_once "Database.php";
require_once "migration.php";


$connection = new Database(HOST_NAME,DB_NAME,USERNAME,PASSWORD);

migrate();
if (!$connection->select("*")->from(TB_USERS)->where("id = ? ", 1)->fetch()){
    $connection->data([
        'name' => 'Mohamed Abdul El-Monem',
        'email' => 'abuabdojoker22@gmail.com',
        'username' => 'admin',
        'password' => pass_hash(123456),
        'api_token' => uniqid(string_random(60))
    ])->insert(TB_USERS)->getLastID();
}