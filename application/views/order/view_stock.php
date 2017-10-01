<div id="div-table">
    <legend>Stock Status</legend>

    <div class="container-fluid">
        <div class="col-md-2 text-right"><h4><strong>Current Stock</strong></h4></div>
        <div class="col-md-2">
            <h4>
                <?php
                $availableStock = $this->stock_model->getAllRemainingQuantity();
                if ($availableStock) {
                    echo ': ' . $availableStock->currentQty . ' bags';
                }
                ?>
            </h4>
        </div>
        <div class="col-md-2 text-right"><h4><strong>Containers</strong></h4></div>
        <div class="col-md-3">
            <h4> : 
                <?php
                $allCount = $this->stock_model->getAllContainersCount();
                $nonEmptyCount = $this->stock_model->getAllNonEmptyContainersCount();
                echo $nonEmptyCount . ' out of ' . $allCount . '';
                ?>
            </h4>
        </div>
        <div class="col-md-2 text-right">
            <?php $stores = $this->store_model->getAllStores(); ?>
            <select class="form-control" name="storeLocation" id="storeLocation-combo">
                <option value="-1">ALL</option>
                <?php foreach ($stores as $store) : ?>
                    <option value="<?php echo $store->id; ?>"><?php echo $store->name; ?></option>
                <?php endforeach; ?>                
            </select>
        </div>
        <div class="col-md-1">
            <a class="btn btn-default btn-primary" href="<?php echo base_url(); ?>view/" role="button">Search</a>
        </div>
    </div>
    <hr/>
    <table class="table table-striped">
        <thead>
        <th>#</th>
        <th>Order No</th>
        <th>Shipment No</th>
        <th>Cont. Code</th>
        <th>Week</th>
        <th>Received Qty</th>
        <th>Current Qty</th>
        </thead>
        <tbody>
            <?php $id = 1; ?>
            <?php $records = $this->stock_model->getAllRemainingRecords(); ?>
            <?php foreach ($records as $record) : ?>
                <?php $container = $this->container_model->getContainerById($record->containerId); ?>
                <?php $shipment = $this->shipment_model->getShipmentById($container->shipmentId); ?>
                <?php $order = $this->order_model->getOrderById($shipment->orderId); ?>
                <tr>
                    <td><?php echo $id++; ?></td>
                    <td><?php echo $order->orderNo; ?></td>
                    <td><?php echo $shipment->shippingNo; ?></td>
                    <td><?php echo $container->contCode; ?></td>
                    <td><?php echo $record->mWeek; ?></td>
                    <td><?php echo $record->qty; ?></td>
                    <td><?php echo $record->currentQty; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
