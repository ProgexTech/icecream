<script>
    $(document).on('change', '#qty', function() {
        var qty = $(this).val();
        var stockQty = document.getElementById('stockQty').value;
        if(qty > stockQty){
            qty = stockQty;
            $('#qty').val(qty);
        }
        var unitPrice = document.getElementById('uPrice').value;
        var total = qty * unitPrice;
        $('#tot').val(total);
    });
</script>

<?php
$po = $this->purchaseOrder_model->getPOById(base64_decode(urldecode($poId)));
$customerInfo = $this->customer_model->getCustomerById($po->customerId);
$addressInfo = $this->customer_model->getAddress($po->customerAddressId);
$vehicleInfo = $this->customer_model->getVehicle($po->customerVehicleId);
$customerPrice = $this->customer_model->getPricesById($po->customerPriceId);
$availableStock = $this->stock_model->getAllRemainingQuantity();

?>

<div class="container-fluid">
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>purchaseOrder/finalize">

        <!-- Customer Details -->
        <h4>Customer Details</h4>
        <hr/>

        <div class="row">
            <div class="col-md-1 form-text">
                <p class="text-right"><strong>Code : </strong></p>
            </div>
            <div class="col-md-3 form-text">
                <p class="text-left"><?php echo $customerInfo->code; ?></p>
            </div>
            <div class="col-md-1 form-text">
                <p class="text-right"><strong>Address : </strong></p>
            </div>
            <div class="col-md-3">
                <p class="text-right"><?php $addressInfo->address; ?></p>
            </div>
            <div class="col-md-1 form-text text-right">
                <p class="text-right"><strong>Vehicle : </strong> </p>
            </div>
            <div class="col-md-3">
                <p class="text-left"> <?php echo $vehicleInfo->regNo; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 form-text text-right">
                <p class="text-right"><strong>Name : </strong></p>
            </div>
            <div class="col-md-3 form-text">
                <p class="text-left"><?php echo $customerInfo->name; ?></p>
            </div>
            <div class="col-md-1 form-text text-right">
                <p class="text-right"><strong>Region : </strong></p>
            </div>
            <div class="col-md-3 form-text">
                <p class="text-left"><?php echo $addressInfo->region; ?></p>
            </div>
            <div class="col-md-1 form-text text-right">
                <p class="text-right"><strong>Driver : </strong></p>
            </div>
            <div class="col-md-3 form-text">
                <p class="text-left"><?php echo $vehicleInfo->driverName; ?></p>
            </div>
        </div>

        <br/>

        <!-- PO Details -->
        <h4>Purchase Order Details</h4>
        <hr/>

        <input type="hidden" name="poId" value="<?php echo $poId; ?>"/>

        <div class="form-group">
            <label for="date_time" class="col-sm-2 control-label">Date/Time</label>
            <div class="col-sm-5 ">
                <label class="form-control">
                    <?php $date = new DateTime($po->createdDate);
                    echo $date->format("Y-m-d");
                    ?></label>
            </div>
        </div>
        <div class="form-group">
            <label for="orderedQuantity" class="col-sm-2 control-label">Ordered Quantity</label>
            <div class="col-sm-5">
                <label class="form-control"><?php echo $po->quantity; ?></label>
            </div>
            <div class="col-sm-5"><p class="form-text text-left">bags</p></div>
        </div>
        <div class="form-group">
            <label for="stockQty" class="col-sm-2 control-label">Available Quantity</label>
            <div class="col-sm-5">
                <input readonly="true" id="stockQty" type="number" class="form-control" name="availableQty" value="<?php echo $availableStock->currentQty; ?>"/>
            </div>
            <div class="col-sm-5"><p class="form-text text-left">bags</p></div>
        </div>
        <div class="form-group">
            <label for="quantity" class="col-sm-2 control-label">Issuing Quantity</label>
            <div class="col-sm-5">
                <input id="qty" type="number" class="form-control" name="issuedQty" value="<?php echo $po->quantity; ?>"/>
            </div>
            <div class="col-sm-5"><p class="form-text text-left">bags</p></div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Unit Price</label>
            <div class="col-sm-5">
                <input type="number" step="0.01"  readonly="true" id="uPrice" name="unitPrice" class="form-control" value="<?php echo $customerPrice[0]->price; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label for="total" class="col-sm-2 control-label">Total</label>
            <div class="col-sm-5">
                <input id="tot" type="number" name="total" readonly="true" step="0.01" class="form-control" value="<?php echo $po->quantity * $customerPrice[0]->price; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label for="sale_type" class="col-sm-2 control-label">Type of Sale</label>
            <div class="col-sm-5">
                <input type="text" readonly="true" class="form-control" value="<?php echo $po->saleType; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label for="delivery_type" class="col-sm-2 control-label">Delivery Type</label>
            <div class="col-sm-5">
                 <input type="text" readonly="true" class="form-control" value="<?php echo $po->deliveryType; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Finalize</button>
            </div>
        </div>
    </form>

</div>