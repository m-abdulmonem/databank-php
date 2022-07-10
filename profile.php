<?php
require_once "app.php";
cookie();
temp("header");

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Home</a> </li>
                        <li class="breadcrumb-item"><i class="fa fa-user"></i> Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <?php user_update() ?>
                        <form action="<?php server("php_self") ?>" method="post">
                            <div class="form-group">
                                <label for="name">Email address</label>
                                <div class="form-icon">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?php echo user("name") ?>">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <div class="form-icon">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo user("email") ?>">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user">Username</label>
                                <div class="form-icon">
                                    <input type="text" class="form-control" id="user" name="user" placeholder="example" value="<?php echo user("username") ?>">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass-id">Password</label>
                                <div class="form-icon pass" data="" data-o="">
                                    <input type="password" class="form-control" id="pass-id" name="pass" placeholder="Password" >
                                    <i class="fa fa-eye"></i>
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-group p1">
                                <button class="btn btn-info " type="submit"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<?php
temp("footer");
?>
