<?php
if ( isset( $pageContent["Error"] ) ){
	if ( $pageContent["Error"] instanceof ControllerException ){
		$exception = $pageContent["Error"];
		$msg = $exception->getMessage();
		$head = getHTTPHeaderByCode( $exception->getCode() );
		header( $head, true, $exception->getCode() );
	} else {
		$msg = $pageContent["Error"];
	}
	?>
	<h4 class='error'><?php echo $msg ?></h4>
	<?php
} else {
	?>
		<td>
			<a href='?id=<?php echo $pageContent["Record"]->id; ?>'>
				<?php echo $pageContent["Record"]->name; ?>
			</a>
		</td>
		<td>
			<?php echo $pageContent["Record"]->name_last; ?>
		</td>
		<td>
			<?php echo $pageContent["Record"]->regUpdateTime; ?>
		</td>
	<?php
}
