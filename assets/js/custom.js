/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    $('#customer-select').show();
    $('#customer-add').hide();

    $('#customer-type-combo').on('change', function() {
        if (this.value === 'UG') {
            $('#customer-select').hide();
            $('#customer-add').show();
        } else {
            $('#customer-select').show();
            $('#customer-add').hide();
        }
    });
    
});