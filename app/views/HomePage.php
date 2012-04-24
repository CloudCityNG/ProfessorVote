<script type="text/javascript">
var typeaheadStarted = false;
var populated =false;
var schoolNames;
function populateSchoolNames(){
	if(populated==false){
		populated=true;
	
	$.ajax({
            type: "POST",            
            url: "<?php echo base_url();?>index.php/College/getAllNames",
          
            success: function(msg){
            	//alert("eppp");
schoolNames = ($.parseJSON(msg)).toString().split(',');
var i;
for(i=0;i<schoolNames.length;i++){
	schoolNames[i]=schoolNames[i].substring(1,schoolNames[i].length-1);
	//alert(schoolNames[i]);
}
startTypeahead();
//alert(schoolNames);
            //	$('#courseList').html(msg);
            	//$(document.body).animate({scrollTop: $(newCourseDiv).offset().top}, 1200);
            	//$.scrollTo(newCourseDiv, 800, {easing:'elasout'});            
        },
        error:function(xhr,err,ex){
     //   	alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
  //  alert("responseText: "+xhr.responseText);
  //  alert("exception: "+err);
  //  alert("exception: "+ex);

    document.getElementById('error_msg').innerText='Unknown error sending AJAX request for courselist.';
     document.getElementById('error_msg').style.display='block';
        }
        });
       }
}
function startTypeahead(){
	
	
	if(typeaheadStarted==false){
		typeaheadStarted=true;
		alert("starting");
		//alert(schoolNames[0]);
		
		
	//	for(name in schoolNames){
		//	alert(name);
		//}
		//var src = ['Kennesaw State University','Kasdaedawdeawdawd'].sort();
		$('school_name_tb').typeahead({
			source:schoolNames,
			items:8
		});
		$('school_name_tb').live("focus",
		typeahead({
			source:schoolNames,
			items:8
		});
		
		);
	}
}

	function chooseSchool(){
		//alert("chosen");
		var school_tb = $.trim($('#school_name_tb').val());
		alert(school_tb);
		if($.inArray(school_tb,window.schoolNames)>=0){
			alert(school_tb);
		}
		else
		alert('notfound');
	}
	
</script>
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit raised">
		<h1>Welcome!</h1>
		<p>
			ProfessorVote.com is a new and unique way of rating your College professors and getting a quick and easy view of the best professors at your school.
			Please Pick Your State in the Drop Down Menu Below to Get Started.
		</p>
		<div class="btn-toolbar">
			<div class="btn-group" style="display:inline-table">
				<button class="btn btn-large dropdown-toggle" data-toggle="dropdown" style="display:inline">
					Select A State <span class="caret"></span>
				</button>
				<p style="align:left">
				<?php
					//$typeaheadSchoolNameAttributes = array('id' => 'school_name_tb', 'class' => 'input-xlarge', 'placeholder' => 'or start typing your school name here:', 'type' => 'text', 'name' => 'school_name_tb','data-provide'=>'typeahead','autocomplete'=>'off','style'=>'display:inline;align:right;margin-right:0','onChange'=>'javascript:chooseSchool();','onFocus'=>'javascript:populateSchoolNames();');

					//echo form_input($typeaheadSchoolNameAttributes);
					?>	
					
				</p>
				
				<ul class="dropdown-menu">
					<?php 
					$this -> load -> model('State_model');
						$states = $this -> State_model -> getAllStates();
					foreach ($states as $row):
					?>
					<li>
						<?php

						$state = $row -> state;
					?>
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
        
