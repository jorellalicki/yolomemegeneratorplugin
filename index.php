<?php

/*
 * The public page! hah!
 *
 * 
 *
 */

// Start YOURLS engine
require_once( dirname(__FILE__).'/includes/load-yourls.php' );

// Change this to match the URL of your public interface. Something like: http://yoursite.com/index.php
$page = YOURLS_SITE . '/index.php' ;

// Part to be executed if FORM has been submitted
if ( isset( $_REQUEST['url'] ) && $_REQUEST['url'] != 'http://' ) {

	// Get parameters -- they will all be sanitized in yourls_add_new_link()
	$url     = $_REQUEST['url'];
	$text    = isset( $_REQUEST['text'] ) ?  $_REQUEST['text'] : '' ;

	// Create short URL, receive array $return with various information
	$return  = yourls_add_new_link( $url, $keyword, $title );
	
	$shorturl = isset( $return['shorturl'] ) ? $return['shorturl'] : '';
	$message  = isset( $return['message'] ) ? $return['message'] : '';
	$title    = isset( $return['title'] ) ? $return['title'] : '';
	$status   = isset( $return['status'] ) ? $return['status'] : '';
	
	// Stop here if bookmarklet with a JSON callback function ("instant" bookmarklets)
 	if( isset( $_GET['jsonp'] ) && $_GET['jsonp'] == 'yourls' ) {
		$short = $return['shorturl'] ? $return['shorturl'] : '';
		$message = "Short URL (Ctrl+C to copy)";
		header('Content-type: application/json');
		echo yourls_apply_filter( 'bookmarklet_jsonp', "yourls_callback({'short_url':'$short','message':'$message'});" );
		
		die();
	} 
}

// Insert <head> markup and all CSS & JS files
yourls_html_head();



// Display title
echo "<h1>YoloMe.me - The YoloMeme URL Enhancer</h1>\n";

// Display left hand menu
//yourls_html_menu() ;



		$site = YOURLS_SITE;
		
		// Display the form
		echo <<<HTML
		<form method="post" action="">
		<p><label><input type="text" class="text" name="url" value="http://" /></label></p>
		
		</form>	
HTML;





// Part to be executed if FORM has been submitted
if ( isset( $_REQUEST['url'] ) && $_REQUEST['url'] != 'http://' ) {

	// Display result message of short link creation
	if( isset( $message ) ) {
		//echo "<h2>$message</h2>";
	}
	
	if( $status == 'success' ) {
		// Include the Copy box and the Quick Share box
		yourls_share_box( $url, $shorturl, $title, $text );
		
		// Initialize clipboard -- requires js/share.js and js/jquery.zclip.min.js to be properly loaded in the <head>
		echo "<script>init_clipboard();</script>\n";
	}

// Part to be executed when no form has been submitted
} 

?>



<?php

// Display page footer
//yourls_html_footer();	
