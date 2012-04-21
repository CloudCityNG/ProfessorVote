<!DOCTYPE html>
<!--Start of the bar-->
<html>
	<head>
		<meta charset="utf-8">
		<title>"ProfessorVote.com"</title>
		<!-- Le styles -->
		<link href="/css/bootstrap.css" rel="stylesheet">
		<link href="/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="/CoursePulse/assets/css/pulse.css" rel="stylesheet">
		<style>
			body {
				padding-top: 60px;
				/* 60px to make the container go all the way to the bottom of the topbar */
			}
			.topbar .btn {
				border: 0;
			}
		</style>
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<?php
					$homeHeaderAttributes = array('id' => 'homeHeader', 'class' => 'brand');
					echo anchor('home', 'ProfessorVote.com', $homeHeaderAttributes);
					?>
					<form class="form-inline pull-right" style="display: inline; margin-bottom:
					0; margin-left: 15px">
						<?php if($this->session->userdata('is_logged_in') == FALSE) {
						?>
						<ul class="nav">
							<li>
								<a data-toggle="modal" href="#registerModal">Register</a>
							</li>
						</ul>
						<ul class="nav">
							<li>
								<a data-toggle="modal" href="#loginModal">Login</a>
							</li>
						</ul>
						<?php } else {?>
						<ul class="nav">
							<li>
								<small class="navbar-text">User: <?php $username = $this -> session -> userdata('username'); 
								echo anchor('profile/view_profile/'.$username, $username)?>
							</li>
						</ul>
						<ul class="nav">
							<li>
								<?php
								$logoutAttributes = array('id' => 'logout', 'class' => 'btn');
								echo anchor('login/logout', 'Logout', $logoutAttributes);
								?>
							</li>
						</ul>
						<?php }?>
					</form>
				</div>
			</div>
		</div>
		<!--End of the header bar-->
		<!--Start of the login model-->
		<div class="modal hide fade" id="loginModal">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" id="loginModalClose"><i class="icon-remove"></i></a>
				<h3>Please Login</h3>
			</div>
			<div class="hero-unit">
				<fieldset>
					<div class="control-group">
						<div class="modal-body">
							<?php $headerLogin = $this -> load -> view("login_form", TRUE);?>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
		<!--End of the login model-->
		<!--Start of the register model-->
		<div class="modal hide fade" id="registerModal">
			<div class="modal-header">
				<a class="close" data-dismiss="modal" id="registerModalClose"><i class="icon-remove"></i></a>
				<h3>Please Register Below</h3>
			</div>
			<div class="hero-unit">
				<fieldset>
					<div class="control-group">
						<div class="modal-body">
							<?php $headerLogin = $this -> load -> view("signup_form", TRUE);?>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
		<!--End of the register model-->
