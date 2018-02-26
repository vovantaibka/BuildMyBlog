$(function() {
	var currentNavItem;
	var previousNavItem = $("#admin-page");

	var currentSubMenu;

	var currentObject = $("input#object").val();
	var object = currentObject;

	loadData(object);

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
			currentSubMenu = subMenu;

			var height = $('nav.sidebar').height();
			var width = $('nav.sidebar').width();

			subMenu.css('height', height);
			subMenu.css('width', width + 40);

			subMenu.show();
		}
	});

	$('a.close-submenu').on('click', function() {
		currentSubMenu.hide();
	})

	function loadData(object) {
		var url = apiUrl + "/list";
		$.get(url + '/' + object).done(function(response) {
			$("main").replaceWith(response.data);
		});
	}
})