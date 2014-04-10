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
	exit();
}
?>

<td>
	<a href='<?php
		$href = getPageURL( "person" );
		$href .= "?id=" . $pageContent["Record"]->id;
		echo $href;
		?>'>
		
		<?php echo $pageContent["Record"]->name; ?>
	</a>
</td>
<td>
	<?php echo $pageContent["Record"]->name_last; ?>
</td>
<td>
	<?php echo $pageContent["Record"]->regUpdateTime; ?>
</td>
<td>
	<form action='<?php echo getPageURL( "person" ); ?>' method='PUT' 
		id='<?php echo $pageContent["Record"]->id; ?>' >
		
		<input type='hidden' id='' name='id' 
			value='<?php echo $pageContent["Record"]->id; ?>' />
		
		<input type='submit' class='submit' 
			id='<?php echo $pageContent["Record"]->id; ?>' value='poke' />
		
	</form>
	
</td>
