<script type="text/javascript">

    $(function() {
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

<?php $stores = $this->store_model->getAllStores(); ?>

<div>
    <?php $container = $this->container_model->getContainerById(base64_decode(urldecode($containerId))); ?>

    <legend>Edit Container</legend>
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>container/edit">
        <input type="hidden" name="containerId" value="<?php echo $containerId ?>" />
        <input type="hidden" name="shipmentId" value="<?php echo $shipmentId; ?>" />

        <div class="row">
            <div class="form-group col-md-4"> 
                <label for="shippingNo" class="fixed-width-110">Shipping No</label>
                <input type="text" class="form-control" id="shippingNo" name="shippingNo" value="<?php echo $shipment->shippingNo; ?>" readonly="readonly" size="12px" />
            </div>        
            <div class="form-group col-md-4">
                <label for="contCode" class="fixed-width-110">Cont.Code</label>
                <input type="text" class="form-control" id="contCode" name="contCode" value="<?php echo $container->contCode; ?>" />
            </div>
            <div class="form-group col-md-4">
                <label for="mWeek" class="fixed-width-110">Man.Week</label>
                <input type="text" class="form-control" id="mWeek" name="mWeek" size="10px"  value="<?php echo $container->mWeek; ?>" />
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="qty" class="fixed-width-110">Quantity</label>
                <input type="number" class="form-control" id="qty" name="qty" size="8px"  value="<?php echo $container->qty; ?>" />
            </div>
            <div class="form-group col-md-4">
                <label for="unloadingDate" class="fixed-width-110">Unloading Date</label>
                <input type="text" class="form-control" id="unloadingDate" name="unloadingDate" value="<?php echo $container->unloadingDate; ?>" />
            </div>
            <div class="form-group col-md-4">
                <label for="storeLocation" class="fixed-width-110">Store Location</label>
                <?php if ($stores) : ?>
                    <select class="form-control" name="storeLocation">
                        <?php foreach ($stores as $store) : ?>
                            <?php if ($container->storeId == $store->id) : ?>
                                <option value="<?php echo $store->id; ?>" selected="selected"><?php echo $store->name; ?></option>
                            <?php else: ?>
                                <option value="<?php echo $store->id; ?>"><?php echo $store->name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($container->storeId == -1): ?>
                            <option value="-1" selected="selected">-- SELECT --</option>
                        <?php endif; ?>
                    </select>
                <?php endif; ?>
            </div>
        </div>
        <br/>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

