<script type="application/javascript">
    
    function showPrice(customerId, customerCode) {
        $('#customer_code').html('<h4>'+customerCode+'</h4>');
        $('#customer_id').val(customerId);
        $('#prices-container').load('<?php echo base_url(); ?>' + 'api/getPricesForCustomer/' + customerId);
    }
    
    function addPrice() {
        //alert($('#customer_code').text());
        var customerId = $('#customer_id').val();
        var price = $('#price').val();
        var type = $('#type').val();
        var store = $('#store').val();
        
        
        $('#prices-container').load('<?php echo base_url(); ?>' + 'api/addPriceForCustomer/' + customerId + '/' + type + '/'+ store +'/'+price);
    }
    
</script>

<input type="hidden" id="customer_id">
<div class="container-fluid">
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
                                       onclick="showPrice('<?php echo $customer->id; ?>', '<?php echo $customer->code; ?>')">
                            </td>
                        </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="container-fluid">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-5"><h4>Customer Code : </h4></label>
                        <div class="col-sm-7" id="customer_code">
                            <h4>--SELECT--</h4>
                        </div>
                    </div>
                </form>
                <div id="prices-container">
                    No Prices found.
                </div>
            </div>
        </div>
    </div>
</div>