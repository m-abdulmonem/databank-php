<?php
ob_start();
require_once "app.php";
cookie("logout");
if (is_set(getUserCookie())&& is_set(id()))
    logout();
else
    redirect("index");

ob_end_flush();