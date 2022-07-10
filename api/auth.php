<?php

require_once "../app.php";

if (request_check()){
    /**
     *
     */
    if (post_check("login"))
    {
        $username = string(post("user"));
        $password = string(post("pass"));
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
            return json(['user'=>$get,'api_token'=>$get['api_token']],SUCCESS);

        foreach ($errors as $error)
            return json($error,FAILURE);
    }else{
        if (get("api_token",post("api_token"),TB_USERS)) {

            /**
             *
             */
            if (post_check("get_user"))
                echo json(get("api_token", post("api_token"), TB_USERS), SUCCESS);

            /**
             *
             */
            if (post_check("update_user"))
            {
                if ( $get = get("api_token",post("api_token"),TB_USERS)) {
                    $name = string(post("name"));
                    $email = string(post("email"));
                    $username = string(post("user"));
                    $password = post("pass")
                        ? pass_hash(string(post("pass")))
                        : $get['password'];
                    $errors = array();

                    if (empty($username))
                        $errors[] = "Username Is Required";
                    if (empty($email))
                        $errors[] = "Email is Required";

                    if (empty($errors)) {
                        update_where([
                            'name' => $name,
                            'email' => $email,
                            'password' => $password,
                            'username' => $username,
                            "api_token" => uniqid(string_random(60))
                        ], TB_USERS, "api_token", post("api_token"));
                        echo json(get("api_token", post("api_token"), TB_USERS), SUCCESS, "Update User Successfully");
                    }
                    foreach ($errors as $error)
                        echo json($error, FAILURE);
                }else echo json(null,FREE,"user not exists");
            }

            /**
             *
             */
            if (post_check("show_pass"))
                echo json(string_hash(post("pass"), DECRYPT), SUCCESS);

        } else echo json(null,UNAUTHENTICATED,"Sorry, You should be singed to enter");

    }
} else echo json(null,UNAUTHENTICATED);