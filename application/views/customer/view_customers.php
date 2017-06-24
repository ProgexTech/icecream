
<div id="div-table">
    <legend>All Customers</legend>
    <table class="table table-striped">
        <thead>
        <th>Code</th>
        <th>Name</th>
        <th>Company</th>
        <th>Phone</th>
        <th>Description</th>        
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $allCustomers = $this->customer_model->getAllCustomers();
            if ($allCustomers):
                foreach ($allCustomers as $customer):
                    $id = $customer->id;
                    ?>
                    <tr>
                        <td><?php echo $customer->code; ?></td>
                        <td><?php echo $customer->name; ?></td>
                        <td><?php echo $customer->company; ?></td>
                        <td><?php echo $customer->phone; ?></td>
                        <td><?php echo $customer->description; ?></td>
                        <td>
                            <?php if ($customer->active !== '0') { ?>
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