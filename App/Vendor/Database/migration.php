<?php

use MABDULMONEM\Vendor\Database\Database;


/**
 * @return array
 */
function migrate(): array
{
    return [migration(migrate_create_user()),migration(migrate_create_passwords())];
}

/**
 * @return string
 */
function migrate_create_user(): string
{
    $sql  = "CREATE TABLE IF NOT EXISTS  " . TB_USERS . " ( ";
    $sql .= "id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
    $sql .= "name VARCHAR(225) NULL,";
    $sql .= "username VARCHAR(225) NOT NULL,";
    $sql .= "password VARCHAR(225) NOT NULL,";
    $sql .= "api_token VARCHAR(225) NULL,";
    $sql .= "email VARCHAR(225) NOT NULL );";
    return $sql;
}

/**
 * @return string
 */
function migrate_create_passwords(): string
{
    $sql  = "CREATE TABLE IF NOT EXISTS  " . TB_PASSWORDS . " ( ";
    $sql .= "id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
    $sql .= "website VARCHAR(225) NOT NULL,";
    $sql .= "site_name VARCHAR(225) NULL,";
    $sql .= "username VARCHAR(225) NULL,";
    $sql .= "password VARCHAR(225) NOT NULL,";
    $sql .= "user_id INT ,";
    $sql .= "email VARCHAR(225) NOT NULL ";
    $sql .= ");";
    return $sql;
}


/**
 * PDO Class
 * @param $query
 * @return int
 */
function migration($query): int
{
    $con = new Database(HOST_NAME,DB_NAME,USERNAME,PASSWORD);
    return $con->connection()->exec($query);
}