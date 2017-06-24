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
    <legend>Order Details</legend>
    <div class="row">
        <div class="myp col-md-2 text-right"><strong><em>Order No : </em></strong></div>
        <div class="myp col-md-4"><?php if ($order) { echo $order->orderNo; } ?></div>
        <div class="myp col-md-2 text-right"><strong><em>Order Date : </em></strong></div>
        <div class="myp col-md-4"><?php if ($order) { echo $order->orderDate; } ?></div>
    </div>
    <div class="row">
        <div class="myp col-md-2 text-right"><strong><em>Ref No : </em></strong></div>
        <div class="myp col-md-4"><?php if ($order) { echo $order->refNo; } ?></div>
        <div class="myp col-md-2 text-right"><strong><em>Country : </em></strong></div>
        <div class="myp col-md-4"><?php if ($order) { echo $order->country; } ?></div>
    </div>    
    <div class="row">
        <div class="myp col-md-2 text-right"><strong><em>Quantity : </em></strong></div>
        <div class="myp col-md-4"><?php if ($order) { echo $order->qty; } ?></div>
        <div class="myp col-md-2 text-right"><strong><em>Company : </em></strong></div>
        <div class="myp col-md-4"><?php if ($order) { echo $order->company; } ?></div>
    </div>
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
                        <td><?php echo $order->orderNo; ?></td>
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
                            <a class="btn btn-danger btn-xs" role="button"
                               href="<?php echo base_url(); ?>order/removeShipment/<?php echo urlencode(base64_encode($shipment->id)); ?>">Remove</a>
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
