<?php
require_once "app.php";
cookie();
temp("header");

$passwords = getPasswords();


?>
<!-- Add Account -->
<div class="modal fade" id="new_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="err-frm-ajax-meg ">
            </div>
            <form id="add-pass-form" role="form" action="" method="post" >
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add-url">Url</label>
                        <div class="form-icon">
                           <input type="url" class="form-control" id="add-url" name="url" value="https://" placeholder="http://example.com">
                            <i class="fa fa-link"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="add-email">Email address</label>
                        <div class="form-icon">
                            <input type="email" class="form-control" id="add-email" name="email" placeholder="name@example.com">
                            <i class="fa fa-envelope"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="add-user">Username</label>
                        <div class="form-icon">
                            <input type="text" class="form-control" id="add-user" name="user" placeholder="example">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="add-pass">Password</label>
                        <div class="form-icon">
                            <input type="password" class="form-control" id="add-pass"  name="pass" placeholder="Password">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn1 btn-del" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-info btn1 btn-edit" id="save-pass-edited" value="Add New">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Account -->
<div class="modal fade" id="edit_account" tabindex="-1" role="dialog" aria-labelledby="edit_account" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="err-frm-ajax-meg">
            </div>
            <form id="edit-pass-form" role="form" action="" method="post" >
                <input type="hidden" name="id" value="" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="url">Url</label>
                        <div class="form-icon">
                            <input type="url" class="form-control" id="url" name="url" value="https://" placeholder="http://example.com">
                            <i class="fa fa-link"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <div class="form-icon">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                            <i class="fa fa-envelope"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user">Username</label>
                        <div class="form-icon">
                            <input type="text" class="form-control" id="user" name="user" placeholder="example">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass-id">Password</label>
                        <div class="form-icon pass" data="" data-o="">
                            <input type="password" class="form-control" id="pass-id" name="pass" placeholder="Password">
                            <i class="fa fa-eye"></i>
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn1 btn-del" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn1 btn-edit" id="update-pass" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Accounts List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="fa fa-home"></i> Home</li>
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
                    <div class="card-header">
                        <span class="card-title">All Accounts</span>
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#new_account"><i class="fa fa-plus"></i> Add</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                     <th>Website</th>
                                     <th>E-Mail</th>
                                     <th>Username</th>
                                     <th>password</th>
                                     <th>actions</th>
                                 </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($passwords as $password) {
                                 ?>
                                 <tr>
                                     <td><a href="<?php echo $password['website']?>" target="_blank"><i class="fa fa-external-link"></i> <?php echo ucfirst(str_replace(["http://","https://",".com",".net"],'',$password['website'])) ?></a>
                                     </td>
                                     <td><?php echo $password['email']?></td>
                                     <td><?php echo $password['username'] ?></td>
                                     <td class="pass" data="<?php echo string_hash($password['password'],"d") ?>" data-o="<?php echo $password['password']?>">
                                         <input type="password" disabled class="input-pass" value="<?php echo $password['password']?>" title="">
                                         <i class="fa fa-eye float-right "></i>
                                     </td>
                                     <td>
                                         <span class="btn btn-info edit-account" data-id="<?php echo $password['id']?>" data-toggle="modal" data-target="#edit_account"><i class="fa fa-edit"></i>Edit</span>
                                         <span class="btn btn-danger delete"  data-id="<?php echo $password['id']?>" data-url="<?php echo ucfirst(str_replace(["http://","https://",".com",".net"],'',$password['website'])) ?>"><i class="fa fa-remove"></i>Delete</span>
                                     </td>
                                 </tr>
                                 <?php
                            }
                            ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Website</th>
                                    <th>E-Mail</th>
                                    <th>Username</th>
                                    <th>password</th>
                                    <th>actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<?php
temp("footer");
?>

