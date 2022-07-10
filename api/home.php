<?php
require_once "../app.php";

if (request_check()){
    if ($user = get("api_token",post("api_token"),TB_USERS)) {
        if (post_check("accounts"))
            echo count(accounts(post("user_id"))) > 0
                ? json(accounts(post("user_id")), SUCCESS, "")
                : json(null, FREE, "Sorry! No Accounts");

        if (post_check("account"))
            echo ($user = find(post("id"), TB_PASSWORDS)) ? json($user, SUCCESS) : json(null, NOT_FOUND);

        if (post_check("add_account"))
            add_pass(post("pass"), post("user"),$_POST['email'], post("url"),$user['id']);

        if (post_check("update_account"))
            update_pass(post("id"), post('url'), post('email'), post('pass'), post('user'),$user['id']);

        if (post_check("delete_account"))
            del_pass(post("id"));

        if (post_check("search"))
            echo count(search(post("keyword"))) > 0 ? json(search(post("keyword")),SUCCESS) : json(null,FREE);

    }else  echo json(null,UNAUTHENTICATED,"Sorry, You should be singed to enter");
}else echo json(null,UNAUTHENTICATED);