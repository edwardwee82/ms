<!DOCTYPE html>
<?php 
	include 'inc.tools.php';
	include './api/login.php'; 
?>

<head>
    <title>Management System</title>
	<?php
		echo callHeader();
	?>
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
	$x.= loginfrm();
	$x.="";
	return $x;
}

function getcontent()
{

	$x="<h5>Content</h5>";
	$x.="<a href='viewms.php'>View Clauses</a>";

	

	return $x;
	

}

function test()
{
	//Use of textbox
	$x="";
	$tbid='tClauses135';
	$ttype='tClauses';
	$idcol='clauseID';
	$id = 135;
	$tbl='tClauses';
	$col='ApplicabilityCriteria';
	$content='<p>Top management <span style="color: #e03e2d;"><strong>shall </strong></span>review the organization&rsquo;s environmental management system, at planned intervals, to ensure its continuing suitability, adequacy and effectiveness.<br>The management review <span style="color: #e03e2d;"><strong>shall </strong></span>include consideration of:</p>
	<p style="padding-left: 40px;">a) the status of actions from previous management reviews;<br>b) changes in:</p>
	<p style="padding-left: 80px;">1) external and internal issues that are relevant to the environmental management system;<br>2) the needs and expectations of interested parties, including compliance obligations;<br>3) its significant environmental aspects;<br>4) risks and opportunities;</p>
	<p style="padding-left: 40px;">c) the extent to which environmental objectives have been achieved;<br>d) information on the organization&rsquo;s environmental performance, including trends in:</p>
	<p style="padding-left: 80px;">1) nonconformities and corrective actions;<br>2) monitoring and measurement results;<br>3) fulfilment of its compliance obligations;<br>4) audit results;</p>
	<p style="padding-left: 40px;">e) adequacy of resources;<br>f) relevant communication(s) from interested parties, including complaints;<br>g) opportunities for continual improvement.</p>
	<p>The outputs of the management review <span style="color: #e03e2d;"><strong>shall </strong></span>include:</p>
	<p>&mdash; conclusions on the continuing suitability, adequacy and effectiveness of the environmental&nbsp;management system;<br>&mdash; decisions related to continual improvement opportunities;<br>&mdash; decisions related to any need for changes to the environmental management system, including&nbsp;resources;<br>&mdash; actions, if needed, when environmental objectives have not been achieved;<br>&mdash; opportunities to improve integration of the environmental management system with other business&nbsp;processes, if needed;<br>&mdash; any implications for the strategic direction of the organization.</p>
	<p>The organization <span style="color: #e03e2d;"><strong>shall </strong></span>&nbsp;retain documented information as evidence of the results of management reviews.</p>';
	$x.=jsTextbox($tbid, $ttype,$idcol,$id, $tbl, $content, $col);
	//$tbid, $ttype,$idcol,$id, $tbl, $content, $col

}

?>