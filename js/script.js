/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $(document).ready(function(){
    jQuery.validator.addMethod("alphanumeric", function(value, element) 
    {
    return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
    }, "Cannot contain any special characters");

    jQuery.validator.addMethod("pin", function(value, element) 
    {
    return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
    }, "Cannot contain any special characters or space");
    jQuery.validator.addMethod("numeric", function(value, element) 
    {
    return this.optional(element) || /^[0-9]+$/i.test(value);
    }, "Only numbers allowed");
	 jQuery.validator.addMethod("float", function(value, element) 
    {
    return this.optional(element) || /^[0-9]+(\.([0-9]{1,2})?)?$/i.test(value);
    }, "Only decimal numbers allowed");
    $.validator.addMethod("customvalidation", function(value, element) {
   return this.optional(element) || /^[a-zA-Z ]*$/i.test(value);
    }, "Only alphabet and space allowed");
         $.validator.addMethod("city", function(value, element) {
       return this.optional(element) || /^[a-zA-Z0-9 ]*$/i.test(value);
    }, "Cannot contain any special characters");
    $.validator.addMethod("datetime", function(value, element) {
       return this.optional(element) || /^([0][1-9]|[12][0-9]|3[0-1])\/([0][1-9]|1[0-2])\/(\d{4}) ([0-9]|1[0-2])\:([0-5][0-9]) (am|pm)$/i.test(value);
    }, "Date format not valid");
	$.validator.addMethod("time", function(value, element) {
       return this.optional(element) || /^([0-9]|1[0-2])\:([0-5][0-9]) (am|pm)$/i.test(value);
    }, "time format not valid");
    //$('#get_quote_form').validate();
   // $('#vehicle_register_form').validate();
    $('.form').validate();
    $('.mobile_no').mask('9999999999');
    //$('.truck_no').mask('WB-');
	
	 $('#vehicle_type').change(function () {
	 $('.main_page_heading').hide();
	  $('.vehicle_image').show();
    var val = parseInt($('#vehicle_type').val());
    $('#vehicle_image').attr("src","images/vehicle_image/vehicle_"+val+".png");
});
    });

