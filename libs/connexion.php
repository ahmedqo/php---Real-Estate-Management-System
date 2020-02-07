<?php
	$username = "root";
	$password = "";
	$host = "localhost";
	$dbname = "id11764940_immomaroc";
	try {
		$bdd = new PDO("mysql:host={$host};dbname={$dbname}",$username,$password);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>


