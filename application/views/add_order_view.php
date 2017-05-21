<form method="post" action="<?php echo base_url(); ?>order/addOrder">
    <div class="form-group">
        <label>Reference No</label>
        <input class="form-control" type="text" name="refNo" />
    </div>
    <div class="form-group">
        <label>Country</label>
        <input class="form-control" type="text" name="country" />
    </div>
    <div class="form-group">
        <label>Company</label>
        <input class="form-control" type="text" name="company" />
    </div>
    <div class="form-group">
        <label>Order No</label>
        <input class="form-control" type="text" name="orderNo" />
    </div>
<!--<div class="form-group">
        <label >Date</label>
        <input type="date" class="form-control" rows="3" name="date"/>
    </div>-->
     <div class="form-group">
        <label for="description">Field1</label>
        <input  class="form-control"  type="text" name="field1"/>
    </div>
     <div class="form-group">
        <label for="description">Field2</label>
        <input class="form-control" type="text" name="field2"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Place Order" class="btn btn-primary"/>
    </div>
</form>
