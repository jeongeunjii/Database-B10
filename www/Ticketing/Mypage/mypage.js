$(document).ready(function () {
	$(".row").click(function () {
    var num = $(this).attr('id');
    $(location).attr('href', "detail.html?num="+num);
	});
});
