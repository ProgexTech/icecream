<script type="text/javascript">

    $(function () {
        $("#orderDate").datepicker({
            dateFormat: "yy-mm-dd",
            yearRange: "c-90:c",
            changeMonth: true,
            changeYear: true
        });
    });

</script>

<div id="add-order-form" class="panel panel-default">
    <div id="login-form-title" class="panel-heading">
        <h4>Add New Order</h4>
    </div>
    <div id="form-div" class="panel-body">
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo base_url(); ?>order/add">
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" id="orderDate" rows="3" name="orderDate" 
                       value="<?php $date = new DateTime(); echo $date->format("Y-m-d") ?>"/>
            </div>
            <div class="form-group">
                <label>Reference No</label>
                <input class="form-control" type="text" name="refNo" />
            </div>
            <div class="form-group">
                <label>Order No</label>
                <input class="form-control" type="text" name="orderNo" />
            </div>
            <div class="form-group">
                <label>Country</label>
                <input class="form-control" type="text" name="country" />
            </div>
            <div class="form-group">
                <label>Company</label>
                <input class="form-control" type="text" name="company" />
            </div>  
            <div class="form-group">
                <label>Ordered Quantity</label>
                <input class="form-control" type="number" name="qty" />
            </div>
            <div class="form-group">
                <input type="submit" value="Place Order" class="btn btn-primary"/>
            </div>
        </form>
    </div>
</div>