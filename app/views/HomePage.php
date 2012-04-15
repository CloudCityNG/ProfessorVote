<div class="container">
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit raised">
		<h1>Welcome!</h1>
		<p>
			ProfessorVote.com is a new and unique way of rating your College professors and getting a quick and easy view of the best professors at your school.
			Please Pick Your State in the Drop Down Menu Below to Get Started.
		</p>
		<div class="btn-toolbar">
			<div class="btn-group">
				<button class="btn btn-large">
					Select A State
				</button>
				<button class="btn btn-large dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php foreach ($states as $row):
					?>
					<li>
						<?php $state = $row -> state;?>
						<a href="<?php echo htmlentities("home/showCollegesFromState/" . $state);?>"><?php echo $state;?></a>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>
	<?php $selectedState = $this -> session -> flashdata('state');?>
	<?php $colleges = $this -> College_model -> getCollegeByState($selectedState);?>
	<?php if($selectedState){
	?>

	<div class="hero-unit raised">
		<h1><?php echo urldecode($selectedState);?></h1>
		<p>
			Pick a school below!
		</p>
		<ul class="nav nav-list">
			<li class="nav-header">
				State
			</li>
			<?php if($colleges != NULL){
			?>
			<?php foreach ($colleges as $row):
			?>
			<div class="ex" id='<?php echo $row -> id;?>'>
				<?php $college = $row -> Name;?>
				<li>
					<a href='<?php echo "/CollegePage/" . $selectedState . "/" . $college;?>'><?php echo $college;?></a>
				</li>
			</div>
			<?php endforeach;?>
			<?php }?>
		</ul>
	</div>
	<?php }?>
</div>
<!-- /container -->
