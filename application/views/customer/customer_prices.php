<script type="text/javascript">

    function showPrice1(customerId, customerCode) {
        $('#customer_code').html(customerCode);
        $('#customer_id').val(customerId);
        $('#prices-container').load('<?php echo base_url(); ?>' + 'api/getPricesForCustomer/' + customerId);
    }

    function addPrice() {
        var customerId = $('#customer_id').val();
        var price = $('#price').val();
        var type = $('#type').val();
        var store = $('#store').val();
        $('#prices-container').load('<?php echo base_url(); ?>' + 'api/addPriceForCustomer/' + customerId + '/' + type + '/' + store + '/' + price);
    }

</script>

<input type="hidden" id="customer_id">

<div>
    <div class="row">
        <div class="col-md-8">
            <div class="container-fluid">
                <table class="table">
                    <thead>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Company</th> 
                    <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $allCustomers = $this->customer_model->getAllCustomers(); ?>
                        <?php if ($allCustomers): ?>
                            <?php foreach ($allCustomers as $customer): ?>
                                <tr>
                                    <td><?php echo $customer->code; ?></td>
                                    <td><?php echo $customer->name; ?></td>
                                    <td><?php echo $customer->company; ?></td>
                                    <td>
                                        <input class="btn btn-default" type="button" value="Show" 
                                               onclick="showPrice1('<?php echo $customer->id; ?>', '<?php echo $customer->code; ?>')">
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <table class="table">
                <thead>
                <th>Customer Code : </th>
                <th id="customer_code">--SELECT--</th>
                </thead>
            </table>
            <div id="prices-container">
                No Prices found.
            </div>
        </div>
    </div>
</div>