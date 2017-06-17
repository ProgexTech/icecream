<div id="div-table">
    <legend>All Orders</legend>
    <table class="table table-striped">
        <thead>
        <th>Date</th>
        <th>Order No</th>
        <th>Order Ref</th>
        <th>Created Date</th>
        <th>Company</th>
        <th>Country</th>
        <th>Quantity</th>
        <th>Placed By</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $allOrders = $this->order_model->getAllOrdersByDecendingOder();
            if ($allOrders):
                foreach ($allOrders as $order):
                    $id = $order['id'];
                    ?>
                    <tr>
                        <td><?php echo $order['orderDate']; ?></td>
                        <td><?php echo $order['orderNo']; ?></td>
                        <td><?php echo $order['refNo']; ?></td>
                        <td><?php $date = new DateTime($order['createdDate']); echo $date->format("Y-m-d"); ?></td>
                        <td><?php echo $order['company']; ?></td>
                        <td><?php echo $order['country']; ?></td>
                        <td><?php echo $order['qty']; ?></td>
                        <td><?php
                            $user = $this->user_model->getUserById($order['createdUserId']);
                            echo $user->name;
                            ?></td>
                        <td>
                            <?php if ($order['status'] === '0') { ?>
                                <a class="btn btn-primary btn-xs" role="button"
                                   href="<?php echo base_url(); ?>view/addShipment/<?php echo urlencode(base64_encode($order['id'])); ?>">Add Shp</a>
                                <a class="btn btn-warning btn-xs" role="button"
                                   href="<?php echo base_url(); ?>view/editOrder/<?php echo urlencode(base64_encode($order['id'])); ?>">Edit</a>
                                <a class="btn btn-danger btn-xs" role="button"
                                   href="<?php echo base_url(); ?>order/cancel/<?php echo urlencode(base64_encode($order['id'])); ?>">Cancel</a>
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