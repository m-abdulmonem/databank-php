<?php


/**
 * @return array|null|stdClass
 */
function getPasswords(){
    return getAll("passwords");
}

/**
 * @param null $id
 * @return array|null|stdClass
 */
function accounts($id = null){
    return all($id,"user_id");
}

function get_pass($id){
    echo json(["user"=>find($id,TB_PASSWORDS),"pass"=>string_hash(find($id,TB_PASSWORDS)['password'],DECRYPT)],1);
}

/**
 * @param $pass
 * @param $user
 * @param $email
 * @param $url
 * @param null $id
 */
function add_pass($pass,$user,$email,$url,$id = null){

    $errors = array();
    $pass  = string_hash($pass);
    $email = email($email);
    $user  = string($user);
    $url   = url_validate($url);
    $id    = $id ? $id : id();
    $name = ucfirst(str_replace([
        "http://",
        "https://",
        ".com",
        ".net",
        ".org",
        ".io",
        ".int",
        ".edu",
        ".gov",
        ".mil",
        ".arpa",
//        ".",
    ],'',$url));



    if (empty($pass) && empty($url) && empty($email))
        $errors[] = "fields required";
    if (empty($pass))
        $errors[] = "Password required";
    if (empty($url))
        $errors[] = "Website Required";
    if (empty($email))
        $errors[] = "Email Required";
    if ( !is_email($email))
        $errors[] = NOT_EMAIL;
    if (! is_url($url))
        $errors[] = "Is not URl";

    if (empty($errors)) {
        echo($insert_pass = insert([
            "site_name" => $name,
            "website"  => $url,
            "email"    => $email,
            "username" => $user,
            "password" => $pass,
            "user_id"  => $id,
        ],TB_PASSWORDS))
            ? json((array)$insert_pass,SUCCESS,"Successfully Inserted")
            : json(null,FAILURE,"Sorry!You have an error");
    }
    else{

        foreach ($errors as $error) {
            echo json(null,FAILURE,$error);
        }
    }


    return;
}

/**
 * @param $id
 * @param $url
 * @param $email
 * @param $pass
 * @param $user
 * @param null $user_id
 */
function update_pass($id,$url,$email,$pass,$user,$user_id=null){
    $errors = array();

    $account = find($id,TB_PASSWORDS);
    $pass  = post("pass") ? string_hash(post("pass")) : $account['password'];
    $email = email($email);
    $user  = string($user);
    $url   = url_validate($url);
    $user_id = $user_id ? $user_id: id();

    if (empty($pass) && empty($url) && empty($email))
        $errors[] = "fields required";
    if (empty($pass))
        $errors[] = "Password required";
    if (empty($url))
        $errors[] = "Website Required";
    if (empty($email))
        $errors[] = "Email Required";
    if ( !is_email($email))
        $errors[] = NOT_EMAIL;
    if (! is_url($url))
        $errors[] = "Is not URl";

    if (empty($errors)) {
        echo( update([
            "website"  => $url,
            "email"    => $email,
            "username" => $user,
            "password" => $pass,
            "user_id"  => $user_id,
        ],TB_PASSWORDS,$id))
            ? json(null,1,"Successfully update")
            : json(null,0,"Sorry!You have an error");
    } else{

        foreach ($errors as $error) {
            echo json($error,0,"");
        }
    }
}


function search($keyword,$table = TB_PASSWORDS){
    $query = connection()->connection()
        ->prepare("SELECT * FROM $table WHERE email LIKE :email AND website LIKE :website AND username LIKE :username");
    $query->bindValue('email', "%$keyword%");
    $query->bindValue('website', "%$keyword%");
    $query->bindValue('username', "%$keyword%");
    $query->execute();
    return $query->fetchAll();
}

/**
 * @param $id
 */
function del_pass($id){
    echo find($id,TB_PASSWORDS)
        ? delete($id,TB_PASSWORDS)
            ? json(null,1,"Account Deleted Successfully")
            : json(null,1,"you have an error")
        : json(null, 0 , "account doest exists") ;
}