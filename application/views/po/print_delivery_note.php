<?php
$bill = $this->bill_model->getBillById(base64_decode(urldecode($billId)));
$po = $this->purchaseOrder_model->getPOById($bill->poId);
$sales = $this->sale_model->getSalesByBillId($bill->id);
$customerInfo = $this->customer_model->getCustomerById($po->customerId);
$addressInfo = $this->customer_model->getAddress($po->customerAddressId);
$vehicleInfo = $this->customer_model->getVehicle($po->customerVehicleId);
$driverInfo = $this->customer_model->getDriver($po->customerDriverId);
$d = new DateTime();
$createDate = new DateTime($bill->date);
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
    <table  border="0"  width="100%">
        <tr>
            <td width="15%">&nbsp;</td>
            <td width="45%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
            <td width="15%" style="text-align: left; font-family: Monospace; font-size: 13px;">OPC</td>
        </tr>
        <tr>
            <td width="15%">&nbsp;</td>
            <td width="45%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
            <td width="15%" style="text-align: left; font-family: Monospace; font-size: 13px;"><?php echo str_pad($bill->id, 6, '0', STR_PAD_LEFT); ?></td>
        </tr>
        <tr>
            <td width="15%">&nbsp;</td>
            <td width="45%" style="text-align: left; font-family: Monospace; font-size: 13px;"><?php echo $createDate->format("d-M-Y"); ?></td>
            <td width="25%">&nbsp;</td>
            <td width="15%" style="text-align: left; font-family: Monospace; font-size: 13px;"><?php echo str_pad($po->id, 6, '0', STR_PAD_LEFT); ?></td>
        </tr>
        <tr>
            <td width="15%">&nbsp;</td>
            <td width="45%" style="text-align: left; font-family: Monospace; font-size: 13px;"><?php echo $customerInfo->name; ?></td>
            <td width="25%">&nbsp;</td>
            <td width="15%" style="text-align: left; font-family: Monospace; font-size: 13px;"><?php echo $customerInfo->code; ?></td>
        </tr>
        <tr>
            <td width="15%">&nbsp;</td>
            <td width="45%" style="text-align: left; font-family: Monospace; font-size: 13px;"><?php echo $addressInfo->address; ?></td>
            <td width="25%">&nbsp;</td>
            <td width="15%" style="text-align: left; font-family: Monospace; font-size: 13px;"><?php echo $addressInfo->address; ?></td>
        </tr>
        <tr>
            <td width="15%">&nbsp;</td>
            <td width="45%" style="text-align: left; font-family: Monospace; font-size: 13px;"><?php echo $customerInfo->phone; ?></td>
            <td width="25%">&nbsp;</td>
            <td width="15%" style="text-align: left; font-family: Monospace; font-size: 13px;">N/A</td>
        </tr>
    </table>
    <!--<table  border="0"  width="100%">
        <tr>
            <td style="font-family: Monospace; font-size: 13px;"><strong>DN #</strong></td>
            <td style="font-family: Monospace; font-size: 13px;"><?php echo str_pad($bill->id, 6, '0', STR_PAD_LEFT); ?></td>
            <td rowspan="2" style="text-align: center;" width="70%"></td>
            <td style="text-align: right; font-family: Monospace; font-size: 13px;"><strong>Date</strong></td>
            <td style="text-align: right; font-family: Monospace; font-size: 13px;"><?php echo $createDate->format("d-M-Y"); ?></td>
        </tr>
        <tr>
            <td style="font-family: Monospace; font-size: 13px;"><strong>PO #</strong></td>
            <td style="font-family: Monospace; font-size: 13px;"><?php echo str_pad($po->id, 6, '0', STR_PAD_LEFT); ?></td>
            <td style="text-align: right; font-family: Monospace; font-size: 13px;"><strong>Time</strong></td>
            <td style="text-align: right; font-family: Monospace; font-size: 13px;"><?php echo $createDate->format("h:i A"); ?></td>
        </tr>
    </table>-->
    <p style="text-align: justify; margin-top: 8px;">&nbsp;</p>
    <!--<table border="0" width="100%">
        <tr>
            <td width="15%" style="padding: 2px; font-family: Monospace; font-size: 13px;">Customer</td>
            <td width="50%" style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $customerInfo->name; ?></td>
            <td width="15%" style="padding: 2px; font-family: Monospace; font-size: 13px;">Customer Code</td>
            <td width="20%" style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $customerInfo->code; ?></td>
        </tr>
        <tr>
            <td style="padding: 2px; font-family: Monospace; font-size: 13px;">Delivery Location</td>
            <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $addressInfo->address; ?></td>
            <td style="padding: 2px; font-family: Monospace; font-size: 13px;">Region</td>
            <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $addressInfo->region; ?></td>
        </tr>
        <tr>
            <td style="padding: 2px; font-family: Monospace; font-size: 13px;">Contact No.</td>
            <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $customerInfo->phone; ?></td>
            <td style="padding: 2px; font-family: Monospace; font-size: 13px;">Remarks</td>
            <td style="padding: 2px; font-family: Monospace; font-size: 13px;">&nbsp;</td>
        </tr>
    </table>-->
    <table  border="0" width="100%">
        <tbody>
            <!--<tr>
                <td style="text-align: center; font-family: Monospace; font-size: 13px;"><strong>#</strong></td>
                <td style="text-align: center; font-family: Monospace; font-size: 13px;"><strong>Cont. Code</strong></td>
                <td style="text-align: center; font-family: Monospace; font-size: 13px;"><strong>Shipm. No.</strong></td>
                <td style="text-align: center; font-family: Monospace; font-size: 13px;"><strong>Manu. Week</strong></td>
                <td style="text-align: center; font-family: Monospace; font-size: 13px;"><strong>Quantity</strong></td>
                <td style="text-align: center; font-family: Monospace; font-size: 13px;"><strong>Line Quantity</strong></td>
            </tr>-->
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
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $counter++; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;">Supertech cement bags</td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $container->contCode; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $shipment->shippingNo; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;">&nbsp;</td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $stock->mWeek; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px; text-align: center;" width="15%"><?php echo $sale->qty; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                    <td style="text-align: center; font-family: Monospace; font-size: 13px;">&nbsp;</td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px; text-align: center;"><strong><?php echo $totalQty; ?></strong></td>
                </tr>
            </tbody>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <?php $displayName = $this->session->userdata('display_name'); ?>
                <table width="100%" border="0">
                    <tbody>
                        <tr>
                            <td style="padding: 2px; font-family: Monospace; font-size: 13px;" width="12.5%">&nbsp;</td>
                            <td style="padding: 2px; font-family: Monospace; font-size: 13px;" width="12.5%"><?php echo $driverInfo->name; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;" width="12.5%">&nbsp;</td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;" width="12.5%"><?php echo $driverInfo->licenceNo; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;" width="50%">&nbsp;</td>
                </tr>
                <tr>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;">&nbsp;</td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $driverInfo->phone; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;">&nbsp;</td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $vehicleInfo->regNo; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px; text-align: center;"><?php echo 'Issued By : ' . $displayName; ?></td>
                </tr>
            </tbody>
        </table>
        <!--<table width="100%" border="0">
            <tbody>
                <tr>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;">Vehicle No</td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;">Driver's Name </td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;">Signature</td>
                </tr>
                <tr>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $vehicleInfo->regNo; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php echo $driverInfo->name; ?></td>
                    <td style="padding: 2px; font-family: Monospace; font-size: 13px;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: justify;">&nbsp;</p>
        
        <table  border="0" width="100%">
            <tr>
                <td width="10%" style="padding: 2px; font-family: Monospace; font-size: 13px;"><strong>Issued By : </strong></td>
                <td width="90%" style="padding: 2px; font-family: Monospace; font-size: 13px;"><?php
        $displayName = $this->session->userdata('display_name');
                echo $displayName;
                ?></td>
        </tr>
    </table>-->
</div>

<p style="text-align: justify;"></p>

<input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-primary"/>

