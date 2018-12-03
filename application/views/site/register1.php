<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>SE LPG V | Register</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    
    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>css/skeleton.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>css/style1.css">
    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="<?php echo base_url()."assets/"; ?>image/pertamina1.png">
</head>
<header>
    <div class="container" style="padding-bottom: 0px">
        <div class="row">
            <div class="one-half column" style="margin-top: 2%"><img src="<?php echo base_url()."assets/"; ?>image/logo.png" /></div>

            <!-- <div class="one-third column" style="margin-top: 3%"></div> -->

            <div class="one-half column" style="margin-top: 2%"><img style="float: right" src="<?php echo base_url()."assets/"; ?>image/bright_gas.png" /></div>

        </div>
    </div>
</header>
<body id="login_body" onload="document.FormLogin.UserName.focus();">
    <!-- Primary Page Layout
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <div class="login-padding">
        <div class="container">
            <div class="row">
                <div class="one-third column" style="margin-top: 1%"></div>
                <div class="one-third column" style="margin-top: 1%">
					<h1 style="font-family: Times, Serif;">SE LPG V</h1>
					<form action="<?php echo base_url(); ?>index.php/usercon/do_register" method="post">
						<div style="padding-bottom: 5px">
							<input class="u-full-width" type="text" placeholder="Username" id="username" name="username" tabindex="1" required>
						</div>
						<div style="padding-bottom: 5px">
							<input class="u-full-width" type="email" placeholder="Email" id="emailsignup" name="email" tabindex="2" required>
						</div>
						<div style="padding-bottom: 5px">
							<input class="u-full-width" type="password" placeholder="Password" id="password" name="password" tabindex="3" required>
						</div>
						<div style="padding-bottom: 5px">
							<input class="u-full-width" type="password" placeholder="Retype Password" id="repassword" name="repassword" tabindex="4" required>
						</div>
						<input class="u-full-width button-primary" name="register" type="submit" value="register">
					</form>
					<a href="<?php echo base_url()?>index.php/usercon/login1" class="text-center">Login</a>
					<?php echo validation_errors();?>
				</div>
                <div class="one-third column" style="margin-top: 1%">
				</div>
            </div>
        </div>
    </div>

    <!-- End Document
      –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
