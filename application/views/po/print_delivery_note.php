<?php
$bill = $this->bill_model->getBillById(base64_decode(urldecode($billId)));
$po = $this->purchaseOrder_model->getPOById($bill->poId);
$sales = $this->sale_model->getSalesByBillId($bill->id);
$customerInfo = $this->customer_model->getCustomerById($bill->customerId);
$addressInfo = $this->customer_model->getAddress($po->customerAddressId);
$vehicleInfo = $this->customer_model->getVehicle($po->customerVehicleId);
?>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

<div id="printableArea" align="center">
    <p style="text-align: center;"><h3>Super Tech Cements</h3></p>
<table width="100%">
    <tbody>
        <tr>
            <td><strong>PO #</strong></td>
            <td style="padding-right: 50px;"><?php echo str_pad($po->id, 6, '0', STR_PAD_LEFT); ?></td>
            <td style="padding-left: 350px;"><strong>DELIVERY NOTE</strong></td>
            <td style="padding-left: 210px;"><strong>Date</strong></td>
            <td>
            <?php
            $date = new DateTime($po->createdDate);
            echo $date->format("Y-m-d");
            ?>
            </td>
        </tr>
    </tbody>
</table>
<p style="text-align: justify;"><strong>&nbsp;</strong></p>
<table border="1" width="100%">
    <tbody>
        <tr>
            <td style="padding-left: 30px; text-align: left;">CUSTOMER CODE NAME &amp; ADDRESS</td>
<!--            <td style="padding-left: 30px; text-align: left;">CUSTOMER TAX NOs</td>-->
            <td style="padding-left: 90px; text-align: left;">DELIVERY LOCATION</td>
        </tr>
        <tr>
            <td><?php echo $customerInfo->code . ", " . $customerInfo->name . " , " . $addressInfo->address; ?></td>
<!--            <td>-</td>-->
            <td><?php echo $addressInfo->region; ?></td>
        </tr>
    </tbody>
</table>
<p style="text-align: justify;"><strong>&nbsp;</strong></p>
<table  border="1" width="100%">
    <tbody>
        <tr>
            <td><strong>#</strong></td>
            <td><strong>Container Code</strong></td>
            <td><strong>Shipment #</strong></td>
            <td style="padding-left: 150px;"><strong>Man. Week</strong></td>
            <td style="padding-left: 30px;"><strong>Qty</strong></td>
            <td><strong>Line Quantity</strong></td>
        </tr>
        <?php
        $totalQty = 0;
        $counter = 1;
        foreach ($sales as $sale) {
            $totalQty += $sale->qty;
            $stock = $this->stock_model->getStockById($sale->stockId);
            $container = $this->container_model->getContainerById($stock->containerId);
            $shipment = $this->shipment_model->getShipmentById($container->shipmentId);
            ?>
            <tr>
                <td><?php echo $counter++; ?></td>
                <td><?php echo $container->contCode; ?></td>
                <td><?php echo $shipment->shippingNo; ?></td>
                <td><?php echo $stock->mWeek; ?></td>
                <td><?php echo $sale->qty; ?></td>
                <td><?php echo $sale->qty; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><strong>Total Quantity</strong></td>
            <td>&nbsp;</td>
            <td><strong><?php echo $totalQty; ?></strong></td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<p style="text-align: justify;"><strong>I here by confirm that I have checked and received the above mentioned goods from your organization</strong></p>
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

</div>
<p style="text-align: justify;"></p>

<input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-primary"/>