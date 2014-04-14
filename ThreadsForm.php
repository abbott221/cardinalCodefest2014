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
	
        
        
        
        
        
        
        $threadCount = 0;
        $sql="SELECT * FROM " . $threadTable;

        if ($result = mysqli_query($connect,$sql))
        {
            // Return the number of rows in result set
            $threadCount = mysqli_num_rows($result);
            //printf("Result set has %d rows.\n",$rowcount);
            // Free result set
            
            //wut?
            mysqli_free_result($result);
        }
        
        $threadCount += 1;
        
        
	
	
	
	
	
        

	$sql = "INSERT INTO " . $threadTable . " (threadID, threadName, usersInThread, postsInThread)
	VALUES
	('$threadCount', '$_POST[postSubject]', '1', '1');";




	$result = mysqli_query($connect, $sql);
	
	
	//if (!mysqli_query($connect,$sql))
	if (!$result)
	{
	    die('Error: ' . mysqli_error($connect));
	}
	//echo "1 record added";

	
	
	
	
	
	
	
	
	
	
	
	
	
	$postCount = 0;
        $sql="SELECT * FROM " . $postTable;
        //$sql="SELECT * FROM " . $threadTable;

        if ($result = mysqli_query($connect,$sql))
        {
            // Return the number of rows in result set
            $postCount = mysqli_num_rows($result);
            //printf("Result set has %d rows.\n",$rowcount);
            // Free result set
            
            //wut?
            mysqli_free_result($result);
        }
	
	$postCount += 1;
	
	
	
	
	
	
	
	
	
	
	//get username for the uID
	$foundName = "";
	
	$query = "SELECT * FROM " . $userTable;
	$result = mysqli_query($connect, $query);
	
	while ($row = mysqli_fetch_array($result))
	{
		if ($row['userID'] == $_COOKIE['uID'])
		{
			$foundName = $row['userName'];
		}
		
	}
	
	
	
	
	
	$sql = "INSERT INTO " . $postTable . " (threadID, postID, postContent, userID, userName)
	VALUES
	('$threadCount', '$postCount', '$_POST[postSubject]', '$_COOKIE[uID]', '$foundName');";



	$result = mysqli_query($connect, $sql);
	
	
	//if (!mysqli_query($connect,$sql))
	if (!$result)
	{
	    die('Error: ' . mysqli_error($connect));
	}
	//echo "1 record added";
	
	
	
	
	
	
	
	



	
	mysqli_close($connect);
	
	
	
	//header('Location: https://cin.kc8khl.net/cardinalCodefest2014/postsFront.php');
	//header('Location: http://localhost/ViewHome.php');
	
	//@HostError
	//header('Location: http://androidtesting.x10host.com/ViewHome.php');
	
	//@HostError
	$url = 'ViewHome.php';
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';
	
	
?>