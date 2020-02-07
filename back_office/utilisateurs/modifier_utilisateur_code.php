<?php
	ob_start();
	include_once("../../libs/connexion.php");
    include_once('../../libs/encrypt.php');
    session_start();
	$id = $_POST['id'];
    $pseudo = $_POST['pseudo'];
    $pass='';
    $email = $_POST['email'];
    $admin = $_POST['admin'];
    if(back($_POST['pass'],$_POST['passe']) )
    {
        $pass = front($_POST['pass']);
    }
    else
    {
        $pass = $_POST['pass'];
    }
    $query = "UPDATE users SET password=:pass,email=:email,admin=:admin WHERE id=:id and username=:pseudo";
    $params = array(
        ':id' => $id,
        ':pseudo' => $pseudo,
        ':email' => $email,
        ':admin' => $admin,
        ':pass' => $pass
    );
    $stmt = $bdd->prepare($query);
    if($stmt->execute($params))
    {
        $msg = 'Modification effectué avec succés.';
        $eror = 'success';
    }
    else
    {
        $msg = 'Modification non effectué.';
        $eror = 'danger';
    }
    $_SESSION['eror']['msg']=$msg;
	$_SESSION['eror']['type']=$eror;
	header('location:index.php');
?>