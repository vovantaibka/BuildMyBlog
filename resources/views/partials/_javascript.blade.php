<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script>
    var apiUrl = '{{ url('/api/admin') }}';
    $(function() {
    	$("li.dropdown").click(function() {
            $("#menu-list").find("li").removeClass("active");
        })
        $('#page-home').parent().removeClass("container");
        $('#blog').addClass("container");
    })
</script>