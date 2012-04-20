<div class="container">
	<div class="hero-unit">
		<?php
		$professorName = $professorFirstName . ' ' . $professorLastName;
		$collegeName;
		echo "<h1>" . $catalogNumber . ' - ' . $courseName . "</h1>";
		echo "<h2>" . $professorName . "</h2>";
		echo "<h2>" . $collegeName . "</h2>";
		?>
	</div>
	<?php
	if (isset($comments)) {
		foreach ($comments as $comment) {
			echo '<div class="well">';
			echo $comment->DateString;
			echo $comment -> Comment;
			echo '</div>';
		}
	}
	else{
		echo '<div class="well">';
			echo "No comments found.  Have you taken this course?  Leave  comment!";
			echo '</div>';
	}
	?>
</div>
