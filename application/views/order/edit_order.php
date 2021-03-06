<script type="text/javascript">

    $(function() {
        $("#orderDate").datepicker({
            dateFormat: "yy-mm-dd",
            yearRange: "c-90:c",
            changeMonth: true,
            changeYear: true
        });
    });

</script>

<?php
$order = $this->order_model->getOrderById(base64_decode(urldecode($orderId)));
?>

<div id="add-order-form" class="panel panel-default">
    <div id="login-form-title" class="panel-heading">
        <h4>Add New Order</h4>
    </div>
    <div id="form-div" class="panel-body">
        <form method="post" action="<?php echo base_url(); ?>order/edit">
            <input type="hidden" value="<?php echo $orderId ?>" name="orderId"/>
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" id="orderDate" name="orderDate" value="<?php echo $order->orderDate; ?>"/>
            </div>
            <div class="form-group">
                <label>Reference No</label>
                <input class="form-control" type="text" name="refNo" value="<?php echo $order->refNo; ?>" />
            </div>
            <div class="form-group">
                <label>Order No</label>
                <input class="form-control" type="text" name="orderNo" value="<?php echo $order->orderNo; ?>"/>
            </div>
            <div class="form-group">
                <label>Country</label>
                <input class="form-control" type="text" name="country" value="<?php echo $order->country; ?>" />
            </div>
            <div class="form-group">
                <label>Company</label>
                <input class="form-control" type="text" name="company" value="<?php echo $order->company; ?>" />
            </div>    
            <div class="form-group">
                <label>Quantity</label>
                <input class="form-control" type="number" name="qty" value="<?php echo $order->qty; ?>" />
            </div>
            <div class="form-group">
                <input type="submit" value="Edit Order" class="btn btn-primary"/>
            </div>
        </form>
    </div>
</div>
