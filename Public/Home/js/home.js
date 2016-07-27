/* 日期选择控件 */
$(function() {
    $('#datetimepicker').datetimepicker({
      	format: 'yyyy-MM-dd',
	    language: 'en',
	    pickDate: true,
	    pickTime: true,
	    hourStep: 1,
	    minuteStep: 15,
	    secondStep: 30,
	    inputMask: true
    });
});
// end