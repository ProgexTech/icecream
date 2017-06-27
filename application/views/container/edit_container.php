<script type="text/javascript">

    $(function () {
        $("#unloadingDate").datepicker({
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

<div>
    <?php 
 $container = $this->container_model->getContainerById(base64_decode(urldecode($containerId)));
 ?>
    <legend>Edit Container</legend>
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>container/edit">
        <input type="hidden" name="containerId" value="<?php echo $containerId ?>" />
         <input type="hidden" name="shipmentId" value="<?php echo $shipmentId; ?>" />
        <div class="form-group">
            <label for="shippingNo">Shipping No</label>
                <input type="text" class="form-control" id="shippingNo" name="shippingNo" value="<?php echo $shipment->shippingNo; ?>" readonly="readonly" size="12px" />
        </div>
        &nbsp;
        <div class="form-group">
            <label for="contCode">Cont.Code</label>
            <input type="text" class="form-control" id="contCode" name="contCode" value="<?php echo $container->contCode; ?>" />
        </div>
        &nbsp;
        <div class="form-group">
            <label for="mWeek">Man.Week</label>
            <input type="text" class="form-control" id="mWeek" name="mWeek" size="10px"  value="<?php echo $container->mWeek;?>" />
        </div>
        &nbsp;
        <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="number" class="form-control" id="qty" name="qty" size="8px"  value="<?php echo $container->qty;?>" />
        </div>
        &nbsp;   
        <div class="form-group">
        <label for="unloadingDate">Unloading Date</label>
        <input type="text" class="form-control" id="unloadingDate" name="unloadingDate" size="10px"  value="<?php echo $container->unloadingDate;?>" />
        </div>
        &nbsp;
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

