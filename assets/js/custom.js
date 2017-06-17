/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    var containerCounter = 1;

    $("#addButton").click(function () {

        if (containerCounter > 20) {
            alert("Only 20 containers are allowed");
            return false;
        }

        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + containerCounter);
        
        var removeButton = document.createElement('input');
        removeButton.setAttribute("class", 'btn btn-danger btn-sm');
        removeButton.type = 'button';
        removeButton.value = 'Remove';
        removeButton.onclick = function() {
            var p = $(this).parent().parent();
            $('#' + p.attr('id')).remove();
        };
        
        var holderDiv = document.createElement('div');
        holderDiv.innerHTML = '<div class="form-inline col-xs-8"><label>Container #' + containerCounter + ' (Quantity) : </label>' +
                '&nbsp <input type="text" class="form-control input-sm" name="container' + containerCounter +
                '" id="container' + containerCounter + '" value="" ></div>';
        
        newTextBoxDiv.append(holderDiv);
        holderDiv.append(removeButton);

        newTextBoxDiv.appendTo("#TextBoxesGroup");

        containerCounter++;
        $('#count').val(containerCounter);
    });
    
});