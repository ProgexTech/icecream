<?php
if (isset($customerId)) {
    $customer = $this->customer_model->getCustomerById(base64_decode(urldecode($customerId)));
}
?>

<div>
    <legend>Add Address</legend>
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>customer/addAddress">
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
            <label for="region">Region</label>
            <input type="text" class="form-control" id="region" name="region">
        </div>
        &nbsp;
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        &nbsp;
        <div class="form-group">
            <label for="shipmentDate">Phone (Office)</label>
            <input type="text" class="form-control" id="phoneOffice" name="phoneOffice">
        </div>
        &nbsp;
        <div class="form-group">
            <label for="shipmentDate">Phone (Mobile)</label>
            <input type="text" class="form-control" id="phoneMobile" name="phoneMobile">
        </div>
        &nbsp;
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
<br/><br/>

<div id="div-table">
    <legend>All Addresses</legend>
    <table class="table table-striped">
        <thead>
        <th>Address</th>
        <th>Region</th>
        <th>Phone Office</th>
        <th>Phone Mobile</th>     
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $allVehicles = $this->customer_model->getAllAddressesForCustomer(base64_decode(urldecode($customerId)));
            if ($allVehicles):
                foreach ($allVehicles as $address):
                    $id = $address->id;
                    ?>
                    <tr>
                        <td><?php echo $address->address; ?></td>
                        <td><?php echo $address->region; ?></td>
                        <td><?php echo $address->phone_office; ?></td>
                        <td><?php echo $address->phone_mobile; ?></td>
                        <td>
                            <!---<a class="btn btn-warning btn-xs" role="button"
                               href="<?php echo base_url(); ?>view/editAddress/<?php //echo urlencode(base64_encode($id));     ?>/<?php //echo $customerId;     ?>">Edit</a>-->
                            <a class="btn btn-danger btn-xs" role="button"
                               href="<?php echo base_url(); ?>customer/removeAddress/<?php echo urlencode(base64_encode($id)); ?>/<?php echo $customerId; ?>">Remove</a>
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