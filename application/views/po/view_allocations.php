
<?php $allocations = $this->purchaseOrderStock_model->getAll(); ?>

<div id="div-table">
    <legend>All Pending Allocations</legend>
    <table class="table">
        <thead>
        <th>PO #</th>
        <th>Qty</th>
        <th>Customer</th>
        <th>Date</th>
        </thead>
        <tbody>
            <?php
            if ($allocations):
                foreach ($allocations as $alloc) :
                    ?>
                    <?php $bill = $this->purchaseOrder_model->getPOById($alloc->poId); ?>
                    <?php $customer = $this->customer_model->getCustomerById($bill->customerId); ?>
                    <tr>
                        <td><?php echo $alloc->poId; ?></td>
                        <td><?php echo $alloc->qty; ?></td>
                        <td><?php echo $customer->code; ?></td>
                        <td><?php echo $bill->createdDate; ?></td>
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