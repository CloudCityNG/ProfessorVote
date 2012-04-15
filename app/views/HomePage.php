<div class="container">
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit raised">
		<h1>Welcome!!</h1>
		<p>
			ProfessorVote.com is a new and unique way of rating your College professors and getting a quick and easy view of the best professors at your school.
			Please Pick Your State Below to Get Started.
		</p>
		<div>
			<ul class="nav nav-pills">
				<li class="dropdown" id="menu1">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#StatesMenu"> States <b class="caret"></b> </a>
					<ul class="dropdown-menu">
						<?php foreach ($states as $row):
						?>
						<div class="ex" id='<?php echo $row -> id;?>'>
							<?php $state = $row -> state;?>
							<a href=<?php echo "home/showCollegesFromState/" . $state;?>><?php echo $state;?></a>
						</div>
						<?php endforeach;?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<?php $selectedState = $this -> session -> flashdata('state');?>
	<?php $colleges = $this -> College_model -> getCollegeByState($selectedState);?>;
	<?php if($selectedState || !$colleges == NULL){
	?>
	
	<div class="hero-unit raised">
		<h1><?php echo $selectedState
		?></h1>
		<p>
			Pick a school below!
		</p>
		<ul class="nav nav-list">
			<li class="nav-header">
				College
			</li>
			<?php if($colleges != NULL){?>
			<?php foreach ($colleges as $row):
			?>
			<div class="ex" id='<?php echo $row -> id;?>'>
				<?php $college = $row -> Name;?>
				<li>
					<a href="#"><?php echo $college;?></a>
				</li>
			</div>
			<?php endforeach;?>
			<?php }?>
		</ul>
	</div>
	<?php }?>
</div>
<!-- /container -->
