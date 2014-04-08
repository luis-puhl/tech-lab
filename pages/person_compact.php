<?php
if ( $pageContent["Error"] != "" ){
	?>
	<h4 class='error'><?php echo $pageContent["Error"]; ?></h4>
	<?php
} else {
	?>
		<td>
			<?php echo $pageContent["Record"]->name; ?>
		</td>
		<td>
			<?php echo $pageContent["Record"]->name_last; ?>
		</td>
		<td>
			<?php echo $pageContent["Record"]->regUpdateTime; ?>
		</td>
	<?php
}
