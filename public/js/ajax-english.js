$(function() {
	$("ul.nav-pills").find("li").click(function() {
		$(this).parent().find("a.active").removeClass("active");
		$(this).find("a").addClass("active");

		var categoryId = $(this).find("input[type=hidden]").val();

		var indexCategoryUrl = apiUrl + "/listenandread/category";

		$.get(indexCategoryUrl + '/' + categoryId).done(function(response) {
			$("ul.media-list").replaceWith(response.data);
		})
	})
})