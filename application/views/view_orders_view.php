<div id="item-div">
    <h4>Orders</h4>
    <table class="table table-hover table-condensed table-bordered">
        <thead>
        <th>Order No</th>
        <th>Order Ref</th>
        <th>Date</th>
        <th>Company</th>
        <th>Country</th>
        <th>Quantity</th>
        <th>Field1</th>
        <th>Field2</th>
        <th>Placed By</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $allOrders = $this->order_model->getAllOrders();
            if ($allOrders):
                foreach ($allOrders as $order):
                    $id = $order['id'];
                    ?>
                    <tr>
                        <td><?php echo $order['orderNo']; ?></td>
                        <td><?php echo $order['refNo']; ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo $order['company']; ?></td>
                        <td><?php echo $order['country']; ?></td>
                        <td><?php echo $order['qty']; ?></td>
                        <td><?php echo $order['field1']; ?></td>
                        <td><?php echo $order['field2']; ?></td>
                        <td><?php 
                        $user = $this->user_model->getUserById($order['userId']);
                        echo $user->name;
                        ?></td>
                        <td>
                            <a class="btn btn-success btn-xs" role="button"
                                       href="<?php echo base_url(); ?>order/edit/<?php echo urlencode(base64_encode($order['id']));?>">Edit</a>
                            <a class="btn btn-warning btn-xs" role="button"
                                       href="<?php echo base_url(); ?>order/cancel/<?php echo urlencode(base64_encode($order['id']));?>">Cancel</a>
                        </td>
                    </tr>
                    <?php
                endforeach;
            else:
            ?>
            <tr>
                <td colspan="9">No Entries</td>
            </tr>
            <?php  endif; ?>
        </tbody>
    </table>
    <br/>
    <br/>
</div>