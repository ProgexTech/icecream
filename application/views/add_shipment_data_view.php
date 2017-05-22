<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

<style type="text/css">
    div{
        padding:8px;
    }
</style>

<script type="text/javascript">

    $(document).ready(function() {

        var counter = 2;

        $("#addButton").click(function() {

            if (counter > 20) {
                alert("Only 20 containers are allowed");
                return false;
            }

            var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", 'TextBoxDiv' + counter);

            newTextBoxDiv.after().html('<label>Container #' + counter + ' (Quantity) : </label>' +
                    '<input type="text" name="container'+counter+
                    '" id="container' + counter + '" value="" >');

            newTextBoxDiv.appendTo("#TextBoxesGroup");


            counter++;
            $('#count').val(counter);
        });

        $("#removeButton").click(function() {
            if (counter == 1) {
                alert("No more container to remove");
                return false;
            }

            counter--;

            $("#TextBoxDiv" + counter).remove();

        });

        $("#getButtonValue").click(function() {

            var msg = '';
            for (i = 1; i < counter; i++) {
                msg += "\n Container #" + i + " : " + $('#container' + i).val();
            }
            alert(msg);
        });
    });
</script>

<form method="post" action="<?php echo base_url(); ?>shipment/addShipment">
    <div class="form-group">
        <label>Shipping Id</label>
        <input class="form-control" type="text" name="shippingId" />
    </div>
    <div class="form-group">
        <label>Order No</label>
        <input class="form-control" type="text" name="orderNo" />
    </div>
    <div class="form-group">
        <label>Date</label>
        <input class="form-control" type="date" name="date" />
    </div>
    <div class="form-group">
        <label>Manufacturing Week</label>
        <input class="form-control" type="text" name="mWeek" />
    </div>
    <div id='TextBoxesGroup'>
        <div id="TextBoxDiv1">
             <input type="hidden" id="count" value="0" name="count">
            <label>Container #1 (Quantity): </label><input name="container[]" type='number' id='container1' >
            <input type='button' value='Add Button' id='addButton' class="btn btn-primary">
            <input type='button' value='Remove Button' id='removeButton' class="btn btn-primary">
        </div>
    </div>

    <div class="form-group">
        <input type="submit" value="Save Shipment Data" class="btn btn-primary"/>
    </div>
</form>
