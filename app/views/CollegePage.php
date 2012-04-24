<script type="text/javascript">
	function clickMouseDown(theID){
		document.getElementById(theID).className= "well";
	}
	function clickMouseUp(theID){
		document.getElementById(theID).className = "well raised";
	}
	function divOnHover(obj, theID){
        obj.style.cursor = "pointer";
        //document.getElementById(theID).className = "well raised";
	}
	function gotoThis(url){
		window.location = url;
	}
</script>
<?php $this -> load -> helper('url');?>
<div class="container">
	<!-- this is the about us page for ProfessorVote -->
	<ul class="breadcrumb">
		<li>
			<a href=<?php echo "/home"?>>Home</a><span class="divider">/</span>
		</li>
		<li class="active">
			School
		</li>
	</ul>
	<div class="well raised">
		<h1><?php echo $collegeINFO -> Name;?></h1>
		<table width="100%">
			<tr>
				<td width="20%">
				<ul class="thumbnails">
					<li class="span3">
						<a href="#" class="thumbnail"> <img src="http://placehold.it/260x180" alt=""> </a>
					</li>
				</ul></td>
				<td width="65%">
				<table alight="left">
					<tr>
						<strong>Description:</strong>
					</tr>
					<br />
					<br />
					<tr>
						This is text and more text and more text.
					</tr>
					<br />
					<br />
					<tr>
						<h2>Location:</h2>
					</tr>
					<tr>
						<h3><?php echo $collegeINFO -> State;?></h3>
					</tr>
					<br />
					<br />
				</table></td>
				<td width="15%">
				<table>
					<tr>
						<strong><h4>Overall Rating:</h4></strong>
					</tr>
					<br />
					<tr>
						<div class="progress progress-striped">
							<div class="bar"
							style="width: 80%;"></div>
						</div>
					</tr>
					<tr>
						<h5>50 Likes | 10 Dislikes</h5>
					</tr>
				</table></td>
			</tr>
		</table>
	</div>
	<?php if($this->session->userdata('is_logged_in') == TRUE) {?>
        <button class="bt btn-large btn-primary pull-right" data-toggle="modal" href="#createCollegeModal">
               <i class="icon-plus icon-white"></i> Add It!
            </button>
            <?php } Else{?>
            <p class="pull-right" style="margin-right: 1em">
            Don't see your Professor below? Login to Add it!
        </p>
        <?php }?>
	<br />
	<!--
	<div class="clearfix">
	<legend>Comment / Rate</legend>
	<div class="input">
	<textarea style="resize: none;" cols="500" rows="6" name="myTextarea"></textarea>
	</div>
	</div>
	-->
	<?php
	if ($professors == NULL) {
	echo 'No professors found';
	} else {

	?>
	<?php foreach($professors as $professor): // for each professor print out a well unit
	?>
	<div class="well raised" id="Professor1" onmouseover="divOnHover(this, 'Professor1');" onmousedown = "clickMouseDown('Professor1');" onmouseup = "clickMouseUp('Professor1');"OnClick="gotoThis('<?php echo  site_url("/Professor/view/".$collegeINFO -> State."/".$collegeINFO -> Name."/".$professor->FirstName.'/'.$professor->LastName.'/'.$professor->Department)?>');">
		<td>
		<tr>
			<td align="right">DEPARTMENT:</td>
			<?php echo $professor -> Department;?>
		</tr>
		<tr>
			<strong><h4><?php echo $professor->FirstName." ".$professor->LastName?></h4></strong>
		</tr>
		<br />
		</td>
	</div>
	<?php endforeach;?>
	<?php }?>
</div>
<!-- /container -->
<!--Start of the create professor model-->
<div class="modal hide fade" id="createCollegeModal">
	<div class="modal-header">
		<a class="close" data-dismiss="modal" id="loginModalClose"><i class="icon-remove"></i></a>
		<h3>Add <?php echo $collegeINFO -> Name;?> Professor</h3>
	</div>
	<div class="hero-unit">
		<div class="modal-body">
			<div>
				<?php $headerLogin = $this -> load -> view("add_professor_form", TRUE);?>
			</div>
		</div>
	</div>
</div>
<!--End of the create professor model-->
