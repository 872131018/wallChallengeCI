<?php /*
*Generate the json to return to the page for parsing
*/ ?>
<?php
if(isset($result) && $result === true)
{
	/*
	*On successful insert respond with success because call is done
	*/
	echo 'success';
	exit;
}
if(isset($result) && $result === false)
{
	echo 'failure';
	exit;
}
if(isset($comments) && $comments === false)
{
	/*
	*The wall is empty so return false
	*/
	echo 'false';
	exit;
}
?>
