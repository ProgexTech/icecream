/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function openAddItemWindow(url)
{
    window.open(url, "Add_Bill_Item", "modal").focus();
    return false;
}

function closeAddItemWindow()
{
    window.close();
}