
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
  $patientUserName = $_GET['patient'];
  $category = $_GET['category'];
  $pID;

  // Get pID of specified patient
  $query = "SELECT * FROM loginData";
  $result = mysqli_query($connect, $query);

  while ($row = mysqli_fetch_array($result))
  {
	 if ($row['username'] == $patientUserName)
	 {
		$pID = $row['uID'];
	 }
  }

  // Get permissions of professional with uID for patient with pID in category
  $query = "SELECT * FROM permissions";
  $result = mysqli_query($connect, $query);
  $allowedToAccess = false;
  while ($row = mysqli_fetch_array($result))
  {
	 if ($row['uID'] == $uID)
	 {
		if ($row['pID'] == $pID)
		{
		  if ( $row['category'] == $category )
		  {
			 $allowedToAccess = true;
		  }
		}
	 }
  }

  // Get patient data if $allowedToAccess
  $htmlReturn = "ERROR: You do not have permission to view this data!";
  if($allowedToAccess)
  {
	 $htmlReturn = "<table>";
	 $query = "SELECT * FROM medicalHistory";
	 $result = mysqli_query($connect, $query);
	 while ($row = mysqli_fetch_array($result))
	 {
		if ($row['uID'] == $pID)
		{
		  if ($row['uID'] == $pID)
		  {
			 if ($row['category'] ==  $category)
			 {
				$htmlReturn .= "<tr><td>";
				$htmlReturn .= $row['date'];
				$htmlReturn .= "</td><td>";
				$htmlReturn .= $row['name'];
				$htmlReturn .= "</td><td>";
				$htmlReturn .= $row['description'];
				$htmlReturn .= "</td></tr>";
			 }
		  }
		}
	 }
	 $htmlReturn .= "</table>";
  }

  if (isset($_COOKIE['categories']))
  {
	 $catList = $_COOKIE['categories'];
  } else {
  	$catList = "";
  }

  $catList .= "<li>";
  $catList .= $category;
  $catList .= "</li>";
  setcookie("categories", $catList, time()+3600);

  if (isset($_COOKIE['all']))
  {
  $allList = $_COOKIE['all'];
  } else {
  	$allList = "";
  }
  $allList .= $htmlReturn;

  setcookie("all", $allList, time()+3600);

  header('Location: https://cin.kc8khl.net/cardinalCodefest2014/requestPage.html');
  mysqli_close($connect);
?>