<?php
/*********************
 * portfolio.php
 *
 * CSCI S-75
 * Project 1
 * Chris Gerber
 *
 * Portfolio controller
 *********************/

require_once('../model/model.php');
require_once('../includes/helper.php');

if (isset($_SESSION['userid']))
{
	// get the list of holdings for user
	$userid = (int)$_SESSION['userid'];
	$holdings = get_user_shares($userid);
	
	render('portfolio', array('holdings' => $holdings));
}
else
{
	render('login');
}
?>
