<?php
if (isset($customerId)) {
    $customer = $this->customer_model->getCustomerById(base64_decode(urldecode($customerId)));
}
?>

<div>
    <legend>Add Vehicle</legend>
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>customer/addVehicle">
        <input type="hidden" name="customerId" value="<?php
        if ($customerId) {
            echo $customerId;
        } else {
            echo -1;
        }
        ?>" />
        <div class="form-group">
            <label for="customerId">Customer Code</label>
            <?php if (isset($customer)) : ?>
                <input type="text" class="form-control" id="orderNo" name="cCode" value="<?php echo $customer->code; ?>" readonly="readonly">
            <?php endif; ?>
        </div>
        &nbsp;
        <div class="form-group">
            <label for="address">Reg. No</label>
            <input type="text" class="form-control" id="regNo" name="regNo" size="10px">
        </div>
        &nbsp;
        <div class="form-group">
            <label for="shipmentDate">Type</label>
            <input type="text" class="form-control" id="type" name="type">
        </div>
        &nbsp;
        <div class="form-group">
            <label for="shipmentDate">Capacity</label>
            <input type="text" class="form-control" id="capacity" name="capacity" size="10px">
        </div>
        &nbsp;
        <div class="form-group">
            <label for="shipmentDate">Driver Name</label>
            <input type="text" class="form-control" id="driverName" name="driverName">
        </div>
        &nbsp;
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
<br/><br/>

<div id="div-table">
    <legend>All Vehicles</legend>
    <table class="table table-striped">
        <thead>
        <th>Reg. No</th>
        <th>Type</th>
        <th>Capacity</th>  
        <th>Driver</th>     
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $allVehicles = $this->customer_model->getAllVehiclesForCustomer(base64_decode(urldecode($customerId)));
            if ($allVehicles):
                foreach ($allVehicles as $address):
                    $id = $address->id;
                    ?>
                    <tr>
                        <td><?php echo $address->regNo; ?></td>
                        <td><?php echo $address->type; ?></td>
                        <td><?php echo $address->capacity; ?></td>
                        <td>N/A</td>
                        <td>
                            <!---<a class="btn btn-warning btn-xs" role="button"
                               href="<?php echo base_url(); ?>view/editVehicle/<?php //echo urlencode(base64_encode($id));      ?>/<?php //echo $customerId;      ?>">Edit</a>-->
                            <a class="btn btn-danger btn-xs" role="button"
                               href="<?php echo base_url(); ?>customer/removeVehicle/<?php echo urlencode(base64_encode($id)); ?>/<?php echo $customerId; ?>">Remove</a>
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
</div>