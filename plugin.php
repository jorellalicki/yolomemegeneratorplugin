<?php

/*
Plugin Name: yolomemegenerator
Plugin URI: http://yolome.me/yolomemegenerator
Description: This plugin yolomemes the urls, also makes it not look totally like shit
Version: 1.0
Author: Jorel
Author URI: http://lalicki.com
*/


// hook the function into the 'random_keyword' filter
yourls_add_filter( 'random_keyword', 'yolomemegenerator' );
yourls_add_filter( 'shunt_share_box', 'shareit' );

//This function outputs the url to share.
function shareit( $longurl, $shorturl) {
	global $shorturl;
	global $url;
	
	?> <link href='http://fonts.googleapis.com/css?family=Poller+One' rel='stylesheet' type='text/css'>
	<span style = "align:left;">Boring URL: <span class = "urlfont"> <?php echo $url; ?></span></br>
	Enhanced URL: <a class="urlfont" href=" <?php echo $shorturl; ?> "><?php echo $shorturl; ?> </a></span><?php
	return "false";
	
}




// Don't increment sequential keyword tracker since we're going random!
yourls_add_filter( 'get_next_decimal', 'ozh_random_keyword_next_decimal' );
function ozh_random_keyword_next_decimal( $next ) {
        return ( $next - 1 );
}



// Our VERY SERIOUS custom function
function yolomemegenerator( $original_keyword ) {
$original_keyword = yourls_rnd_string(6);
//Lookup table here!
$lookup = array(
    "a" => "420blazeit",
    "b" => "ujelly",
	"c" => "firinmahlazer",
    "d" => "yolo",
	"e" => "counttopotato",
    "f" => "over9000",
	"g" => "dickbutt",
    "h" => "dafuq",
	"i" => "impossibru",
    "j" => "stahp",    
	"k" => "basedgod",
    "l" => "couragewolf",    
	"m" => "insanitywolf",
    "n" => "wat",
	"o" => "dealwithit",
    "p" => "truestorybrah",
	"q" => "nyancat",
    "r" => "jimmierustling",
	"s" => "rule34",
    "t" => "pedobear",
	"u" => "doyouevenlift",
    "v" => "challengeaccepted",    
	"w" => "badluckbrian",
    "x" => "hatersgonnahate",
	"y" => "derp",
    "z" => "goodguygreg",    
	"0" => "doge",
    "1" => "trollface",
	"2" => "doabarrelroll",
    "3" => "megusta",
	"4" => "foreveralone",
    "5" => "ermahgerd",    
	"6" => "dolan",
    "7" => "scumbagsteve",
	"8" => "overlyattachedgirlfriend",
    "9" => "ridiculouslyphotogenicguy"
);
	$compiledstring;
	
	$strlen = strlen( $original_keyword );
	for( $i = 0; $i <= $strlen; $i++ ) {
		$char = substr( $original_keyword, $i, 1 );
		if ($i < $strlen)
		{
			$compiledstring .= ($lookup[$char] . "-");
		}
		else
		{
			$compiledstring .= $lookup[$char];
		}
	}

    // a filter function MUST return something once its arguments are processed
    return $compiledstring;
}