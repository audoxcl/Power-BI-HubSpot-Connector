<?php

function Auth($authorization){
	list($type, $authorization) = explode(" ", $authorization);
	
	$valid_tokens = array(
		'FREETOKEN',
		'TOKEN1',
		'TOKEN2',
	);
	
	if(in_array($authorization, $valid_tokens)) return true;
	
	return false;
}

?>