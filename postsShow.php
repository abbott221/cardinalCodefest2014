<?php
	include 'globals.php';
?>

<?php
	
	$connect = mysqli_connect($host,$user,$pass,$db);
	
	
	// Check connection
	if (mysqli_connect_errno($connect))
	{
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	
	
	
	
	
	
	
	$query = "SELECT * FROM messages WHERE threadID = " . $_COOKIE['threadID'] . " ORDER BY postCount";
	
	$result = mysqli_query($connect,$query);
	//WHERE threadID = COOKIE[threadID]

	
	
	
	
	
	
	
	echo "<table border='1'>";
	echo "<tr>";
	
	//@RemoveLater
	echo "<th>Post Count</th>";
	
	echo "<th>Thread Number</th>";
	echo "<th>User ID</th>";
	echo "<th>Content</th>";
	echo "</tr>";
	
	while($row = mysqli_fetch_array($result))
	{
	    echo "<tr>";
	    
	    //@RemoveLater
	    echo "<td>" . $row['postCount'] . "</td>";
	    
	    echo "<td>" . $row['threadID'] . "</td>";
	    echo "<td>" . $row['uID'] . "</td>";
	    echo "<td>" . $row['content'] . "</td>";
	    echo "</tr>";
	}
	echo "</table>";
	
	

	mysqli_close($connect);
?>

