<!DOCTYPE html>
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
								<?php
								$registerHeaderAttributes = array('id' => 'registerHeader');
								echo anchor('login/signup', 'Register', $registerHeaderAttributes);
								?>
							</li>
						</ul>
						<ul class="nav">
							<li>
								<?php
								$loginHeaderAttributes = array('id' => 'loginHeader');
								echo anchor('login', 'Login', $loginHeaderAttributes);
								?>
							</li>
						</ul>
						<?php } else {?>
						<ul class="nav">
							<li>
								<small class="navbar-text">User: <?=anchor('profile', $this->session->userdata('username'))
									?>
							</li>
						</ul>
						<ul class="nav">
							<li>
								<?php
								$logoutAttributes = array('id' => 'logout', 'class' => 'btn');
								echo anchor('login/logout', 'Logout', $logoutAttributes);
								?>
								<?php }?>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
