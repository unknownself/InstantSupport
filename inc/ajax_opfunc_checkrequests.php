<?php
require_once('config.php');
if(isset($_POST['tryit']))
{
	$query = $db->query('SELECT * FROM requests');
	if($query->rowCount() > 0) {
		//echo '<b>Incoming request...</b><br>';
		foreach($query as $row)
		{
			if($row['operator_handling']=='') {
				//echo '<a class="btn btn-danger" onclick="popupchat('.$row['id'].')" href="#">Name: '.$row['name'].' - Not served yet</a> ';
				echo '
    <li class=""><a onclick="popupchat('.$row['id'].')" href="#tab'.$row['id'].'" data-toggle="tab"><font color="red">'.$row['name'].'</font></a></li>
  ';
			}
			else
			{
				//echo '<a class="btn btn-success" onclick="popupchat('.$row['id'].')" href="#">Name: '.$row['name'].' - Being served by: '.$row['operator_handling'].'</a> ';
				echo '
    <li id="act'.$row['id'].'" class=""><a onclick="popupchat('.$row['id'].')" href="#tab'.$row['id'].'" data-toggle="tab"><font color="green">'.$row['name'].'</font></a></li>
  ';
			}
			
		}
	}
	else
	{
		echo '<div class="alert alert-info fade in">No requests found...</div>';
	}
}
?>