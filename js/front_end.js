

function openLink(url, newTab=false)
{
  location.href=url;
}

// Actived on every page
$(window).scroll(function(e){ 
	// Top
	// Margin (windowHeight)
	// Begin Article
	// ...
	// ...
	// End Article
	// Margin (windowHeight)
	// Bottom

	var windowHeight=$(window).height();
	var progressBar = $('.progress-bar'); 
	var progressBarDiv=$("#progressBarDiv");
	var currentPosition=$(this).scrollTop();
	var totalDocLength=$(document).height()-2*windowHeight;

  var currentPercentage=(currentPosition)/totalDocLength; 

	// Activate only within the article
	if ((currentPosition>windowHeight) && (currentPosition<totalDocLength))
	{
		progressBarDiv.slideDown('slow');
		progressBar.css({'width': currentPercentage*$(window).width()}); 
	}
	else
	{
		// Hide 
		progressBarDiv.slideUp('slow');
	}
});