<?php
$uId = $this->session->userdata('user_id');
$user = $this->user_model->getUserById($uId);
?>

<div id="add-order-form" class="panel panel-default">
    <div id="login-form-title" class="panel-heading">
        <h4>Edit User</h4>
    </div>
    <div id="form-div" class="panel-body">
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo base_url(); ?>user/editUser">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="<?php echo $user->name; ?>"/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="text" name="email" value="<?php echo $user->email; ?>"/>
            </div>
            <!--    <div class="form-group">
                    <label>NIC</label>
                    <input class="form-control" type="text" name="nic" />
                </div>
                <div class="form-group">
                    <label>Phone 1</label>
                    <input class="form-control" type="text" name="phone" />
                </div>
                <div class="form-group">
                    <label for="description">Address</label>
                    <textarea class="form-control" rows="3" name="address"></textarea>
                </div>-->
            <div class="form-group">
                <label for="description">Username</label>
                <input  class="form-control"  type="text" name="uName" value="<?php echo $user->uName; ?>"/>
            </div>
            <div class="form-group">
                <label for="description">Password</label>
                <input class="form-control" type="password" name="password"/>
            </div>
            <!--    <div class="form-group">
                    <label>Role</label>
                    <select name="role">
                     //<?php
            //            $roles =  $this->role_model->getAllRoles();
            //            foreach ($roles as $role)
            //            {
            //                echo '<option  value="'.$role['id'] .'" >'. $role['name'].'</option>';
            //            }
            //            
            ?>
                        </select>
                </div>-->
            <div class="form-group">
                <input type="submit" value="Update Profile" class="btn btn-primary"/>
            </div>
        </form>
    </div>
</div>