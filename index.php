<?php
ob_start();
require_once "app.php";

cookie("login");

temp("header","no");

?>
<div class="container">
    <div class="container">
        <div class="form-auth-login">
            <img src="<?php echo IMG?>chip%20(4).png">
            <div class="form-login" >
                <span>Login</span>
                <?php login() ?>
                <form method="post" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" >
                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <input type="text" class="user form-control" name="user" placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="pass form-control" name="pass" placeholder="Password" autocomplete="off" required>
                    </div>
                    <input type="submit" name="login_submit" class="btn submit" value="Login">
                    <p>
                        <a href="#" class="a">
                            Forget Password?
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

<?php

temp("footer");
ob_end_flush()
?>