<?php

require_once "../app.php";


if (isset($_POST['action']) && $_POST["action"] == "add-pass")
    add_pass($_POST['pass'],$_POST['user'],$_POST['email'],$_POST['url']);

if (isset($_POST['action']) && $_POST["action"] == "get-pass")
    get_pass($_POST['id']);

if (isset($_POST['action']) && $_POST["action"] == "update-pass")
    update_pass($_POST['id'],$_POST['url'],$_POST['email'],$_POST['pass'],$_POST['user']);
if (isset($_POST['action']) && $_POST["action"] == "delete-pass")
    del_pass($_POST['id']);
