<?php
	ob_start();
	include_once("../../libs/connexion.php");
	include_once('../../libs/encrypt.php');
	session_start();
	$msg = $eror = 0;
	if(isset($_POST['connexion']))
	{
		$user=$_POST["pseudo"];
		$pass=$_POST["pass"];
		$query = 'SELECT id, password,admin FROM users WHERE username = :user';
		$params = array(
			':user' => $user
		);
		try{
			$stmt = $bdd->prepare($query);
			$stmt->execute($params);
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$row)
		{
			$msg = 'Identifiant invalide.';
			$eror= 'danger';
			$_SESSION['eror']['msg']=$msg;
    		$_SESSION['eror']['type']=$eror;
    		header('location:index.php');
    		echo '0';
		}
		else
		{
			extract($row);
			if (Back($password,$pass)) {
				$_SESSION['id'] = $id;
				$_SESSION['user'] = $user;
				$_SESSION['admin'] = $admin;
				header('location:../../back_office/accueil/');
				echo '1';
			}
			else 
			{
					$msg = 'Mot de passe invalide.';
					$eror= 'danger';
					$_SESSION['eror']['msg']=$msg;
            		$_SESSION['eror']['type']=$eror;
            		header('location:index.php');
            		echo '2';
			}
		}
		
		
	}
?>