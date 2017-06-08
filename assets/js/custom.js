/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    var counter = 2;

    $("#addButton").click(function () {

        if (counter > 20) {
            alert("Only 20 containers are allowed");
            return false;
        }

        var newTextBoxDiv = $(document.createElement('div'))
                .attr("id", 'TextBoxDiv' + counter);

        newTextBoxDiv.after().html('<label>Container #' + counter + ' (Quantity) : </label>' +
                '<input type="text" name="container' + counter +
                '" id="container' + counter + '" value="" >');

        newTextBoxDiv.appendTo("#TextBoxesGroup");


        counter++;
        $('#count').val(counter);
    });

    $("#removeButton").click(function () {
        if (counter == 1) {
            alert("No more container to remove");
            return false;
        }

        counter--;

        $("#TextBoxDiv" + counter).remove();

    });

    $("#getButtonValue").click(function () {

        var msg = '';
        for (i = 1; i < counter; i++) {
            msg += "\n Container #" + i + " : " + $('#container' + i).val();
        }
        alert(msg);
    });
});