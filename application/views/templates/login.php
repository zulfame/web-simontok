<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="icon" href="<?= base_url('assets/login/img/');?>/avatar.svg" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/');?>css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="<?= base_url('assets/login/');?>img/wave.png">
	<div class="container">
		<div class="img">
			<img src="<?= base_url('assets/login/');?>img/bg.svg">
		</div>
		<div class="login-content">
			<form method="post" action="<?= base_url('login/ceklogin');?>">
				<img src="<?= base_url('assets/login/');?>img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="user" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="pass" required>
            	   </div>
            	</div>
            	<a href="#">
            		<?php if(!empty($this->session->flashdata('hapus'))){ ?>
            			<?= $this->session->flashdata('hapus'); ?>
            		<?php } ?>
            	</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?= base_url('assets/login/');?>js/main.js"></script>
</body>
</html>
