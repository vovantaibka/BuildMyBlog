$(function() {
	var currentObject = $("input#current-object").val();
	var deleteUrl = "http://127.0.0.1:8000/admin/delete";
	var objectId = null;

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var modalCreateAndEdit = $("#create-and-edit-category-audio");
	var modalConfirm = $("#confirm");

	$("button.create").click(function() {
		// Set action form
		modalCreateAndEdit.find("input[name=action]").val("create");

		// Set title 
		modalCreateAndEdit.find("h5#title-modal-create-edit").text("Create New Category");		
		modalCreateAndEdit.find("input#button-submit").val("Create Category");

		// Set content
		modalCreateAndEdit.find("input#name").val("");
		
		modalCreateAndEdit.modal('show');
	})

	$("button.edit").click(function() {
		objectId = getIdObject(this);

		var viewUrl = "http://127.0.0.1:8000/admin";

		$.get(viewUrl + '/' + currentObject + "/" + objectId).done(function(response) {
			// Set action form
			modalCreateAndEdit.find("input[name=action]").val("edit");

			// Set id
			modalCreateAndEdit.find("input[name=category_id]").val(response.id);

			// Set title 
			modalCreateAndEdit.find("h5#title-modal-create-edit").text("Edit Category");		
			modalCreateAndEdit.find("input#button-submit").val("Save Category");

			// Set content
			modalCreateAndEdit.find("input#name").val(response.name);

			modalCreateAndEdit.modal('show');
		});

	})

	$("button.delete").click(function() {
		objectId = getIdObject(this);

		showConfirmModal("Time of thought begins 1..2..3..", "Do you want to delete this category?")
	});

	$("button#yes-modal-confirm").click(function() {
		modalConfirm.modal('hide');

		$.ajax({
			type: 'DELETE',
			url: deleteUrl + "/" + currentObject + "/" + objectId,
			success: function(data) {
				loadData(currentObject);
			}
		})
	})

	function getIdObject(element) {
		return $(element).siblings('input').val();
	}

	function showConfirmModal(title, content) {
		$("#title-modal-confirm").text(title);
		$("#content-modal-confirm").text(content);
		
		modalConfirm.modal('show');
	}

	function loadData(object) {
		var url = "http://127.0.0.1:8000/admin/list";
		$.get(url + '/' + object).done(function(response) {
			$("main").replaceWith(response.data);
		});
	}
})