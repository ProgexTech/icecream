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
    if ($shipment) {
        $id = $shipment->id;
        $allContainers = $this->container_model->getContainerForShipment($id);
    }
}
?>

<div>
    <legend>Add Container</legend>
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>container/add">
        <input type="hidden" name="shipmentId" value="<?php if ($shipment) {echo $shipment->id;} else {echo -1;} ?>" />
        <div class="form-group">
            <label for="shippingNo">Shipping No</label>
            <?php if (isset($shipment)) : ?>
                <input type="text" class="form-control" id="shippingNo" name="shippingNo" value="<?php echo $shipment->shippingNo; ?>" readonly="readonly" size="12px">
            <?php endif; ?>
        </div>
        &nbsp;
        <div class="form-group">
            <label for="contCode">Cont.Code</label>
            <input type="text" class="form-control" id="contCode" name="contCode" >
        </div>
        &nbsp;
        <div class="form-group">
            <label for="mWeek">Man.Week</label>
            <input type="text" class="form-control" id="mWeek" name="mWeek" size="10px">
        </div>
        &nbsp;
        <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="number" class="form-control" id="qty" name="qty" size="8px">
        </div>
        &nbsp;   
        <div class="form-group">
        <label for="unloadingDate">Unloading Date</label>
        <input type="text" class="form-control" id="unloadingDate" name="unloadingDate" size="10px">
        </div>
        &nbsp;
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
<br/><br/>
<div>
    <legend>All Containers</legend>
    <table class="table table-striped">
        <thead>
        <th>Shipping No</th>
        <th>Cont.Code</th>
        <th>Man.Weeks</th>
        <th>Quantity</th>
        <th>Unloading Date</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php if ($shipment && $allContainers) : ?>
                <?php foreach ($allContainers as $container) : ?>
                    <tr>
                        <td>
                            <a class="btn btn-default linkButtonColor btn-xs" href="<?php echo base_url(); ?>view/viewShipment/<?php echo urlencode(base64_encode($shipment->id)); ?>">
                            <?php echo $shipment->shippingNo; ?>
                            </a>                            
                        </td>
                        <td><?php echo $container->contCode; ?></td>
                        <td><?php echo $container->mWeek; ?></td>
                        <td><?php echo $container->qty; ?></td> 
                        <td><?php echo $container->unloadingDate; ?></td>  
                        <td>
                            <a class="btn btn-danger btn-xs" role="button"
                               href="<?php echo base_url(); ?>container/remove/<?php echo urlencode(base64_encode($container->id)); ?>">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No Entries</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
