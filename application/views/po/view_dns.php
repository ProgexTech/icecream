<div id="div-table">
   <legend>All Delivery Notes</legend>
   <table class="table">
      <thead>
         <th>DN #</th>
         <th>PO #</th>
         <th>Name</th>
         <th>Delivery Type</th>
         <th>Sale Type</th>
         <th>Ordered Quantity</th>
         <th>Issued Quantity</th>
         <th>Amount</th>
         <th>Issued Date</th>
         <th>Action</th>
      </thead>
      <tbody>
         <?php
            $allDeliveryNotess = $results;
            if ($allDeliveryNotess): foreach ($allDeliveryNotess as $bill): $customerInfo = $this->customer_model->getCustomerById($bill->customerId);
              $po = $this->purchaseOrder_model->getPOById($bill->poId);
              ?>     <?php ?>     
         <tr class="pgx-success">
            <td><?php echo str_pad($bill->id, 6, '0', STR_PAD_LEFT); ?></td>
            <td><?php echo str_pad($po->id, 6, '0', STR_PAD_LEFT); ?></td>
            <td><?php echo $customerInfo->name; ?></td>
            <td><?php echo $po->deliveryType; ?></td>
            <td><?php echo $po->saleType; ?></td>
            <td><?php echo $po->quantity; ?></td>
            <td><?php echo $bill->qty; ?></td>
            <td><?php echo $bill->amount; ?></td>
            <td><?php
               $dt = new DateTime($bill->date, new DateTimeZone("Asia/Colombo"));echo $dt->format('d.m.Y, H:i:s');
               ?></td>
            <td>       <a class="btn btn-primary btn-xs" role="button"   href="<?php echo base_url(); ?>view/printDeliveryNote/<?php echo urlencode(base64_encode($bill->id)); ?>">Re-Print</a> <a class="btn btn-danger btn-xs" role="button" href="<?php echo base_url(); ?>view/printDeliveryNote2/<?php echo urlencode(base64_encode($bill->id)); ?>">Old-Print</a>        </td>
         </tr>
         <?php
            endforeach;
                 else:
                  ?>    
         <tr>
            <td colspan="9">No Entries</td>
         </tr>
         <?php endif; ?>  
      </tbody>
   </table>
   <?php echo $links; ?>
</div>