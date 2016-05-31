<?php
include 'connect.php';
if(isset($_REQUEST["e"])){
$username=$_REQUEST["e"];
	if($username==""||$username==NULL)
	{
  echo "<script type='text/javascript'>
				document.location = 'administration.php';
				</script>";exit;
				}
	else
	{
	$con =mysqli_connect("localhost","root","","batashoedb");

		
	    $strSQL = "SELECT * FROM administrators where username='$username'";
		$rs = mysqli_query($con,$strSQL);
	       while($row = mysqli_fetch_array($rs))
	                {
		             if($row['logged']=="NO")
		             {	        
	                 echo "<script type='text/javascript'>
				          document.location = 'administration.php?e=''';
				           </script>";exit;
						   }
					}
				}
			        
	}
	else
	{
	 echo "<script type='text/javascript'>
				document.location = 'administration.php';
				</script>";exit;
				}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html >
<head>
<title>Phones And Accessories</title>
	<link rel="stylesheet" href="css/template.css" type="text/css" />
	<link rel="stylesheet" href="css/maini.css" type="text/css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.slideshow.min.js"></script>
	<script type="text/javascript" src="js/jquerytiming.js"></script>


</head>

<body>

	<div id="header">
	<div id="headerinside">	
		
 <div  align="left"id="logo"><img src="images/logo.png" width="261" height="75"></div>
 
 
			
	
	</div>
	<div id="topmenu">
	
	<A HREF="controlpanel.php<?php $username=$_REQUEST["e"];echo"?e=".$username;?>">Home</A>		
	<a href="administration.php<?php $username=$_REQUEST["e"];echo"?e=".$username;?>">Log Out |</a>
	
	</div>
	</div>
	
	
<div id="container">
<img src="images/topround.jpg" width="980" height="15" alt="" />






	<div id="leftsidebar">
	 
	<div style="padding-right:10px;padding-left:10px">			
	<div align="center" style="margin-top:10px" id="user4">
	
	
	</div>
	</div>
	</div>

	<div id="main">	
	<div align="center" style="margin-top:10px" id="user4">
<div id=log1><br>	
<?php
$username=$_REQUEST["e"];


if(($_POST["uname"]!=NULL)&&($_POST["pword"]!=NULL)&&($_POST["fname"]!=NULL)&&($_POST["lname"]!=NULL))

{
	if($_POST["cpword"]!=$_POST["pword"] )
	{
	 setcookie("cpword",1, time()+60);
	 echo "<script type='text/javascript'>
				document.location = 'controlpanel.php?e=".$username."';
				</script>";exit;
	
 	}	
	else
	{
	
    $con =mysqli_connect("localhost","root","","batashoedb");

	
	$uname=mysqli_real_escape_string($con,$_POST["uname"]);
	$password=mysqli_real_escape_string($con,$_POST["pword"]);
	$firstname=mysqli_real_escape_string($con,$_POST["fname"]);
	$lastname=mysqli_real_escape_string($con,$_POST["lname"]);
	$secondname=mysqli_real_escape_string($con,$_POST["sname"]);
	$idnumber=mysqli_real_escape_string($con,$_POST["idno"]);
	$depertment=mysqli_real_escape_string($con,$_POST["depertment"]);	
		
	$find = "SELECT * FROM administrators where username='".$uname."'";	
	$rows= mysqli_query($con,$find );
	$numberofrows=mysqli_num_rows($rows);
    if($numberofrows!=0)
		{
		setcookie("uname",1,time()+60);		
		echo "<script type='text/javascript'>
				document.location = 'controlpanel.php?e=".$username."';
				</script>";exit;
		}
		else
		{



//--------------------------------------------------------------------------------------------------------------------------------
 mysqli_query($con,"INSERT INTO administrators(username,`pass`, `firstname`, `lastname`, `secondname`, `nationalIdNo`,`depertment`)
                    VALUES
                    ('$uname','$password','$firstname','$lastname', '$secondname',' $idnumber','$depertment')");						

	$usern=mysqli_insert_id($con);
   echo "<h1>You have succesfully been registered!</h1>";
//---------------------------------------------------------------------------------------------------------------------------	

	
		// SQL query
	$strSQL = "SELECT * FROM administrators where employeeNo='".$usern."'";

	// Execute the query (the recordset $rs contains the result)
	$rs = mysqli_query($con,$strSQL);
	
	// Loop the recordset $rs
	// Each row will be made into an array ($row) using mysql_fetch_array
	while($row = mysqli_fetch_array($rs)) {

	   // Write the value of the column first name (which is now in the array $row)
	  echo "<p>Your User Name Is:". $row['username'] . " </p>";
	  echo "<p>Your Password Is:". $row['pass'] . " </p>";
	  echo "<p>Your Member Id Number Is:". $row['employeeNo'] . " </p>";
	  echo "<p align=center>Please Keep this information safe and never expose your password to anybody:</p>";	
	 
	  }
	
	mysqli_close();
	   }//end else rows
	    
		
	}//end else
	
	
 }
else{
setcookie("incomplete",1, time()+60);
echo "<script type='text/javascript'>
				document.location = 'controlpanel.php?e=".$username."';
				</script>";exit;
				}

?>		
	</div>
	</div>	
</div>
	<div id="rightsidebar">
	<div style="padding-right:10px;padding-left:10px">


	</div>
	</div>
	
<div style="clear:both"></div></div>

<div id="footer">
<P align="center">© Copyright Aslisted.com |Founded 2011| Afrisoft Computer Limited ~ All Rights Reserved</a></p>

<img src="images/botround.jpg" width="980" height="15" alt="" /></div>

</body>
</html>
