<script>
    $(document).on('keyup change', '#qty', function() {
        var qty = $(this).val();
        //alert(qty);
        var stockQty = document.getElementById('stockQty').value;
        //alert("stock Qty = "+stockQty+"  cur Qty = "+qty);
        if (Number(qty) > Number(stockQty)) {
            //alert("Low Stock! Please enter a valid quantity");
            qty = stockQty;
            $('#qty').val(qty);
        }
        var unitPrice = document.getElementById('uPrice').value;
        var total = qty * unitPrice;
        $('#tot').val(total);
    });
</script>
<?php
$bill = $this->purchaseOrder_model->getPOById(base64_decode(urldecode($poId)));
$customerInfo = $this->customer_model->getCustomerById($bill->customerId);
$addressInfo = $this->customer_model->getAddress($bill->customerAddressId);
$vehicleInfo = $this->customer_model->getVehicle($bill->customerVehicleId);
$driverInfo = $this->customer_model->getDriver($bill->customerDriverId);
$customerPrice = $this->customer_model->getPriceById($bill->customerPriceId);
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
                <p class="text-left"><?php echo $addressInfo->address; ?></p>
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
                <p class="text-left"><?php echo $driverInfo->name; ?></p>
            </div>
        </div>
        <br/>
        <!-- PO Details -->
        <h4>Purchase Order Details</h4>
        <hr/>
        <input type="hidden" name="poId" value="<?php echo $poId; ?>"/>
        <div class="form-group">
            <label for="date_time" class="col-sm-2 control-label">Purchase Order Date</label>
            <div class="col-sm-5 ">
                <label class="form-control">
                    <?php
                    $date = new DateTime($bill->createdDate);
                    echo $date->format("Y-m-d");
                    ?></label>
            </div>
        </div>
        <div class="form-group">
            <label for="orderedQuantity" class="col-sm-2 control-label">Ordered Quantity</label>
            <div class="col-sm-5">
                <label class="form-control"><?php echo $bill->quantity; ?></label>
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
                <input id="qty" type="number" class="form-control" name="issuedQty" value="<?php echo $bill->quantity; ?>"/>
            </div>
            <div class="col-sm-5"><p class="form-text text-left">bags</p></div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Unit Price</label>
            <div class="col-sm-5">
                <input type="text" step="0.01"  readonly="true" id="uPrice" name="unitPrice" class="form-control" 
                       value="<?php echo number_format((float) ($customerPrice[0]->price), 2, '.', ''); ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label for="total" class="col-sm-2 control-label">Total</label>
            <div class="col-sm-5">
                <input id="tot" type="number" name="total" readonly="true" step="0.01" class="form-control" 
                       value="<?php echo number_format((float) ($bill->quantity * $customerPrice[0]->price), 2, '.', ''); ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label for="sale_type" class="col-sm-2 control-label">Type of Sale</label>
            <div class="col-sm-5">
                <input type="text" readonly="true" class="form-control" value="<?php echo $bill->saleType; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label for="delivery_type" class="col-sm-2 control-label">Delivery Type</label>
            <div class="col-sm-5">
                <input type="text" readonly="true" class="form-control" value="<?php echo $bill->deliveryType; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Finalize</button>
            </div>
        </div>
    </form>
</div>