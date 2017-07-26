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
    if ($shipment) {
        $id = $shipment->id;
        $allContainers = $this->container_model->getContainerForShipment($id);
    }
}
?>

<div>
    <legend>Add Container</legend>
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>container/add">
        <input type="hidden" name="shipmentId" value="<?php if ($shipment) {
    echo $shipment->id;
} else {
    echo -1;
} ?>" />
        <div class="row">
            <div class="form-group col-md-4">
                <label for="shippingNo" class="fixed-width-110">Shipping No</label>
    <?php if (isset($shipment)) : ?>
                    <input type="text" class="form-control" id="shippingNo" name="shippingNo" value="<?php echo $shipment->shippingNo; ?>" readonly="readonly">
    <?php endif; ?>
            </div>
            <div class="form-group col-md-4">
                <label for="contCode" class="fixed-width-110">Cont.Code</label>
                <input type="text" class="form-control" id="contCode" name="contCode" >
            </div>
            <div class="form-group col-md-4">
                <label for="mWeek" class="fixed-width-110">Man.Week</label>
                <input type="text" class="form-control" id="mWeek" name="mWeek">
            </div>            
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="qty" class="fixed-width-110">Quantity</label>
                <input type="number" class="form-control" id="qty" name="qty">
            </div>
            <div class="form-group col-md-4">
                <label for="unloadingDate" class="fixed-width-110">Unloading Date</label>
                <input type="text" class="form-control" id="unloadingDate" name="unloadingDate">
            </div>
            <div class="form-group col-md-4">
                <label for="storeLocation" class="fixed-width-110">Store Location</label>
                <select class="form-control" name="storeLocation">
                    <option value="0">Location A</option>
                    <option value="1">Location B</option>
                </select>
            </div>
        </div>
        <br/>
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
                            <a class="btn btn-warning btn-xs" role="button"
                               href="<?php echo base_url(); ?>view/editContainer/<?php echo urlencode(base64_encode($container->id)); ?>/<?php echo urlencode(base64_encode($shipment->id)); ?>">Edit</a>
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
