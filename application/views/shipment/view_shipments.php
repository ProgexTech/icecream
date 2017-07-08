<script type="text/javascript">

    $(function () {
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
    if ($order) {
        $id = $order->id;
        $allShipments = $this->shipment_model->getShipmentsForOrder($id);
    }
}
?>

<div>
    <legend>Add Shipment</legend>
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>shipment/add">
        <input type="hidden" name="orderId" value="<?php if ($order) {echo $order->id;} else {echo -1;} ?>" />
        <div class="form-group">
            <label for="orderNo">Order No</label>
            <?php if (isset($order)) : ?>
                <input type="text" class="form-control" id="orderNo" name="orderNo" value="<?php echo $order->orderNo; ?>" readonly="readonly">
            <?php endif; ?>
        </div>
        &nbsp;
        <div class="form-group">
            <label for="shippingNo">Shipping No</label>
            <input type="text" class="form-control" id="shippingNo" name="shippingNo">
        </div>
        &nbsp;
        <div class="form-group">
            <label for="shipmentDate">Date</label>
            <input type="text" class="form-control" id="shipmentDate" name="shipmentDate">
        </div>
        &nbsp;
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
<br/><br/>
<div>
    <legend>All Shipments</legend>
    <table class="table table-striped">
        <thead>
        <th>Order No</th>
        <th>Shipping No</th>
        <th>Shipment Date</th>
        <th>Man. Weeks</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php if ($order && $allShipments) : ?>
                <?php foreach ($allShipments as $shipment) : ?>
                    <tr>
                        <td>
                            <a class="btn btn-default linkButtonColor btn-xs" href="<?php echo base_url(); ?>view/viewOrder/<?php echo urlencode(base64_encode($order->id)); ?>">
                            <?php echo $order->orderNo; ?>
                            </a>
                        </td>
                        <td><?php echo $shipment->shippingNo; ?></td>
                        <td><?php echo $shipment->shipmentDate; ?></td>
                        <td><?php  $allContainers = $this->container_model->getContainersByShipmentId($shipment->id);
                        if ($allContainers) :
                            $round = 0;
                            foreach ($allContainers as $container) :
                            if($round > 0):
                                echo ', ';
                            endif;
                            echo $container->mWeek;
                            $round = $round+1;
                            endforeach;
                        
                        else :
                            echo "N/A";
                        endif;
?>
                        </td>                    
                        <td>
                            <a class="btn btn-primary btn-xs" role="button"
                               href="<?php echo base_url(); ?>view/viewContainers/<?php echo urlencode(base64_encode($shipment->id)); ?>">Containers</a>
                            <a class="btn btn-warning btn-xs" role="button"
                                   href="<?php echo base_url(); ?>view/editShipment/<?php echo urlencode(base64_encode($shipment->id)); ?>">Edit</a>
                            <a class="btn btn-danger btn-xs" role="button"
                               href="<?php echo base_url(); ?>shipment/remove/<?php echo urlencode(base64_encode($shipment->id)); ?>">Remove</a>
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
