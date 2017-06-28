<?php

function hasPermission($url) {
    if (!$_SESSION || !isset($_SESSION['permission'])) {
        return FALSE;
    }
    $perm = $_SESSION['permission'];
    if ($perm) {
        $permission = explode(",", $perm);
        if (in_array($url, $permission)) {
            return TRUE;
        }
    }
    return FALSE;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Super Tech Cement | Order Management</title>

        <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>assets/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom.js" type="text/javascript"></script>

<!--        <link href="<php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" />
<link href="<php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" />-->
    </head>
    <body>
        <div id="main-div">
            <div class="navbar navbar-inverse">
                <div class="navbar-inner">
                    <div id="nav-div">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img alt="Brand" src="<?php echo base_url(); ?>assets/images/logo.png"></a>
                        <ul class="nav navbar-nav">
                            <?php if (hasPermission("Orders")) : ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Orders<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url(); ?>view/placeOrder">Add Order</a></li>
                                        <li><a href="<?php echo base_url(); ?>view/viewOrders">View Orders</a></li>
                                        <li><a href="<?php echo base_url(); ?>view/viewStock">View Stock</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if (hasPermission("Purchases")) : ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Purchases<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url(); ?>view/addPO">Add Purchase Order</a></li>
                                        <li><a href="<?php echo base_url(); ?>view/viewPOs">View Purchase Orders</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if (hasPermission("Customers")) : ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Customers<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url(); ?>view/addCustomer">Add New Customer</a></li>
                                        <li><a href="<?php echo base_url(); ?>view/viewCustomers">View Customers</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if (hasPermission("Users")) : ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Users<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url(); ?>view/registerUser">Add New User</a></li>

                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <ul>
                            <a href="alerts.html"> <div class="col-sm-1 col-md-1 col-lg-1 notification-icon" title="Pending POs"> 
                                    <span class="glyphicon glyphicon-tasks" style="color:yellow"></span> 
                                    <span class="badge" id="jt-alarm-count" style="color:red"> <?php
                                        //$CI = &get_instance();
                                        //$CI->load->model('order_model');
                                        //$allOrders = $CI->order_model->getAllOrdersCount();
                                        //echo $allOrders;
                                        echo 1;
                                        ?></span> </div>
                            </a> 
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            $display_name = $this->session->userdata('display_name');
                            $usertype = $this->session->userdata('usertype');
                            $homepage = strtolower($usertype);
                            if (isset($display_name) && !empty($display_name)) :
                                ?>
                                <p class="navbar-text">
                                    <a>
                                        <span class="display-name"><?php echo $display_name; ?></span>
                                    </a>
                                </p>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><b class="caret"></b></a>

                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url(); ?>view/editProfile">Edit Profile</a></li>
                                        <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
                                    </ul>
                                </li>
                            <?php else : ?>
                                <li><a href="<?php echo base_url(); ?>view/login">Login</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="content-div">
                <div class="container-fluid">
                    <div class="row">
                        <?php $this->load->view($main_content); ?>
                    </div>
                </div>

            </div>
            <footer>
                <hr/>
                <p class="text-center">
                    <small>&COPY; Copyright 2017 | Powered by Progex Technologies</small>
                </p>
            </footer>
        </div>

        <!--<script src="<php echo base_url(); ?>assets/js/jquery.min.js"></script>-->
<!--        <script src="<php echo base_url(); ?>assets/js/jquery.js" type="text/javascript"></script>
        <script src="<php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
        <script src="<php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<php echo base_url(); ?>assets/js/custom.js" type="text/javascript"></script>-->
    </body>
</html>