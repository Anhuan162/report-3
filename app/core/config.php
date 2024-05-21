<?php

if($_SERVER['SERVER_NAME'] == "localhost"){

	// for local server
	define("ROOT", "http://localhost/HGMusic/public");

	define("DBDRIVER", "mysql");
	define("DBHOST", "locahost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBNAME", "hgmusic_db");

}
else{
	// for online server
	define("ROOT", "http://www.mywebsite.com");

	define("DBDRIVER", "mysql");
	define("DBHOST", "locahost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBNAME", "hgmusic_db");
}

