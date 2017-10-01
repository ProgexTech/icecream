
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
if (isset($shipmentId)) {
    $shipment = $this->shipment_model->getShipmentById(base64_decode(urldecode($shipmentId)));
}
?>

<div id="add-shipment-form" class="panel panel-default">
    <div id="login-form-title" class="panel-heading">
        <h4>Edit Shipment</h4>
    </div>
    <div id="form-div" class="panel-body">
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo base_url(); ?>shipment/edit">

            <!--<div class="form-group">-->
            <!--                <label>Order No</label>-->
            <?php //if (isset($order)) : ?>
                            <!--<input class="form-control" type="text" name="orderNo" value="<?php //echo $shipment->orderNo;   ?>" readonly="readonly" />-->
            <?php //else : ?>
                            <!--<input class="form-control" type="text" name="orderNo" />-->
            <?php //endif; ?>
            <!--</div>-->
            <div class="form-group">
                <label>Shipping No</label>
                <input class="form-control" type="text" name="shippingNo" value="<?php echo $shipment->shippingNo ?>"/>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input class="form-control" type="date" name="shipmentDate" id="shipmentDate" value="<?php echo $shipment->shipmentDate ?>"/>
            </div>
            <div id='TextBoxesGroup'>

            </div>
            <div class="form-group">
                <input type="hidden" id="count" value="<?php echo $shipment->id; ?>" name="shipmentId">
                <input type="hidden" id="count" value="<?php echo $shipment->orderId; ?>" name="orderId">
            </div>
            <div class="form-group">
                <input type="submit" value="Update Shipment Data" class="btn btn-primary"/>
            </div>
        </form>
    </div>
</div>

