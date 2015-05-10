<?php
/**
 * move functions to external file functions.inc
 * Purpose: to make a progressive enhancement based
 * google-maps-like interface
 * 
 * Author: Peter Nore
 * Date: July 6, 2011
 */

/**
 * returns the openstreetmap xtile number, given the 
 * latitude, longitude, and zoom
 */
function getXTile( $lat, $lon, $zoom ) {
  return floor((($lon + 180) / 360) * pow(2, $zoom));
}

/**
 * returns the openstreetmap ytile number, given the
 * latitude, longitude, and zoom
 */
function getYTile( $lat, $lon, $zoom ) {
  return floor((1 - log(tan(deg2rad($lat)) + 1 / cos(deg2rad($lat))) / pi()) /2 * pow(2, $zoom));
}

/**
 * if the image for $xtile, $ytile, $zoom is cached, returns
 * the filename of the cached image. if it is not cached, 
 * fetches and caches the given image from opencyclemap.
 */
function getCachedFname( $xtile, $ytile, $zoom ) {
  $remoteImageFilename = 
    "http://a.tile.opencyclemap.org/cycle/$zoom/$xtile/$ytile.png";
  // strip away everything except for /14/4944/6053
  $localImageFilename = preg_replace(
    "/(http:\/\/)(.*?)(cycle\/)(.*?)(.png)/","\\4", 
    $remoteImageFilename);
  // replace the forward slash '/' with underscore '_'
  $localImageFilename = preg_replace("/\//","_",
    $localImageFilename);
  $localImageDirectory = "images";
  $cacheName = 
    $localImageDirectory . "/" . $localImageFilename . ".png";
  // go get the remote image only if it's not in the cache
  // check to make sure it is strictly equal to false (===)
  if(file_exists($cacheName)===false){
    $image = file_get_contents($remoteImageFilename); 
    file_put_contents($cacheName, $image);
	// you need to set the permissions manually
	chmod($cacheName,644);
  } 
  return $cacheName;
}

function getMap() {
	require('handy.php');
	global $fname, $fnumber;
	// get the file requested in the browser 
	$fname = basename(htmlspecialchars($_SERVER['PHP_SELF']));
	// get the number before .php
	$fnumber = preg_replace( "/.*map(\\d+).*/", 
			"\\1", $fname );
	/*
	   all the code from last time is contained in its own
	   class.  the class is relative to the number contained
	   in this file.  First, source the file that has the
	   class. 
	 */
	include('Map'.$fnumber.'.class.php'); 
	// then, instantiate the new class.
	$classname = 'Map' . $fnumber; 
	return new $classname(); 
}
