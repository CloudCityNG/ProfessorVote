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
				<button class="btn btn-large dropdown-toggle" data-toggle="dropdown">
					Select A State <span class="caret"></span>
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
				</button>
			</div>
		</div>
	</div>
	<?php $selectedState = $this -> session -> flashdata('state');?>
	<?php $colleges = $this -> College_model -> getCollegeByState($selectedState);?>
	<?php if($selectedState){
	?>

	<div class="well raised">
		<h1><?php echo urldecode($selectedState);?></h1>
		
		<?php if($this->session->userdata('is_logged_in') == TRUE) {?>
		<button class="bt btn-large btn-primary pull-right" data-toggle="modal" href="#createCollegeModal">
               <i class="icon-plus icon-white"></i> Add that shit!
            </button>
            <?php } Else{?>
            <p class="pull-right" style="margin-right: 1em">
            Don't see your School below? Login to Add it!
        </p>
        <?php }?>
		<p>
			Pick a school below!
		</p>
		<p>
			
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



<!--Start of the create college model-->     
        <div class="modal hide fade" id="createCollegeModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal" id="loginModalClose"><i class="icon-remove"></i></a>
                <h3>Create <?php echo $this -> session -> flashdata('state')?> College</h3>
            </div>
            <div class="hero-unit">
                            <div class="modal-body">
                                <div>
                                <?php $headerLogin = $this -> load -> view("add_College_Form", TRUE);?>
                                </div>
                            </div>
            </div>
        </div>
<!--End of the create college model-->     
        
