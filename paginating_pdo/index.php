<html>
	<head>
		<title>Paginating Your Data with AJAX and Awesome PHP Pagination Class</title>
	
	</head>
<body>
<div id='retrieved-data'>
	<!-- 
	this is where data will be  shown
	-->
    <img src="images/ajax-loader.gif" />
</div>

<script type = "text/javascript" src = "js/jquery-1.7.1.min.js"></script>
<script type = "text/javascript">
$(function() {
	//call the function onload
	getdata( 1 );
});

function getdata( pageno ){                     
	var targetURL = 'search_results.php?page=' + pageno;   

	$('#retrieved-data').html('<p><img src="images/ajax-loader.gif" /></p>');        
	$('#retrieved-data').load( targetURL ).hide().fadeIn('slow');
}      
</script>

</body>
</html>