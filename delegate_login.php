<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>PATA</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- Add custom CSS here -->
<link href="css/sb-admin.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<!-- Page Specific CSS -->
<link rel="stylesheet" href="css/morris-0.4.3.min.css">
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">PATA DELEGATE LOGIN</h1>
            <div class="account-wall">
                <img class="profile-img" src="images/user.png"
                    alt="">
                <form class="form-signin" action="query/delegate_login.php" id="logform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <input type="text"  class="form-control" placeholder="Company ID" name='txtuname' id='txtuname' required autofocus>
				<br>
                <input type="password" class="form-control" placeholder="Password" name='txtpword' id='txtpword' required>
				<br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
        </div>
    </div>
	<br><br>
	<?php
		if(isset($_GET['mes']))
		{
			if($_GET['mes'] == 1)
			{
				$_GET['mes'] = "The website is processing ATRTCM Business Matching and will be temporary unavailable for public. We will reopen in March 20.";
			}
			echo "<center><label style='font-weight:bold;color:red;'>".$_GET['mes']."</label></center>";
		}
	?>
</div>
</body>
</html>