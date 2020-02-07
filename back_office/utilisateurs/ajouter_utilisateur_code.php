<?php
	ob_start();
	include_once("../../libs/connexion.php");
	include_once('../../libs/encrypt.php');
	session_start();
	$user = $_POST['pseudo'];
	$pass = $_POST['pass'];
	$email = $_POST['email'];
	$admin = $_POST['admin'];
	$query = 'SELECT * FROM users WHERE username=:user';
	$params = array(
		':user' => $user
	);
	$stmt = $bdd->prepare($query);
	$stmt->execute($params);
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	if($data)
	{
		$msg = 'Pseudo deja utiliser par un autre utilisateur';
		$eror = 'danger';
	}
	else
	{
		$query = 'INSERT INTO users(username,password,email,admin,created_at) VALUES(:user,:pass,:email,:admin,:date)';
		$params = array(
			':user' => $user,
			':pass' => front($pass),
			':email' => $email,
			':admin' => $admin,
			':date' => date('Y-m-d H:i:s')
		);
		$stmt = $bdd->prepare($query);
		if($stmt->execute($params))
		{
			$msg = 'Ajout effectué avec succés.';
			$eror = 'success';
		}
		else
		{
			$msg = 'Ajout non effectué.';
			$eror = 'danger';
		}
		
	}
	$_SESSION['eror']['msg']=$msg;
	$_SESSION['eror']['type']=$eror;
	header('location:index.php');
?>
