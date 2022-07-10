<!-- Modal -->
<div class="modal fade" id="about-me-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">About ME</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="personal-data">
                    <img class="about-me-img-model" src="<?php echo IMG ?>me2.jpg">
                    <span>Mohamed Abdul El-Moniem Khairy</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn1 btn-edit" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>





<div class="header-top">
    <div class="col-6">
        <p class="logo">
            <img src="<?php echo IMG?>chip%20(2).png"> <span>DataBank</span>
        </p>
    </div>
    <div class="col-6 ">
        <ul class="menu">
            <li><i class="fa fa-home"></i> <a href="home.php">Home</a></li>
            <li><i class="fa fa-list"></i> <a href="categories.php"> Categories</a> </li>
            <li class="about-me" data-toggle="modal" data-target="#about-me-model"><i class="fa fa-info-circle"></i> About Me</li>
            <li class="user-drop-down">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle user-dropd" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><img src="<?php echo IMG ?>avatar.png"> <?php echo getUserCookie() ?></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i>  My Account</a>
                        <a class="dropdown-item" href="settings.php"><i class="fa fa-cogs"></i>  Settings</a>
                        <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>  Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>