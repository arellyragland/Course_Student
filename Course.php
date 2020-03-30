
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<HEAD>
<title>CSC 460/560 - Week 5 Take Home </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</HEAD>

<BODY>
  <?php
    # turn php error reporting on
    ini_set('display_errors',1); 
    error_reporting(E_ALL);
	
	# Establish connection to MySQL 
	$db = mysqli_connect('localhost', 'webuser', '') 
		or DIE(mysql_error());
	    
	# Establish connection to database lab2 
	$db->select_db('week3db') 
		or DIE("Unable to select database" . mysql_error());
	
	# Start query 
	$query= "select cid, room, f.fid, fname, dept, rank
			    from course c, faculty f
		   	    where c.fid = f.fid ";
	
	# Continue query with user entered data if necessary
	
	if (($_POST['cid'] == "") 
		&& ($_POST['room'] == "") 
		&& ($_POST['fid'] == "")){
		# no criteria selected 
		# show all course/faculty information 
   			$query = $query . ";";
	}
	else if (($_POST['cid'] == "") 
		&& ($_POST['room'] == "") 
		&& ($_POST['fid'] != "")){
		# cid criteria selected 
		# show all course/faculty info for that particular cid
	   		$query = $query . "and f.fid = '{$_POST['fid']}'; ";	
	}
	else if (($_POST['cid'] == "") 
		&& ($_POST['room'] != "") 
		&& ($_POST['fid'] == "")){
		# cid criteria selected 
		# show all course/faculty info for that particular cid
	   		$query = $query . "and c.room = '{$_POST['room']}'; ";	
	}
	else if (($_POST['cid'] != "") 
		&& ($_POST['room'] == "") 
		&& ($_POST['fid'] != "")){
		# cid criteria selected 
		# show all course/faculty info for that particular cid
	   		$query = $query . "and c.cid = '{$_POST['cid']}' and f.fid= '{$_POST['fid']}';";	
	}
	else if (($_POST['cid'] != "") 
		&& ($_POST['room'] != "") 
		&& ($_POST['fid'] == "")){
		# cid criteria selected 
		# show all course/faculty info for that particular cid
	   		$query = $query . "and c.cid = '{$_POST['cid']}' and c.room = '{$_POST['room']}';";	
	}
	else if (($_POST['cid'] == "") 
		&& ($_POST['room'] != "") 
		&& ($_POST['fid'] != "")){
		# cid criteria selected 
		# show all course/faculty info for that particular cid
	   		$query = $query . "and c.room = '{$_POST['room']}' and f.fid= '{$_POST['fid']}';";	
	}


	$result = $db->query($query) 
		or DIE("Unable to read data" . mysql_error());
	
	
	# Display results to screen
	echo("Courses");
    	echo("<ul>");
	$query = mysql_query("SELECT * FROM Course;");

	while($row = mysql_fetch_array($query)) {
   	echo '<tr>';
    	foreach($row as $r) {
        echo '<td>'.$r.'</td>';   
    	}
    	echo '</tr>';
}
	/*while($row = $result->fetch_assoc()){
		echo ("<li>" .$row['cid'] 
			. " " . $row['room'] . " " . $row['fid'] . 
			" " . $row['fname'] . " " . $row['dept'] . " " . $row			['rank'] . "</li>");
	}*/

	echo("</ul>");
?> 
</BODY>
</HTML>