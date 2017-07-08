<?php
if ($type == '1') {
    $customer = $this->customer_model->getCustomerById(base64_decode(urldecode($customerId)));
} else {
    $customer = $this->customer_model->getUnregCustomerById(base64_decode(urldecode($customerId)));
}
$customerAddresses = $this->customer_model->getAllAddressesForCustomer(base64_decode(urldecode($customerId)));
$customerVehicles = $this->customer_model->getAllVehiclesForCustomer(base64_decode(urldecode($customerId)));
?>

<div class="container-fluid">

    <!-- Customer Details -->

    <div class="row">
        <div class="col-md-1 form-text">
            <p class="text-right"><strong>Code : </strong></p>
        </div>
        <div class="col-md-3 form-text">
            <?php if ($type == '1') : ?>
                <p class="text-left"><?php echo $customer->code; ?></p>
            <?php else : ?>
                <p class="text-left"><?php echo 'UNREG' . str_pad($customer->id, 4, '0', STR_PAD_LEFT); ?></p>
            <?php endif; ?>
        </div>
        <div class="col-md-1 form-text">
            <p class="text-right"><strong>Address : </strong></p>
        </div>
        <div class="col-md-3">
            <?php if ($type == '1') : ?>
                <?php if ($customerAddresses) : ?>
                    <select class="form-control">                
                        <?php foreach ($customerAddresses as $ca) : ?>
                            <option value="<?php $ca->id; ?>"><?php echo $ca->address; ?></option>
                        <?php endforeach; ?>                
                    </select>
                <?php else : ?>
                    <p class="text-left">-- No Address --</p>
                <?php endif; ?>
            <?php else : ?>
                <p class="text-left"><?php echo $customer->address; ?></p>
            <?php endif; ?>
        </div>
        <div class="col-md-1 form-text text-right">
            <p class="text-right"><strong>Vehicle : </strong></p>
        </div>
        <div class="col-md-3">
            <?php if ($type == '1') : ?>
                <?php if ($customerVehicles) : ?>
                    <select class="form-control">
                        <?php foreach ($customerVehicles as $cv) : ?>
                            <option value="<?php $cv->id; ?>"><?php echo $cv->regNo; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else : ?>
                    <p class="text-left">-- No Vehicle --</p>
                <?php endif; ?>
            <?php else : ?>
                <p class="text-left"><?php echo $customer->regNo; ?></p>
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
            <?php if ($type == '1') : ?>
                <?php if ($customerAddresses) : ?>
                    <p class="text-left"><?php echo $customerAddresses[0]->region; ?></p>
                <?php else : ?>
                    <p class="text-left">-- No Address --</p>
                <?php endif; ?>
            <?php else : ?>
                <p class="text-left"><?php echo $customer->region; ?></p>
            <?php endif; ?>
        </div>
        <div class="col-md-1 form-text text-right">
            <p class="text-right"><strong>Driver : </strong></p>
        </div>
        <div class="col-md-3 form-text">
            <?php if ($type == '1') : ?>
                <?php if ($customerVehicles) : ?>
                    <p class="text-left"><?php echo $customerVehicles[0]->driverName; ?></p>
                <?php else : ?>
                    <p class="text-left">-- No Driver --</p>
                <?php endif; ?>
            <?php else : ?>
                <p class="text-left"><?php echo $customer->driverName; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <hr/>

    <!-- PO Details -->

</div>