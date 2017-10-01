<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="login-form" class="panel panel-default">
    <div id="login-form-title" class="panel-heading">
        <h4>Login</h4>
    </div>
    <div id="form-div" class="panel-body">
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo base_url(); ?>user/login">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="uName" placeholder="Enter Username" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password"/>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" class="btn btn-primary"/>
            </div>
        </form>        
    </div>
</div>

<br/>

<a href="<?php echo base_url(); ?>">Back to Home</a>
