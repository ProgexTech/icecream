
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
                foreach ($allCustomers as $address):
                    $id = $address->id;
                    ?>
                    <tr>
                        <td><?php echo $address->code; ?></td>
                        <td><?php echo $address->name; ?></td>
                        <td><?php echo $address->company; ?></td>
                        <td><?php echo $address->phone; ?></td>
                        <td><?php echo $address->description; ?></td>
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