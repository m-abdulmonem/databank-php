<?php
use \MABDULMONEM\Vendor\Database\Database;
//require_once "../Database/Connection.php";

/**
 * @return Database
 */
function connection(): Database
{
    return new Database(HOST_NAME,DB_NAME,USERNAME,PASSWORD);
}

/**
 * @param $table
 * @return array|false
 */
function getAll($table){
    return connection()->fetchAll($table);
}

/**
 * @param string $table
 * @param null $column
 * @param null $data
 * @return array|false
 */
function all($data=null, $column = null, string $table = TB_PASSWORDS){
    return connection()->select("*")->from($table)->where($column ? $column : "id" . " = ?",$data)->fetchAll();
}

/**
 * @param $column
 * @param $value
 * @return null|stdClass
 */
function getUser($column,$value){
    $value = string($value);
    return connection()->select("*")->from(TB_USERS)->where($column . ' = ?',$value)->fetch();
}

/**
 * @return null|stdClass
 */
function getSetUser(){
    return getUser("username",getUserCookie());
}

/**
 * @param $column
 * @param $data
 * @param $table
 * @return null|stdClass
 */
function get($column,$data,$table){
    return connection()->select("*")->from($table)->where($column . " = ?",$data)->fetch();
}

/**
 * @param $id
 * @param $table
 * @return null|stdClass
 */
function find($id,$table){
    return connection()->select("*")->from($table)->where("id = ? ", $id)->fetch();
}

/**
 * @param array $param
 * @param $table
 * @return Exception|int|SQLiteException
 */
function insert(array $param = [], $table=null){
    try{
        return connection()->data($param)->insert($table)->getLastID();
    }catch (SQLiteException $SQLiteException){
        return $SQLiteException;
    }
}

/**
 * @param array $param
 * @param $table
 * @param null $id
 * @return Database
 */
function update(array $param = [], $table=null, $id = null): Database
{
    return connection()->data($param)->where("id = ? ",$id)->update($table);
}

/**
 * @param array $param
 * @param $table
 * @param null $column
 * @param null $val
 * @return Database
 */
function update_where(array $param = [], $table=null, $column = null, $val = null): Database
{
    return connection()->data($param)->where("$column = ? ",$val)->update($table);
}

/**
 * @param $id
 * @param $table
 * @return Database
 */
function delete($id,$table): Database
{
    return connection()->where('id = ?', $id)->from($table)->delete();
}
