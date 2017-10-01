<?php
if (isset($shipmentId)) {
    $shipment = $this->shipment_model->getShipmentById(base64_decode(urldecode($shipmentId)));
    if ($shipment) {
        $id = $shipment->id;
        $allContainers = $this->container_model->getContainerForShipment($id);
        $order = $this->order_model->getOrderById($shipment->orderId);
    }
}
?>

<div>
    <legend>Shipment Details</legend>
    <div class="row">
        <div class="myp col-md-2 text-right"><strong><em>Shipping No : </em></strong></div>
        <div class="myp col-md-4"><?php
            if ($shipment) {
                echo $shipment->shippingNo;
            }
            ?></div>
        <div class="myp col-md-2 text-right"><strong><em>Shipment Date : </em></strong></div>
        <div class="myp col-md-4"><?php
            if ($shipment) {
                echo $shipment->shipmentDate;
            }
            ?></div>
    </div>
    <div class="row">
        <div class="myp col-md-2 text-right"><strong><em>Order No : </em></strong></div>
        <div class="myp col-md-4">
            <?php if ($order) : ?>
                <a class="btn btn-default btn-xs" href="<?php echo base_url(); ?>view/viewOrder/<?php echo urlencode(base64_encode($order->id)); ?>">
    <?php echo $order->orderNo; ?>
                </a>
<?php endif; ?>
        </div>
        <div class="myp col-md-2 text-right"><strong><em>Man.Weeks : </em></strong></div>
        <div class="myp col-md-4"><?php // if ($shipment) { echo $shipment->mWeek; }   ?>to-do</div>
    </div>    
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
        <th>Action</th>
        </thead>
        <tbody>
<?php if ($shipment && $allContainers) : ?>
    <?php foreach ($allContainers as $container) : ?>
                    <tr>
                        <td><?php echo $shipment->shippingNo; ?></td>
                        <td><?php echo $container->contCode; ?></td>
                        <td><?php echo $container->mWeek; ?></td>
                        <td><?php echo $container->qty; ?></td>                    
                        <td>

                            <a class="btn btn-danger btn-xs" role="button"
                               href="<?php echo base_url(); ?>shipment/removeContainer/<?php echo urlencode(base64_encode($container->id)); ?>">Remove</a>
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
