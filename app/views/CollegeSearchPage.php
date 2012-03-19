<div class="container">
	<div class="content">
		<div class="page-header">
			<h1> Available Colleges</h1>
		</div>
		<div class="row">
			<div class="span10">
				<?php $pulse = new Pulse();?>
				<?php foreach ($records as $row):
				?>
				<?php
				$test = $row -> id;
				?>

				<div class="ex" id='<?php echo $row -> Name;?>'>
					<?php echo $row -> Name;?>
					<?php echo $pulse -> voteHTML($test);?>
				</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</div>
