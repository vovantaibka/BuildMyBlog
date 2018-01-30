$(function() {
	var currentObject = $("input#current-object").val();
	var deleteUrl = "http://127.0.0.1:8000/admin/delete";
	var objectId = null;

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