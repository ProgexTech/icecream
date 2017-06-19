<script type="text/javascript">

    $(function () {
        $("#poDate").datepicker({
            dateFormat: "yy-mm-dd",
            yearRange: "c-90:c",
            changeMonth: true,
            changeYear: true
        });
    });

</script>

<div id="add-order-form" class="panel panel-default">
    <div id="login-form-title" class="panel-heading">
        <h4>New Purchase Order</h4>
    </div>
    <div id="form-div" class="panel-body">
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo base_url(); ?>purchaseOrder/add">
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" id="poDate" name="poDate" 
                       value="<?php $date = new DateTime(); echo $date->format("Y-m-d") ?>"/>
            </div>
            <div class="form-group">
                <label>PO No</label>
                <input class="form-control" type="text" name="refNo" />
            </div>
            <div class="form-group">
                <label>Customer Name</label>
                <input class="form-control" type="text" name="orderNo" />
            </div>
            <div class="form-group">
                <label>Customer Code</label>
                <input class="form-control" type="text" name="country" />
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input class="form-control" type="number" name="qty" />
            </div>
            <div class="form-group">
                <input type="submit" value="Generate Token" class="btn btn-primary"/>
            </div>
        </form>
    </div>
</div>