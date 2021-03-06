<?php
$allCustomerTypes = $this->customer_model->getAllCustomerTypes();
?>

<div id="add-order-form" class="panel panel-default">
    <div id="login-form-title" class="panel-heading">
        <h4>Add New Customer</h4>
    </div>
    <div id="form-div" class="panel-body">
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo base_url(); ?>customer/add">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" />
            </div>
            <div class="form-group">
                <label>Code</label>
                <input class="form-control" type="text" name="code" />
            </div>
            <div class="form-group">
                <label>Type</label>
                <select class="form-control" name="type">
                    <?php foreach ($allCustomerTypes as $type) :  ?>
                        <option value="<?php echo $type->id; ?>"><?php echo $type->code . ' - ' . $type->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Company</label>
                <input class="form-control" type="text" name="company" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3" name="description"></textarea>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input class="form-control" type="text" name="phone" />
            </div>
            <div class="form-group">
                <input type="submit" value="Add" class="btn btn-primary"/>
            </div>
        </form>
    </div>
</div>