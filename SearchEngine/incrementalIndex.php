<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>IG Search</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel='stylesheet prefetch' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
      <link rel="stylesheet" href="css/style.css">

</head>

<body class="b1">
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<header>
    <h1><i class="ion-social-instagram-outline"></i>Food Search <br> <span>[ Inspiration For Your Next Meal]</span></h1>
	<div class="cover">
		<form class="flex-form" action="server.php" method="post">
		<!--<form class="flex-form" onsubmit="return false">-->
			<label><i class="ion-search" style="color:black"></i></label>
		<input type="search" id="igAcc" name="igAcc" placeholder="Enter Instagram Account to crawl" >
		<input type="search" id="igNumber" name="igNumber" placeholder="No.Of Post to Crawl" >
		<input type="submit" id="sb"><!--<input type="submit" id="sb">-->
		</form>
	</div>
</header>


</body>



</html>
