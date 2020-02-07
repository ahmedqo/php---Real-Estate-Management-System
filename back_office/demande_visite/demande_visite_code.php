<?php
	ob_start();
	include_once("../../libs/connexion.php");
	session_start();
    if(isset($_REQUEST['id']) && isset($_REQUEST['status']))
    {
        $query = 'UPDATE demande_visite SET status = :status WHERE id = :id ';
        $params = array(
			':id' => $_REQUEST['id'],
			':status' => $_REQUEST['status']
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
    }
	$_SESSION['eror']['msg']=$msg;
	$_SESSION['eror']['type']=$eror;
	header('location:index.php');
?>