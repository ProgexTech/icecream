
<div id="div-table">
    <legend>All Purchase Orders</legend>
    <table class="table table-striped">
        <thead>
        <th>PO #</th>
        <th>Name</th>
        <th>Address</th>
        <th>Vehicle/Driver</th>
        <th>Delivery Type</th>
        <th>Sale Type</th>
        <th>Quantity</th>        
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $allPos = $results;
            if ($allPos):
                foreach ($allPos as $po):
                    $customerInfo = $this->customer_model->getCustomerById($po->customerId);
                    $addressInfo = $this->customer_model->getAddress($po->customerAddressId);
                    $vehicleInfo = $this->customer_model->getVehicle($po->customerVehicleId);
                    ?>
                    <tr>
                        <td><?php echo str_pad($po->id, 6, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo $customerInfo->name; ?></td>
                        <td><?php echo $addressInfo->address; ?></td>
                        <td><?php echo $vehicleInfo->regNo . '/' . $vehicleInfo->driverName; ?></td>
                        <td><?php echo $po->deliveryType; ?></td>
                        <td><?php echo $po->saleType; ?></td>
                        <td><?php echo $po->quantity; ?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" role="button"
                               href="<?php echo base_url(); ?>view/viewPO/<?php echo urlencode(base64_encode($po->id)); ?>">Details</a>
                        </td>
                    </tr>
                    <?php
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="9">No Entries</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo $links; ?>
</div>