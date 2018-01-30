$(function() {
	var currentObject = $("input#object").val();
	var object = currentObject;

	loadData(object);

	$("[id=management]").click(function() {

		$("#mceu_28").hide();

		currentObject = $(this).children().first().val();

		loadData(currentObject);
	});

	function loadData(object) {
		var url = "http://127.0.0.1:8000/admin/list";
		$.get(url + '/' + object).done(function(response) {
			$("main").replaceWith(response.data);
		});
	}
})