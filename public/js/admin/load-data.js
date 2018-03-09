$(function() {
	var currentNavItem;
	var previousNavItem = $("#admin-page");

	var currentSubMenu;
	var previousSubMenu;

	var currentObject = $("input#object").val();
	var obj = currentObject;

	loadData(obj);

	$("[id=management]").on('click', function() {
		$("#mceu_28").hide();

		currentNavItem = $(this);

		previousNavItem.removeClass('nav-select');
		currentNavItem.addClass('nav-select');

		previousNavItem = currentNavItem;

		var subMenu = $(this).siblings('div.submenu');

		if(!subMenu[0]) {
			if(currentSubMenu) {
				currentSubMenu.hide();
			}

			$(this).addClass('nav-select');

			currentObject = $(this).children().first().val();
			loadData(currentObject);
		} else {
			if(previousSubMenu) {
				previousSubMenu.hide();
			}

			currentSubMenu = subMenu;

			var height = $('nav.sidebar').height();
			var width = $('nav.sidebar').width();

			subMenu.css('height', height);
			subMenu.css('width', width + 40);

			subMenu.show();

			previousSubMenu = currentSubMenu;
		}
	});

	$('a.btn-close').on('click', function() {
		currentSubMenu.hide();
	})

	function loadData(obj) {
		var url = apiUrl + "/list";
		$.get(url + '/' + obj).done(function(response) {
			$("main").replaceWith(response.data);
		});
	}
})