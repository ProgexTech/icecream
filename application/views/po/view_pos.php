
<div id="div-table">
    <legend>All Purchase Orders</legend>
    <table class="table">
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
            $allDeliveryNotess = $results;
            if ($allDeliveryNotess):
                foreach ($allDeliveryNotess as $bill):
                    $customerInfo = $this->customer_model->getCustomerById($bill->customerId);
                    $addressInfo = $this->customer_model->getAddress($bill->customerAddressId);
                    $vehicleInfo = $this->customer_model->getVehicle($bill->customerVehicleId);
                    $driverInfo = $this->customer_model->getDriver($bill->customerDriverId);
                    ?>
                    <?php if ($bill->delivered == '1') : ?>
                        <tr class="pgx-success">
                        <?php else : ?>
                        <tr class="pgx-danger">
                        <?php endif; ?>
                        <td><?php echo str_pad($bill->id, 6, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo $customerInfo->name; ?></td>
                        <td><?php echo $addressInfo->address; ?></td>
                        <?php if ($driverInfo) : ?>
                            <td><?php echo $vehicleInfo->regNo . '/' . $driverInfo->name; ?></td>
                        <?php else : ?>
                            <td><?php echo $vehicleInfo->regNo; ?></td>
                        <?php endif; ?>                        
                        <td><?php echo $bill->deliveryType; ?></td>
                        <td><?php echo $bill->saleType; ?></td>
                        <td><?php echo $bill->quantity; ?></td>
                        <td>
                            <?php if ($bill->delivered == '1') : ?>                            
                                <a class="btn btn-primary btn-xs" role="button"
                                   href="<?php echo base_url(); ?>view/viewPO/<?php echo urlencode(base64_encode($bill->id)); ?>">Details</a>
                                <a class="btn btn-primary btn-xs" role="button"
                                   href="<?php echo base_url(); ?>view/printPO/<?php echo urlencode(base64_encode($bill->id)); ?>">Re-Print PO</a>
                               <?php else : ?>
                                <a class="btn btn-danger btn-xs" role="button"
                                   href="<?php echo base_url(); ?>view/processPO/<?php echo urlencode(base64_encode($bill->id)); ?>">Proceed</a>
                                <a class="btn btn-warning btn-xs" role="button"
                                   href="<?php echo base_url(); ?>purchaseOrder/cancelPO/<?php echo urlencode(base64_encode($bill->id)); ?>">Cancel</a>
                               <?php endif; ?>
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