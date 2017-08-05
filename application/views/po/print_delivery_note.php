<?php
$bill = $this->bill_model->getBillById(base64_decode(urldecode($billId)));
$po = $this->purchaseOrder_model->getPOById($bill->poId);
$sales = $this->sale_model->getSalesByBillId($bill->id);
$customerInfo = $this->customer_model->getCustomerById($bill->customerId);
$addressInfo = $this->customer_model->getAddress($po->customerAddressId);
$vehicleInfo = $this->customer_model->getVehicle($po->customerVehicleId);
$d = new DateTime();
$createDate = new DateTime($po->createdDate);
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
<p style="text-align: center;"><h3>Supertech Cements (Pvt) Ltd</h3></p>
<table  border="0"  width="100%">
    <tr>
        <td><strong>DN #</strong></td>
        <td><?php echo str_pad($po->id, 6, '0', STR_PAD_LEFT); ?></td>
        <td rowspan="2" style="text-align: center;" width="70%"><strong>DELIVERY NOTE</strong></td>
        <td style="text-align: right;"><strong>Date</strong></td>
        <td style="text-align: right;"><?php echo $createDate->format("d-M-Y"); ?></td>
    </tr>
    <tr>
        <td><strong>PO #</strong></td>
        <td><?php echo str_pad($po->id, 6, '0', STR_PAD_LEFT); ?></td>
        <td style="text-align: right;"><strong>Time</strong></td>
        <td style="text-align: right;"><?php echo $createDate->format("h:i A"); ?></td>
    </tr>
</table>
<p style="text-align: justify;">&nbsp;</p>
<table border="1" width="100%">
    <tr>
        <td width="15%" style="padding: 2px;">Customer</td>
        <td width="50%" style="padding: 2px;"><?php echo $customerInfo->name; ?></td>
        <td width="15%" style="padding: 2px;">Customer Code</td>
        <td width="20%" style="padding: 2px;"><?php echo $customerInfo->code; ?></td>
    </tr>
    <tr>
        <td style="padding: 2px;">Delivery Location</td>
        <td style="padding: 2px;"><?php echo $addressInfo->address; ?></td>
        <td style="padding: 2px;">Region</td>
        <td style="padding: 2px;"><?php echo $addressInfo->region; ?></td>
    </tr>
    <tr>
        <td style="padding: 2px;">Contact No.</td>
        <td style="padding: 2px;"><?php echo $customerInfo->phone; ?></td>
        <td style="padding: 2px;">Remarks</td>
        <td style="padding: 2px;">&nbsp;</td>
    </tr>
</table>
<p style="text-align: justify;">&nbsp;</p>
<table  border="1" width="100%">
    <tbody>
        <tr>
            <td style="text-align: center;"><strong>#</strong></td>
            <td style="text-align: center;"><strong>Cont. Code</strong></td>
            <td style="text-align: center;"><strong>Shipm. No.</strong></td>
            <td style="text-align: center;"><strong>Manu. Week</strong></td>
            <td style="text-align: center;"><strong>Quantity</strong></td>
            <td style="text-align: center;"><strong>Line Quantity</strong></td>
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
                <td style="padding: 2px;"><?php echo $counter++; ?></td>
                <td style="padding: 2px;"><?php echo $container->contCode; ?></td>
                <td style="padding: 2px;"><?php echo $shipment->shippingNo; ?></td>
                <td style="padding: 2px;"><?php echo $stock->mWeek; ?></td>
                <td style="padding: 2px;"><?php echo $sale->qty; ?></td>
                <td style="padding: 2px;"><?php echo $sale->qty; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="4">&nbsp;</td>
            <td style="text-align: center;"><strong>Total Quantity</strong></td>
            <td style="padding: 2px;"><strong><?php echo $totalQty; ?></strong></td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<p style="text-align: justify;"><strong>I here by confirm that I have checked and received the above mentioned goods from your organization</strong></p>
<table width="100%" border="1">
    <tbody>
        <tr>
            <td style="padding: 2px;">Vehicle No</td>
            <td style="padding: 2px;">Driver's Name </td>
            <td style="padding: 2px;">Signature</td>
        </tr>
        <tr>
            <td style="padding: 2px;"><?php echo $vehicleInfo->regNo; ?></td>
            <td style="padding: 2px;"><?php echo $vehicleInfo->driverName; ?></td>
            <td style="padding: 2px;">&nbsp;</td>
        </tr>
    </tbody>
</table>
<p style="text-align: justify;">&nbsp;</p>

<table  border="1" width="100%">
    <tr>
        <td width="10%" style="padding: 2px;"><strong>Issued By : </strong></td>
        <td width="90%" style="padding: 2px;"><?php $displayName = $this->session->userdata('display_name');
        echo $displayName;?></td>
    </tr>
</table>
</div>

<p style="text-align: justify;"></p>

<input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-primary"/>