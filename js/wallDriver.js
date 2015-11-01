/*
*Once the page has finished loading set up a place to launch it
*/
$(document).ready(function()
{
	//TODO: implement button manager to set up buttons
	$('#postButton').on('click', function()
	{
		checkPost();
	});

	$('#sortOrder').on('click', function()
	{
		$('#wallContainer').html('');
		if($('#sortOrder').val() == 'ASC')
		{
			$('#sortOrder').val('DESC');
			fillWall($('#sortOrder').val());
		}
		else
		{
			$('#sortOrder').val('ASC');
			fillWall($('#sortOrder').val());
		}
	});
	/*
	*Initialize the bootstrap switch
	*/
	$("#sortOrder").bootstrapSwitch();
	/*
	*Ajax call to generate wall content
	*/
	fillWall($('#sortOrder').is(':checked'));
});
