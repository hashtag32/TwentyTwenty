

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
	var currentTopPosition=$(this).scrollTop();  
	var currentDownPosition=$(this).scrollTop() +windowHeight;  
	var totalDocLength=$(document).height()-2*windowHeight;  

	var currentPercentage=(currentTopPosition-windowHeight)/(totalDocLength-windowHeight);  
	
	// Activate only within the article
	if ((currentTopPosition>windowHeight) && (currentTopPosition<totalDocLength))
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