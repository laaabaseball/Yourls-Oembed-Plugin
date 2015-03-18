<?php
/*
Plugin Name: YOURLS Oembed
Plugin URI: http://gkurl.us
Description: Makes all short URLS oembed the content into the page.
Version: 1.0
Author: laaabaseball
Author URI: http://laaatech.com
Disclaimer: Does not work on all websites. Based on the sample toolbar by ozh.
*/

// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

global $laaaoembed;
$laaaoembed['do'] = false;
$laaaoembed['keyword'] = '';

// When a redirection to a shorturl is about to happen, register variables
yourls_add_action( 'redirect_shorturl', 'laaaoembed_add' );
function laaaoembed_add( $args ) {
	global $laaaoembed;
	$laaaoembed['do'] = true;
	$laaaoembed['keyword'] = $args[1];
}

yourls_add_action( 'pre_redirect', 'laaaoembed_do' );
function laaaoembed_do( $args ) {
	global $laaaoembed;
	
	if( !$laaaoembed['do'] )
		return;

	// Do we have a cookie stating the user doesn't want a toolbar?
	if( isset( $_COOKIE['yourls_no_toolbar'] ) && $_COOKIE['yourls_no_toolbar'] == 1 )
		return;
	
	// Get URL and page title
	$url = $args[0];
	$pagetitle = yourls_get_keyword_title( $laaaoembed['keyword'] );

	// Update title if it hasn't been stored yet
	if( $pagetitle == '' ) {
		$pagetitle = yourls_get_remote_title( $url );
		yourls_edit_link_title( $laaaoembed['keyword'], $pagetitle );
	}
	if( $pagetitle == $url ) {
		$pagetitle = yourls_get_remote_title( $url );
		yourls_edit_link_title( $laaaoembed['keyword'], $pagetitle );
	}
	if( $pagetitle == '1' ) {
		$pagetitle = yourls_get_remote_title( $url );
		yourls_edit_link_title( $laaaoembed['keyword'], $pagetitle );
	}
	if( $pagetitle == '0' ) {
		$pagetitle = yourls_get_remote_title( $url );
		yourls_edit_link_title( $laaaoembed['keyword'], $pagetitle );
	}
	if( $pagetitle == '2' ) {
		$pagetitle = yourls_get_remote_title( $url );
		yourls_edit_link_title( $laaaoembed['keyword'], $pagetitle );
	}
	$_pagetitle = htmlentities( yourls_get_remote_title( $url ) );
	
	$www = YOURLS_SITE;
	$ver = YOURLS_VERSION;
	$md5 = md5( $url );
	$sql = yourls_get_num_queries();

	// When was the link created (in days)
	$diff = abs( time() - strtotime( yourls_get_keyword_timestamp( $laaaoembed['keyword'] ) ) );
	$days = floor( $diff / (60*60*24) );
	if( $days == 0 ) {
		$created = 'today';
	} else {
		$created = $days . ' ' . yourls_n( 'day', 'days', $days ) . ' ago';
	}
	
	// How many hits on the page
	$hits = 1 + yourls_get_keyword_clicks( $laaaoembed['keyword'] );
	$hits = $hits . ' ' . yourls_n( 'view', 'views', $hits );
	
	// Plugin URL (no URL is hardcoded)
	$pluginurl = YOURLS_PLUGINURL . '/'.yourls_plugin_basename( dirname(__FILE__) );
// Get twitter image
$twimage = $url;
$nowww =preg_replace('/www\./','',$url);
		$lower = mb_strtolower($url);
		$domain = parse_url($nowww);
		$host =mb_strtolower($domain["host"]);
		// this is my Amazon link code. Change it to yours if you'd like.
		if (preg_match('/amazon.com/', $lower, $matches)) {
		$amazonr = $lower;
		$amazonr = str_replace('tag=', 'tag=kurtomedia-20&', $amazonr);
		$gotourl = $amazonr;
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: $gotourl?tag=kurtomedia-20&");
		exit();
		}
		if (preg_match('/i.imgur.com/', $lower, $matches)) {
		$twimage = str_replace('.gif', 'h.jpg', $twimage);
		}
		else if (preg_match('/\.jpg|\.png|\.gif|\.jpeg/', $lower, $matches)) {
		}
		else if (preg_match('/youtube.com|youtu.be/', $url, $matches)) {
		
		function getYouTubeIdFromURL($url) 
{if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {  $values = $id[1];} else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {  $values = $id[1];} else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {  $values = $id[1];} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {  $values = $id[1];} else if (preg_match('/youtube\.com\/watch\?feature=player\_embedded\&v=([^\&\?\/]+)/', $url, $id)) {  $values = $id[2];}else {   $values = 'default';}return $values;
 }
$video_id = getYouTubeIdFromURL($url);
$video_id = preg_replace("/[^a-z0-9_-]/i", "", $video_id);
$video_id = substr($video_id,0,11);
if (isset($video_id)) { 
$twimage = ("http://img.youtube.com/vi/". $video_id . "/0.jpg"); 
} else { 
$twimage = ("http://img.youtube.com/vi/1/0.jpg"); 
 } 

		}
		else if (preg_match('/imgur.com\/a|imgur.com\/gallery/', $lower, $matches)) {
		//default twitter image to display if you want one
		$twimage = "0";
		}
		else if (preg_match('/imgur.com/', $lower, $matches)) {
		//$urlone = str_replace('imgur.com', 'i.imgur.com', $url);
		//$urltwo = ($urlone . ".jpg");
		//$twimage = str_replace('.jpg', 'h.jpg', $urltwo);
		$twimage = "0";
		}
		else if (preg_match('/reddit.com/', $host, $matches)) {
		$twimage = "0";
		}
		else{
		$twimage = "0";
		}





	// Ok let's call the page
	echo <<<PAGE
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" version="XHTML+RDFa 1.0" dir="ltr">

<head profile="http://www.w3.org/1999/xhtml/vocab">
  <meta charset="utf-8" />
<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="MobileOptimized" content="width" />
<meta name="Generator" content="YOURLS $ver" />
<meta name="HandheldFriendly" content="true" />
<meta name="twitter:card" content="photo">
<meta name="twitter:site" content="">
<meta name="twitter:creator" content="">
<meta name="twitter:title" content="$pagetitle">
<meta name="twitter:image:src" content="$twimage">
  <title>$pagetitle</title>
  

<link type="text/css" rel="stylesheet" href="css/main.css"/> 
  <script type="text/javascript">
<!--//--><![CDATA[//><!--
window.google_analytics_uacct = "UA-3508274-2";window.google_analytics_domain_name = ".gkurl.us";
//--><!]]>
</script>
<script type="text/javascript" src="user/plugins.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery(document).ready(function($) { 
	
	$("#navigation .content > ul").mobileMenu({
		prependTo: "#navigation",
		combine: false,
		switchWidth: 760,
		topOptionText: "Select a page"
	});
	
	});
//--><!]]>
</script>


</head>
<body class="html not-front logged-in no-sidebars page-pics" >
<!-- $sql queries -->
     <div id="wrap">
    <!-- #navigation -->
       <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">gkurl.us</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Home</a></li>
              <li><a href="/pics">Pics</a></li>
              <li><a href="/popular">Links</a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
	   
	   
	   <!-- /#navigation -->

    
  <div class="content">
  // my ad one. replace with yours
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- leader ads -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-7523814180813712"
     data-ad-slot="4440388690"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
//end ad section, more below
<br>
		<style>.views-exposed-widgets.clearfix,.oembedall-closehide{
display: none !important;
}.twitter-timeline{float:right;}#container{float:left;}</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="oembed/jquery.oembed.js"></script>
<link rel="stylesheet" type="text/css" href="oembed/jquery.oembed.css"> 
<script type="text/javascript">
        $(document).ready(function() {
                $("#container").oembed("$url");
        });
$(".oembed").oembed(null,{
    embedMethod: 'auto',    // "auto", "append", "fill" 
    apikeys: {
    }
});
</script>
<div id="container"></div>
$hits.
<div id="source">Source <a href="$url" title="$url"> $pagetitle</a>

</div>

// my ads. replace with your own
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- leader ads -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-7523814180813712"
     data-ad-slot="4440388690"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
//end ads  (more below)

// Disqus support
<div id="disqus_thread"></div>

<script type="text/javascript">

    var disqus_shortname = ''; // required: replace example with your forum shortname

    
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
		</div>
		
<div class="row">

      
<div class="col-lg-4">
<h2>Bookmarklets</h2>

<p>

<a href="javascript:(function()%7Bvar%20d=document,w=window,enc=encodeURIComponent,e=w.getSelection,k=d.getSelection,x=d.selection,s=(e?e():(k)?k():(x?x.createRange().text:0)),s2=((s.toString()=='')?s:enc(s)),f='<?php echo $page; ?>',l=d.location,p='?url='+enc(l.href)+'&title='+enc(d.title)+'&text='+s2,u=f+p;try%7Bthrow('ozhismygod');%7Dcatch(z)%7Ba=function()%7Bif(!w.open(u))l.href=u;%7D;if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();%7Dvoid(0);%7D)()" class="btn btn-sm btn-default">Default</a>

<a href="javascript:(function()%7Bvar%20d=document,w=window,enc=encodeURIComponent,e=w.getSelection,k=d.getSelection,x=d.selection,s=(e?e():(k)?k():(x?x.createRange().text:0)),s2=((s.toString()=='')?s:enc(s)),f='<?php echo $page; ?>',l=d.location,k=prompt(%22Custom%20URL%22),k2=(k?'&keyword='+k:%22%22),p='?url='+enc(l.href)+'&title='+enc(d.title)+'&text='+s2+k2,u=f+p;if(k!=null)%7Btry%7Bthrow('ozhismygod');%7Dcatch(z)%7Ba=function()%7Bif(!w.open(u))l.href=u;%7D;if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();%7Dvoid(0)%7D%7D)()" class="btn btn-sm btn-default">Custom</a>

<a href="javascript:(function()%7Bvar%20d=document,s=d.createElement('script');window.yourls_callback=function(r)%7Bif(r.short_url)%7Bprompt(r.message,r.short_url);%7Delse%7Balert('An%20error%20occured:%20'+r.message);%7D%7D;s.src='<?php echo $page; ?>?url='+encodeURIComponent(d.location.href)+'&jsonp=yourls';void(d.body.appendChild(s));%7D)();" class="btn btn-sm btn-default">Popup</a>

<a href="javascript:(function()%7Bvar%20d=document,k=prompt('Custom%20URL'),s=d.createElement('script');if(k!=null){window.yourls_callback=function(r)%7Bif(r.short_url)%7Bprompt(r.message,r.short_url);%7Delse%7Balert('An%20error%20occured:%20'+r.message);%7D%7D;s.src='<?php echo $page; ?>?url='+encodeURIComponent(d.location.href)+'&keyword='+k+'&jsonp=yourls';void(d.body.appendChild(s));%7D%7D)();" class="btn btn-sm btn-default">Custom Popup</a>

</p>

</div>
<br>
<div class="col-lg-4">

// these are my ads. put your own here if you want
<script type="text/javascript"><!--
google_ad_client = "ca-pub-7523814180813712";
/* box ads */
google_ad_slot = "6144957492";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
// end ad code
</div>
</div>
</div>
<div id="footer">
      <div class="container">
     </div>
  </div></div>
		</body>
		</html>
PAGE;
	
	// Don't forget to die, to interrupt the flow of normal events (ie redirecting to long URL)
	die();
}
