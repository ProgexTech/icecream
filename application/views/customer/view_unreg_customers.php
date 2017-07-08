
<div id="div-table">
    <legend>All Unregistered Customers</legend>
    <table class="table table-striped">
        <thead>
        <th>Code</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Company</th>
        <th>Address</th>        
        <th>Region</th>
        <th>Vehicle</th>
        <th>Driver</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $allCustomers = $this->customer_model->getAllUnregCustomers();
            if ($allCustomers):
                foreach ($allCustomers as $customer):
                    $id = $customer->id;
                    ?>
                    <tr>
                        <td><?php echo $customer->id; ?></td>
                        <td><?php echo $customer->name; ?></td>
                        <td><?php echo $customer->phone; ?></td>
                        <td><?php echo $customer->company; ?></td>
                        <td><?php echo $customer->address; ?></td>
                        <td><?php echo $customer->region; ?></td>
                        <td><?php echo $customer->regNo; ?></td>
                        <td><?php echo $customer->driverName; ?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" role="button"
                               href="<?php echo base_url(); ?>">Show POs</a>
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