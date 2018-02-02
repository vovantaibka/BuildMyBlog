$(function() {
	var currentObject = $("input#current-object").val();
	var deleteUrl = "http://127.0.0.1:8000/admin/delete";
	var objectId = null;

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var modalCreateAndEdit = $("#create-and-edit-post");
	var modalView = $("#view-post");
	var modalConfirm = $("#confirm");

	$("button.create").click(function() {
		// Set action form
		modalCreateAndEdit.find("input[name=action]").val("create");

		// Set title 
		modalCreateAndEdit.find("h5#title-modal-create-edit").text("Create New Post");		
		modalCreateAndEdit.find("input#button-submit").val("Create Post");

		// Clean content
		modalCreateAndEdit.find("input#title").val("");
		modalCreateAndEdit.find("input#slug").val("");
		modalCreateAndEdit.find("select#category_id").val("");

		$("#tags").val("").select2();

		modalCreateAndEdit.find('img').attr("src", "#");

		$("span.select2").css('width', '100%');

		tinyMCE.get('tinymce-textarea').setContent("");

		var widthImg = $("#create-and-edit-post").find('img').width();

		$("#create-and-edit-post .upload-file").find('label input').css('width', '100%')

		modalCreateAndEdit.modal('show');
	})

	$("button.view").click(function() {
		objectId = getIdObject(this);

		var viewUrl = "http://127.0.0.1:8000/admin";

		$.get(viewUrl + '/' + currentObject + "/" + objectId).done(function(response) {
			$("#title-modal-view").text(response.category);

			var tags = response.tags;
			var html = "";

			html += "<h1>" + response.title + "</h1>";
			html += "<p class='lead'>" + response.body + "</p><hr>";
			html += "<div class='tags'>Tags: ";
			tags.forEach(function(element) {
				html += "<span class='badge badge-info'>" + element.name + " </span>"
			}) 
			html += "</div>";
			$("#content-post").html(html);
		});

		modalView.modal('show');
	})

	$("button.edit").click(function() {
		objectId = getIdObject(this);

		var viewUrl = "http://127.0.0.1:8000/admin";

		$.get(viewUrl + '/' + currentObject + "/" + objectId).done(function(response) {
			// Set action form
			modalCreateAndEdit.find("input[name=action]").val("edit");

			// Set id
			modalCreateAndEdit.find("input[name=post_id]").val(response.id);

			// Set title 
			modalCreateAndEdit.find("h5#title-modal-create-edit").text("Edit Post");		
			modalCreateAndEdit.find("input#button-submit").val("Save Post");

			// Set content
			modalCreateAndEdit.find("input#title").val(response.title);
			modalCreateAndEdit.find("input#slug").val(response.slug);
			modalCreateAndEdit.find("select#category_id").val(response.category_id);
			$("#tags").val(response.tags_id).select2();

			modalCreateAndEdit.find('img').attr("src", response.img_url);

			$("span.select2").css('width', '100%');


			tinyMCE.get('tinymce-textarea').setContent(response.body);

			// modalCreateAndEdit.find("form#form-post").attr('action', response.action)

			// console.log(response.action);

			modalCreateAndEdit.modal('show');
		});

	})

	$("button.delete").click(function() {
		objectId = getIdObject(this);

		showConfirmModal("Time of thought begins 1..2..3..", "Do you want to delete this " + currentObject + "?")
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