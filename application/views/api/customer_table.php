<div id="div-table">
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
            if ($customers):
                foreach ($customers as $customer):
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
                                   href="<?php echo base_url(); ?>view/newPO/<?php echo urlencode(base64_encode($id)); ?>">New PO</a>
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