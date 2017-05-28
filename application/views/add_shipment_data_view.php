<div id="add-shipment-form" class="panel panel-default">
    <div id="login-form-title" class="panel-heading">
        <h4>Add New Shipment</h4>
    </div>
    <div id="form-div" class="panel-body">
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo base_url(); ?>shipment/addShipment">
            <div class="form-group">
                <label>Shipping Id</label>
                <input class="form-control" type="text" name="shippingId" />
            </div>
            <div class="form-group">
                <label>Order No</label>
                <input class="form-control" type="text" name="orderNo" />
            </div>
            <div class="form-group">
                <label>Date</label>
                <input class="form-control" type="date" name="date" />
            </div>
            <div class="form-group">
                <label>Manufacturing Week</label>
                <input class="form-control" type="text" name="mWeek" />
            </div>
            <div id='TextBoxesGroup'>
                <div id="TextBoxDiv1">
                     <input type="hidden" id="count" value="0" name="count">
                    <label>Container #1 (Quantity): </label><input name="container1" type='number' id='container1' >
                    <input type='button' value='Add Button' id='addButton' class="btn btn-primary">
                    <input type='button' value='Remove Button' id='removeButton' class="btn btn-primary">
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Save Shipment Data" class="btn btn-primary"/>
            </div>
        </form>
    </div>
</div>