<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php
$bill = $this->purchaseOrder_model->getPOById(base64_decode(urldecode($poId)));
$customerInfo = $this->customer_model->getCustomerById($bill->customerId);
$customerPrice = $this->customer_model->getPricesById($bill->customerPriceId);
$addressInfo = $this->customer_model->getAddress($bill->customerAddressId);
$vehicleInfo = $this->customer_model->getVehicle($bill->customerVehicleId);
?>
<div id="printableArea" align="center">
    <p style="text-align: center;"><h3>Supertech Cements Lanka (Pvt) Ltd</h3></p>
<table width="100%">
    <tbody>
        <tr>
            <td><strong>PO #</strong></td>
            <td style="padding-right: 50px;"><?php echo str_pad($bill->id, 6, '0', STR_PAD_LEFT); ?></td>
            <td style="padding-left: 350px;"><strong>Invoice</strong></td>
            <td style="padding-left: 210px;"><strong>Date</strong></td>
            <td><?php  $date = new DateTime($bill->createdDate);
                            echo $date->format("Y-m-d");  ?></td>
        </tr>
    </tbody>
</table>
<p style="text-align: justify;"><strong>&nbsp;</strong></p>
<table border="1" width="100%">
    <tbody>
        <tr>
            <td style="padding-left: 30px; text-align: left;">CUSTOMER CODE NAME &amp; ADDRESS</td>
<!--            <td style="padding-left: 30px; text-align: left;">CUSTOMER TAX NOs</td>-->
            <td style="padding-left: 90px; text-align: left;">PROJECT / LOCATION</td>
        </tr>
        <tr>
            <td><?php echo $customerInfo->code.", ".$customerInfo->name." , ".$addressInfo->address; ?></td>
<!--            <td>-</td>-->
            <td><?php echo $addressInfo->region;?></td>
        </tr>
    </tbody>
</table>
<p style="text-align: justify;"><strong>&nbsp;</strong></p>
<table  border="1" width="100%">
    <tbody>
        <tr>
            <td><strong>PO#</strong></td>
            <td><strong>Delivery Type</strong></td>
            <td><strong>Payment Type</strong></td>
            <td style="padding-left: 150px;"><strong>Description</strong></td>
            <td style="padding-left: 30px;"><strong>Qty</strong></td>
            <td><strong>Unit Price</strong></td>
            <td><strong>Line Total</strong></td>
        </tr>
        <tr>
            <td><?php echo str_pad($bill->id, 6, '0', STR_PAD_LEFT); ?></td>
            <td><?php echo $bill->deliveryType; ?></td>
            <td><?php echo $bill->saleType; ?></td>
            <td>&nbsp;</td>
            <td><?php echo $bill->quantity; ?></td>
            <td><?php echo $customerPrice[0]->price; ?></td>
            <td><?php echo $bill->quantity*$customerPrice[0]->price;  ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><strong>Total</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><strong><?php echo $bill->quantity*$customerPrice[0]->price;?></strong></td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<table width="100%" border="1">
    <tbody>
        <tr>
            <td>Vehicle No</td>
            <td>Driver's Name </td>
            <td>Signature</td>
        </tr>
        <tr>
            <td><?php echo $vehicleInfo->regNo; ?></td>
            <td><?php echo $vehicleInfo->driverName; ?></td>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>
<p style="text-align: justify;"><strong>&nbsp;</strong></p>
</div>


<input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-primary"/>
