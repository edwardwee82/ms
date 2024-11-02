<!DOCTYPE html>
<head>
    <title>Index</title>
    <script src="https://cdn.tiny.cloud/1/tjwm8rfvtvnbrk7m1slkwdirjauctg8cffuleg4oqw3y4324/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<?php
	$menu=getmenu();
	$output=getcontent();
?>


<table width=100%>
	<tr>
		<td valign=top width=20%><?php echo $menu;  ?></td>
		<td valign=top><?php echo $output; ?></td>
	</tr>
</table>
</body>

<?php
function getmenu()
{
	$x="<h5>Menu</h5>";
	$x.="";
	return $x;
}

function getcontent()
{

	$x="<h5>Content</h5>";
	$x.="<a href='viewms.php'>View Clauses</a>";
	return $x;
}

?>