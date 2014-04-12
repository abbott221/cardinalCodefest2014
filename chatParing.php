
<?php
  include 'globals.php';
?>


<?php
  //create connection and store the data for later use
  //host, username, password, dbname
  $connect = mysqli_connect($host,$user,$pass, $db);

  // Check connection
  if (mysqli_connect_errno($connect))
  {
	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $uID = $_COOKIE['uid'];
  $condition = array();
  $sharingUsers = array();

  // Get uID and username of non-anon patients
  $query = "SELECT * FROM loginData";
  $result = mysqli_query($connect, $query);

  while ($row = mysqli_fetch_array($result))
  {
	 if ($row['anon'] == 0)
	 {
		array_push($sharingUsers, $row['uID'], $row['username']);
	 }
  }

  // Get this user's contitions and adds them to the conditions array
  $query = "SELECT * FROM medicalHistory";
  $result = mysqli_query($connect, $query);
  while ($row = mysqli_fetch_array($result))
  {
	 if ($row['uID'] == $_COOKIE['uid'])
	 {
		array_push($condition, $row['name'], "");
	 }
  }

  // Find other users with any of the same conditions
  $partnerID;

  $query = "SELECT * FROM medicalHistory";
  $result = mysqli_query($connect, $query);
  while ($row = mysqli_fetch_array($result))
  {
	 if (array_key_exists($row['uID'], $sharingUsers)
	 {
		if (array_key_exists($row['name'], $condition)
		{
		  $partnerID = $row['uID'];
		}
	 }
  }

  // Check if already in conversation thread with $partnerID
  // Give them a cookie for existing thread or issue cookie
  // for new thread
  $threadCount=0;
  $threadID=0;
  $query = "SELECT * FROM threads";
  $result = mysqli_query($connect, $query);
  while ($row = mysqli_fetch_array($result))
  {
	 if ($row['uID'] == $_COOKIE['uid'])
	 {
		if ($row['partnerID'] == $partnerID)
		{
		  $partnerID = $row['uID'];
		}
	 }
	 $threadCount = $threadCount + 1;
  }
  if ($threadID == 0)
  {
	 $threadID = $threadCount;
  }

  setcookie("threadID", $threadID, time()+3600);
  header('Location: https://cin.kc8khl.net/cardinalCodefest2014/postsFront.html');
  mysqli_close($connect);
?>