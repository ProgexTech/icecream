<script type="text/javascript">

    $(function () {
    $("#poDate").datepicker({
    dateFormat: "yy-mm-dd",
    yearRange: "c-90:c",
    changeMonth: true,
    changeYear: true
    });
    });

    $(document).ready(function () {

    $('#customer-type-combo').on('change', function (e) {
    var typeCode = this.value;
    $('#customer-select').load('<?php echo base_url(); ?>' + 'api/getCustomersByType/' + typeCode);
    });

    });

</script>

<?php
$allCustomerTypes = $this->customer_model->getAllCustomerTypes();
?>

<form class="form-inline">
    <label for="customer-type">Customer Type : </label>
    <select class="form-control" id="customer-type-combo" name="customer-type">
        <option value="ALL">ALL</option>
        <?php foreach ($allCustomerTypes as $type) : ?>
            <option value="<?php echo $type->code; ?>"><?php echo $type->code . ' - ' . $type->name; ?></option>
        <?php endforeach; ?>
    </select>
</form>
<br/>

<div id="customer-select">
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
                $customers = $this->customer_model->getAllCustomers();
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
</div>

<div id="customer-add">
    <h4>Customer Details</h4>
    <hr/>
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>customer/add_unreg">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="phone">
            </div>
        </div>
        <div class="form-group">
            <label for="company" class="col-sm-2 control-label">Company</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="company">
            </div>
        </div>
        <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="address">
            </div>
        </div>
        <div class="form-group">
            <label for="region" class="col-sm-2 control-label">Region</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="region">
            </div>
        </div>
        <div class="form-group">
            <label for="regno" class="col-sm-2 control-label">Vehicle Reg.No</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="regno">
            </div>
        </div>
        <div class="form-group">
            <label for="driver" class="col-sm-2 control-label">Driver</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="driver">
            </div>
        </div>
        <div class="form-group">
            <label for="driver" class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10">
                <input type="number" step="0.01" class="form-control" name="price">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Create New PO</button>
            </div>
        </div>
    </form>

<!--    <a class="btn btn-primary" href="<php echo base_url(); ?>view/newPO" role="button">Create New PO</a>-->
</div>
