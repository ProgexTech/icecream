<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
    function loadPrice() {
        var storeId = document.getElementById("storeLocation").value;
        var paymentType = document.getElementById("sale_type").value;
        var customerId = document.getElementById("customerId").value;
        //var url = "<?php echo base_url();?>"+"api/getPricesForCustomerByPaymentTypeAndLocation/";
        var url = "<?php echo base_url();?>"+"api/getPricesForCustomerByPaymentTypeAndLocation/"+ customerId + '/' + storeId + '/'+ paymentType;
        //alert(url);
       $.ajax({
            type: "POST",
            url: url,
            data: "",
            success: function(resp) {
            //alert(resp);
                document.getElementById("price").value = resp;
            }
        });
    }

</script>

<?php
$customer = $this->customer_model->getCustomerById(base64_decode(urldecode($customerId)));
$customerPrices = $this->customer_model->getPricesForCustomer(base64_decode(urldecode($customerId)));
$customerAddresses = $this->customer_model->getAllAddressesForCustomer(base64_decode(urldecode($customerId)));
$customerVehicles = $this->customer_model->getAllVehiclesForCustomer(base64_decode(urldecode($customerId)));
?>

<div class="container-fluid">
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>purchaseOrder/add">

        <!-- Customer Details -->
        <h4>Customer Details</h4>
        <hr/>

        <div class="row">
            <div class="col-md-1 form-text">
                <p class="text-right"><strong>Code : </strong></p>
            </div>
            <div class="col-md-3 form-text">
                <p class="text-left"><?php echo $customer->code; ?></p>
            </div>
            <div class="col-md-1 form-text">
                <p class="text-right"><strong>Address : </strong></p>
            </div>
            <div class="col-md-3">
                <?php if ($customerAddresses) : ?>
                    <select class="form-control" name="customerAddress_id">                
                        <?php foreach ($customerAddresses as $ca) : ?>
                            <option value="<?php echo $ca->id; ?>"><?php echo $ca->address; ?></option>
                        <?php endforeach; ?>                
                    </select>
                <?php else : ?>
                    <p class="text-left">-- No Address --</p>
                <?php endif; ?>
            </div>
            <div class="col-md-1 form-text text-right">
                <p class="text-right"><strong>Vehicle : </strong></p>
            </div>
            <div class="col-md-3">
                <?php if ($customerVehicles) : ?>
                    <select class="form-control" name="customerVehicle_id">
                        <?php foreach ($customerVehicles as $cv) : ?>
                            <option value="<?php echo $cv->id; ?>"><?php echo $cv->regNo; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else : ?>
                    <p class="text-left">-- No Vehicle --</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 form-text text-right">
                <p class="text-right"><strong>Name : </strong></p>
            </div>
            <div class="col-md-3 form-text">
                <p class="text-left"><?php echo $customer->name; ?></p>
            </div>
            <div class="col-md-1 form-text text-right">
                <p class="text-right"><strong>Region : </strong></p>
            </div>
            <div class="col-md-3 form-text">
                <?php if ($customerAddresses) : ?>
                    <p class="text-left"><?php echo $customerAddresses[0]->region; ?></p>
                <?php else : ?>
                    <p class="text-left">-- No Address --</p>
                <?php endif; ?>
            </div>
            <div class="col-md-1 form-text text-right">
                <p class="text-right"><strong>Driver : </strong></p>
            </div>
            <div class="col-md-3 form-text">
                <?php if ($customerVehicles) : ?>
                    <p class="text-left"><?php echo $customerVehicles[0]->driverName; ?></p>
                <?php else : ?>
                    <p class="text-left">-- No Driver --</p>
                <?php endif; ?>
            </div>
        </div>

        <br/>

        <!-- PO Details -->
        <h4>Purchase Order Details</h4>
        <hr/>

        <input type="hidden" id="customerId" name="customer_id" value="<?php echo base64_decode(urldecode($customerId)); ?>"/>

        <div class="form-group">
            <label for="date_time" class="col-sm-2 control-label">Date/Time</label>
            <div class="col-sm-6 ">
                <input type="text" class="form-control" name="date_time" readonly="readonly"
                       value="<?php
                       $date = new DateTime("now", new DateTimeZone("Asia/Colombo"));
                       echo $date->format("Y-m-d H:i:s");
                       ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="quantity" class="col-sm-2 control-label">Quantity</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" name="quantity">
            </div>
            <div class="col-sm-5"><p class="form-text text-left">bags</p></div>
        </div>
        <div class="form-group">
            <label for="driver" class="col-sm-2 control-label">Store Location</label>
            <div class="col-sm-10">
                <select id="storeLocation" name="storeLocation" class="col-sm-2 control-label" onchange="loadPrice()">
                    <?php
                    $stores = $this->store_model->getAllStores();
                    foreach ($stores as $st) {
                        ?>
                        <option value="<?php echo $st->id; ?>"><?php echo $st->name ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="sale_type" class="col-sm-2 control-label">Type of Sale</label>
            <div class="col-sm-6">
                <select class="form-control" name="sale_type" id="sale_type" onchange="loadPrice()">
                    <option value="CASH">CASH</option>
                    <option value="CREDIT">CREDIT</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Price</label>
            <div class="col-sm-3">
                <input type="text" readonly="true" name="price" for="price" value="0.00" class="col-sm-5 control-label" id="price">
<!--                <select class="form-control" name="customerPrice_id">-->
                    <?php //foreach ($customerPrices as $cp) : ?>
                        <!--<option value="//<?php //echo $cp->id; ?>"><?php //echo $cp->price; ?></option>-->
                    <?php //endforeach; ?>
<!--                </select> -->
            </div>
        </div>
        <div class="form-group">
            <label for="delivery_type" class="col-sm-2 control-label">Delivery Type</label>
            <div class="col-sm-6">
                <select class="form-control" name="delivery_type">
                    <option value="PICK UP">PICK UP</option>
                    <option value="DELIVERY">DELIVERY</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Create New PO</button>
            </div>
        </div>
    </form>

</div>