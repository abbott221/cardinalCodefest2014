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
	
        
        
        
        
        
        
        $rowcount = 0;
        $sql="SELECT * FROM messages";

        if ($result=mysqli_query($connect,$sql))
        {
            // Return the number of rows in result set
            $rowcount=mysqli_num_rows($result);
            //printf("Result set has %d rows.\n",$rowcount);
            // Free result set
            
            //wut?
            mysqli_free_result($result);
        }
        
        
        
        
        

	$sql = "INSERT INTO messages (postCount, threadID, uID, content)
	VALUES
	('$rowcount', '$_COOKIE[threadID]', '$_COOKIE[uid]', '$_POST[pContent]');";





	$result = mysqli_query($connect, $sql);
	
	
	//if (!mysqli_query($connect,$sql))
	if (!$result)
	{
	    die('Error: ' . mysqli_error($connect));
	}
	echo "1 record added";

	
	
//end updates



	
	mysqli_close($connect);
	
	
	
	header('Location: https://cin.kc8khl.net/cardinalCodefest2014/postsFront.php');
	
	
?>
