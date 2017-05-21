<?php
 $order = $this->order_model->getOrderById(base64_decode(urldecode($orderId)));
 ?>
<form method="post" action="<?php echo base_url(); ?>order/edit">
    <input type="hidden" value="<?php echo $orderId?>" name="orderId"/>
    <div class="form-group">
        <label>Reference No</label>
        <input class="form-control" type="text" name="refNo" value="<?php echo $order[0]['refNo']; ?>" />
    </div>
    <div class="form-group">
        <label>Country</label>
        <input class="form-control" type="text" name="country" value="<?php echo $order[0]['country']; ?>" />
    </div>
    <div class="form-group">
        <label>Company</label>
        <input class="form-control" type="text" name="company" value="<?php echo $order[0]['company']; ?>" />
    </div>
    <div class="form-group">
        <label>Order No</label>
        <input class="form-control" type="text" name="orderNo" value="<?php echo $order[0]['orderNo']; ?>"/>
    </div>
    <div class="form-group">
        <label>Quantity</label>
        <input class="form-control" type="number" name="qty" value="<?php echo $order[0]['qty']; ?>" />
    </div>
<!--<div class="form-group">
        <label >Date</label>
        <input type="date" class="form-control" rows="3" name="date"/>
    </div>-->
     <div class="form-group">
        <label for="description">Field1</label>
        <input  class="form-control"  type="text" name="field1" value="<?php echo $order[0]['field1']; ?>"/>
    </div>
     <div class="form-group">
        <label for="description">Field2</label>
        <input class="form-control" type="text" name="field2" value="<?php echo $order[0]['field2']; ?>"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Edit Order" class="btn btn-primary"/>
    </div>
</form>
