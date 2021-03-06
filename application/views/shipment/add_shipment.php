<script type="text/javascript">

    $(function() {
        $("#shipmentDate").datepicker({
            dateFormat: "yy-mm-dd",
            yearRange: "c-90:c",
            changeMonth: true,
            changeYear: true
        });
    });

</script>

<?php
if (isset($orderId)) {
    $order = $this->order_model->getOrderById(base64_decode(urldecode($orderId)));
}
?>

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

        <form method="post" action="<?php echo base_url(); ?>shipment/add">

            <div class="form-group">
                <label>Order No</label>
                <?php if (isset($order)) : ?>
                    <input class="form-control" type="text" name="orderNo" value="<?php echo $order->orderNo; ?>" readonly="readonly" />
                <?php else : ?>
                    <input class="form-control" type="text" name="orderNo" />
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Shipping No</label>
                <input class="form-control" type="text" name="shippingNo" />
            </div>
            <div class="form-group">
                <label>Date</label>
                <input class="form-control" type="date" name="shipmentDate" id="shipmentDate" />
            </div>
            <div class="form-group">
                <label>Manufacturing Week</label>
                <input class="form-control" type="text" name="mWeek" />
            </div>
            <div class="form-group">
                <input type='button' value='Add Container' id='addButton' class="btn btn-success">
            </div>
            <div id='TextBoxesGroup'>

            </div>
            <div class="form-group">
                <input type="hidden" id="count" value="0" name="count">
            </div>
            <div class="form-group">
                <input type="submit" value="Save Shipment Data" class="btn btn-primary"/>
            </div>
        </form>
    </div>
</div>