$(function() {
	$("[id=management]").click(function() {
		var url = "http://127.0.0.1:8000/admin/list";
		var object = $(this).children().first().val();

		$.get(url + '/' + object, function(data) {
			$("main").replaceWith(data.response);
		});
	});
})