<?php $this->load->helper('url'); ?>
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
	<div class="well">
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
	<button class="bt btn-large btn-primary pull-right" data-toggle="modal" href="#createCollegeModal">
		<i class="icon-plus icon-white"></i> Add that shit!
	</button>
	<p class="pull-right" style="margin-right: 1em">
		Don't see your Professor below?
	</p>
	<div class="btn-toolbar" align="center">
		<div class="btn-group">
			<button class="btn">
				A
			</button>
			<button class="btn">
				B
			</button>
			<button class="btn">
				C
			</button>
			<button class="btn">
				D
			</button>
			<button class="btn">
				E
			</button>
			<button class="btn">
				F
			</button>
			<button class="btn">
				G
			</button>
			<button class="btn">
				H
			</button>
			<button class="btn">
				I
			</button>
			<button class="btn">
				J
			</button>
			<button class="btn">
				K
			</button>
			<button class="btn">
				L
			</button>
			<button class="btn">
				M
			</button>
			<button class="btn">
				N
			</button>
			<button class="btn">
				O
			</button>
			<button class="btn">
				P
			</button>
			<button class="btn">
				Q
			</button>
			<button class="btn">
				R
			</button>
			<button class="btn">
				S
			</button>
			<button class="btn">
				T
			</button>
			<button class="btn">
				U
			</button>
			<button class="btn">
				V
			</button>
			<button class="btn">
				W
			</button>
			<button class="btn">
				X
			</button>
			<button class="btn">
				Y
			</button>
			<button class="btn">
				Z
			</button>
		</div>
	</div>
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
	<div class="well">
		<td>
		<tr>
			<td align="right">DEPARTMENT:</td>
			<?php echo $professor -> Department;?>
		</tr>
		<tr>
			<strong><h4><a class="btn-large" href="<?php echo  base_url("/Professor/view/".$collegeINFO -> State."/".$collegeINFO -> Name."/".$professor->FirstName.'/'.$professor->LastName.'/'.$professor->Department)?>"><?php echo $professor->FirstName." ".$professor->LastName
			?></a></h4></strong>
		</tr>
		<br />
		</td>
	</div>
	<?php endforeach;?>
	<?php }?>
	<div class="pagination" align="center">
		<ul>
			<li>
				<a href="#">Prev</a>
			</li>
			<li class="active">
				<a href="#">1</a>
			</li>
			<li>
				<a href="#">2</a>
			</li>
			<li>
				<a href="#">3</a>
			</li>
			<li>
				<a href="#">4</a>
			</li>
			<li>
				<a href="#">Next</a>
			</li>
		</ul>
	</div>
</div>
<!-- /container -->
<!--Start of the create professor model-->
<div class="modal hide fade" id="createCollegeModal">
	<?php
    echo form_open('Creat school or something');
	?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal" id="loginModalClose">X</a>
		<h3>Header</h3>
	</div>
	<div class="hero-unit">
		<form class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<div class="modal-body">
						<div>
							body
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-actions">
						<div>
							Footer
						</div>
					</div>
				</div>
			</fieldset>
		</form>
		<?php
        form_close();
		?>
	</div>
</div>
<!--End of the create professor model-->
