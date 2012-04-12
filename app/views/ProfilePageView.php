<div class="container">
	<div class="hero-unit raised">
		<div class="page-header">
			<h1>User Profile for <?=$profile['username']?></h1>
		</div>
		
		<p><?=anchor('/profile/edit/'.$profile['username'], 'EDIT')?></p>
		<ul>
			<li>Username: <?=$profile['username']?></li>
			<li>Email Address: <?=$profile['email_address']?></li>
			<li>First Name: <?=$profile['first_name']?></li>
			<li>Last Name: <?=$profile['last_name']?></li>
		</ul>
	</div>
</div>


