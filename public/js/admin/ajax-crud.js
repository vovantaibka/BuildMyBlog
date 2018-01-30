$(function() {
	var currentObject = $("input#current-object").val();
	var deleteUrl = "http://127.0.0.1:8000/admin/delete";
	var objectId = null;

	$("button.view").click(function() {
		objectId = $(this).siblings('input').val();

		var viewUrl = "http://127.0.0.1:8000/admin";

		$.get(viewUrl + '/' + currentObject + "/" + objectId).done(function(response) {
			$("#title-modal-view").text(response.category);

			var tags = response.tags;
			var html = "";

			html += "<h1>" + response.title + "</h1>";
			html += "<p class='lead'>" + response.body + "</p><hr>";
			html += "<div class='tags'>Tags: ";
			tags.forEach(function(element) {
				html += "<span class='label label-default'>" + element.name + "</span>"
			}) 
			html += "</div>";
			$("#content-post").html(html);
		});

		$("#view-post").modal('show');
	})

	$("button.delete").click(function() {
		objectId = $(this).siblings('input').val();
		showConfirmModal("Delete Post", "Do you want to delete this " + currentObject + "?")
	});

	$("button#yes-modal-confirm").click(function() {
		$("#modal-confirm").modal('hide');

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'DELETE',
			url: deleteUrl + "/" + currentObject + "/" + objectId,
			success: function(data) {
				loadData(currentObject);
			}
		})
	})

	function showConfirmModal(title, content) {
		$("#title-modal-confirm").text(title);
		$("#content-modal-confirm").text(content);
		
		$("#modal-confirm").modal('show');
	}

	function loadData(object) {
		var url = "http://127.0.0.1:8000/admin/list";
		$.get(url + '/' + object).done(function(response) {
			$("main").replaceWith(response.data);
		});
	}
})