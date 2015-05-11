<?php
/*********************************
 * model.php
 *
 * CSCI S-75
 * Project 1
 * Chris Gerber
 *
 * Model for users and portfolios
 *********************************/

// database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'jharvard');
define('DB_PASSWORD', 'crimson');
define('DB_DATABASE', 'jharvard_project1');

/*
 * login_user() - Verify account credentials and create session
 *
 * @param string $email
 * @param string $password
 */
function login_user($email, $password)
{
	// prepare email address and password hash for safe query
	$email = mysql_escape_string($email);
	$pwdhash = hash("SHA1",$password);
	
	// connect to database with mysql_
	$connection = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	
	// verify email and password pair
	$userid = 0;
	$query = sprintf("SELECT id FROM users WHERE LOWER(email)='%s' AND passwordhash='%s'",strtolower($email),$pwdhash);
	$resource = mysql_query($query);
	if ($resource)
	{
		$row = mysql_fetch_row($resource);
		if (isset($row[0]))
			$userid = $row[0];
	}
	
	// close database and return 
	mysql_close($connection);
	return $userid;
}

/*
 * get_user_shares() - Get portfolio for specified userid
 *
 * @param int $userid
 */
function get_user_shares($userid)
{
	// connect to database with PDO
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
	
	// get user's portfolio
	$stmt = $dbh->prepare("SELECT symbol, shares FROM portfolios WHERE userid=:userid");
	$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
	if ($stmt->execute())
	{
	    $result = array();
	    while ($row = $stmt->fetch()) {
			array_push($result, $row);
	    }
		$dbh = null;
		return $result;
	}
	
	// close database and return null 
	$dbh = null;
	return null;
}

/*
 * get_quote_data() - Get Yahoo quote data for a symbol
 *
 * @param string $symbol
 */
function get_quote_data($symbol)
{
	$result = array();
	$url = "http://download.finance.yahoo.com/d/quotes.csv?s={$symbol}&f=sl1n&e=.csv";
	$handle = fopen($url, "r");
	if ($row = fgetcsv($handle))
		if (isset($row[1]))
			$result = array("symbol" => $row[0],
							"last_trade" => $row[1],
							"name" => $row[2]);
	fclose($handle);
	return $result;
}

/*
 * register_user() - Create a new user account
 *
 * @param string $email
 * @param string $password
 * 
 * @return string $error
 */
function register_user($email, $password, &$error)
{
    $error = 'Your account could not be registered. Did you forget your password?';
    return false;
}

function get_user_balance($userid) { }

function buy_shares($userid, $symbol, $shares, &$error) { }

function sell_shares($userid, $symbol, &$error) { }
