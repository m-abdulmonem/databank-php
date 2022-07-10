<?php


/**
 *
 * Login Action
 *
 * @param null $api
 */
function login ($api = false){
    //REQUEST_METHOD
    
    if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['login_submit'])){
        $username = string($_POST['user']);
        $password = string($_POST['pass']);
        $errors = array();

        $get = getUser("username",$username);

        if (empty($username))
            $errors[] = "Username Is Required";
        if (empty($password))
            $errors[] = "Password Is Required";
        if ($get){
            if (!password_verify($password,$get['password']))
                $errors[] = "Password Is Not Matched";
        } else
            $errors[] =  "User Is Incorrect";

        if (!empty($errors)){
            foreach ($errors as $error)
                echo "<p class=\"err-msg\"><i class=\"fa fa-exclamation-circle\"></i> " . $error . "</p>";
        }else {
            setcookie("LOGIN_USER", string_hash($username), time() + 1800, "/");
            setcookie("LOGIN_USER_ID", string_hash($get['id']), time() + 1800, "/");
            setcookie("_X_CSRF_TOKEN_", string_hash(string_random(60)), time() + 1800, "/");
            if ($api)
                return json($get,SUCCESS);
            redirect("home");
        }
    }
}

function user_login($user,$pass){
    $username = string($user);
    $password = string($pass);
    $errors = array();

    $get = getUser("username",$username);

    if (empty($username))
        $errors[] = "Username Is Required";
    if (empty($password))
        $errors[] = "Password Is Required";
    if ($get){
        if (!password_verify($password,$get['password']))
            $errors[] = "Password Is Not Matched";
    } else
        $errors[] =  "User Is Incorrect";

    if (empty($errors))
        return json($get,SUCCESS);

    foreach ($errors as $error)
        return json($error,FAILURE);
}


function user_update(){
    if (request_check()){
        $name = string($_POST['name']);
        $email = string($_POST['email']);
        $username = string($_POST['user']);
        $password = empty(string($_POST['pass'])) ? user("password") :  pass_hash(string($_POST['pass']));
        $errors = array();

        $get = getUser("username",$username);

        if (empty($username))
            $errors[] = "Username Is Required";
        if (empty($email))
            $errors[] = "Email is Required";

        if (empty($errors)){
            update_where([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'username' =>$username
            ],TB_USERS,"api_token",post("api_token"));
            return json(get("api_token",post("api_token"),TB_USERS), SUCCESS,"Update User Successfully");
        }
        foreach ($errors as $error)
            return json($error,FAILURE) ;
    }
}
/**
 * @param null $var
 * @return null|stdClass
 */
function user($var = null){
    return $var ? find(id(),TB_USERS)[$var] : find(id(),TB_USERS) ;
}

/**
 *
 * Logout Action
 */
function logout(){
    if (is_set(getUserCookie()) && is_set(id()))
        remove(getUserCookie(),id());
    redirect("index");
}
