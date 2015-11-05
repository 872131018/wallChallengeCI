/*
*Validation function to ensure post is ok to submit
*/
function checkPost()
{
	$('#feedback').html('');
	var isOk = 'true';
	/*
	*Required class on input element adds to list of checks
	*Each element in list can have seperate feedback by adding a case
	*/
	$('.required').each(function()
	{
		if($(this).val() == '')
		{
			switch($(this).attr('id'))
			{
				case 'name':
					$('#feedback').html($('#feedback').html()+'You need to enter a name!<br>');
					isOk = 'false';
					break;
				case 'comment':
					$('#feedback').html($('#feedback').html()+'You need to enter a comment!<br>');
					isOk = 'false';
					break;
			}
		}
	});
	if(isOk != 'false')
	{
		postComment();
	}
}
/*
*AJAX write to the database
*TODO: serialize the info, urlencode, and strip special characters
*/
function postComment()
{
	$.post(window.location.href+'index.php/welcome/fillWall',
	{
		'action': 'saveComment',
  	'name': $('#name').val(),
  	'email': $('#email').val(),
  	'website': $('#website').val(),
  	'comment': $('#comment').val()
	},
	function(response)
	{
		console.log(response);
		return true;
		/*
		*TODO: Consider refactoring checkResponse into callback
		*/
		checkResponse(response);
	});
}
/*
*the server will response with stuff, use the stuff to determine what to do
*TODO: Consider moving this into the ajax callback above
*/
function checkResponse(passedResponse)
{
	var response = passedResponse.split('>');
	var result = response[0];
	response = response[1];
	if(result == 'true')
	{
		formatComment(response);
	}
	else
	{
		//alert('do things if not ok');
	}
}

function formatComment(passedComment)
{
	var comment = $.parseJSON(passedComment);
	var commentString = '<li>';
	for(var key in comment)
	{
		switch(key)
		{
			case 'name':
				if(comment['email'] != '')
				{
					if(comment['website'] != '')
					{
						commentString += '<a href="http://'+comment['website']+'" target="_blank">'+comment[key]+'</a> | ';
					}
					else
					{
						commentString += '<a href="mailto:'+comment['email']+'?Subject=From%20the%20Wall!">'+comment[key]+'</a> | ';
					}
				}
				else
				{
					commentString += '<span>'+key+':'+comment[key]+'</span> | ';
				}
				break;

			case 'comment':
				commentString += '<span>'+key+':'+comment[key]+'</span> | ';
				if(comment['email'] != '' && comment['website'] != '')
				{
					commentString += '<span>'+
									 '<img src="http://www.gravatar.com/avatar/'+CryptoJS.MD5(comment['email'])+'?s=40"/>'+
									 ' | </span>';
				}
				break;

			case 'submittedAt':
				commentString += '<span>'+key+':'+comment[key]+'</span>';
				break;
			default:
				//commentString += '<span>'+key+':'+comment[key]+'</span> | ';
				break;
		}
	}
	commentString += '</li>';
	postToWall(commentString);
}

function postToWall(passedComment)
{
	$('#wallContainer').prepend(passedComment);
}
/*
*Primary call to server to retrieve messages for wall
*/
function fillWall(passedSortOrder)
{
	if(passedSortOrder)
	{
		passedSortOrder = 'ASC';
	}
	else
	{
		passedSortOrder = 'DESC';
	}
	/*
	*AJAX request to server sends an object and recieves json to update the wall
	*/
	$.post(window.location.href+'index.php/welcome/fillWall',
		{
			'action': 'getWallContents',
	  	'sortOrder': passedSortOrder
		},
		function(response)
		{
			if(response == 'false')
			{
				/*
				*server returns false on empty wall so display empty text
				*/
				postToWall('<li id="emptyWall"><span>There is nothing to post!</span></li>');
			}
			else
			{
				var responseObject = $.parseJSON(response);
				var rowObject = {};
				var i = 1;
				for(var key in responseObject)
				{
					var strippedKey = key.replace( /[0-9]/g, '');
					if(i%5 == 0)
					{
						rowObject[strippedKey] = responseObject[key];
						formatComment(JSON.stringify(rowObject));
						rowObject = {};
						i = 1;
					}
					else
					{
						rowObject[strippedKey] = responseObject[key];
						i++;
					}
				}
			}
		});
}
