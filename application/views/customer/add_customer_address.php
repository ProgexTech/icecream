<?php
if (isset($customerId)) {
    $customer = $this->customer_model->getCustomerById(base64_decode(urldecode($customerId)));
}
?>
<div id="div-table">
    <legend>All Addresses</legend>
    <table class="table table-striped">
        <thead>
        <th>Customer Code</th>
        <th>Address</th>
        <th>Phone Office</th>
        <th>Phone Mobile</th>     
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $allAddressess = $this->customer_model->getAllAddressesForCustomer($customerId);
            if ($allAddressess):
                foreach ($allAddressess as $address):
                    $id = $address->id;
                    ?>
                    <tr>
                        <td><?php echo $customer->code; ?></td>
                        <td><?php echo $address->address; ?></td>
                        <td><?php echo $address->phone_office; ?></td>
                        <td><?php echo $address->phone_mobile; ?></td>
                        <td>
                            <?php if ($address->active !== '0') { ?>
                                <a class="btn btn-primary btn-xs" role="button"
                                   href="<?php echo base_url(); ?>view/addAddress/<?php echo urlencode(base64_encode($id)); ?>">Addresses</a>
                                <a class="btn btn-warning btn-xs" role="button"
                                   href="<?php echo base_url(); ?>view/addVehicle/<?php echo urlencode(base64_encode($id)); ?>">Vehicles</a>
                                <a class="btn btn-danger btn-xs" role="button"
                                   href="<?php echo base_url(); ?>customer/remove/<?php echo urlencode(base64_encode($id)); ?>">Remove</a>
                               <?php } ?>
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