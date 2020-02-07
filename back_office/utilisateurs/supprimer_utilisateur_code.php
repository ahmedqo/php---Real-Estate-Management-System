<?php
	ob_start();
    include("../../libs/connexion.php");
    $id = $_REQUEST['id'];
    $query = 'DELETE FROM users WHERE id=:id';
    $params = array(
        ':id' => $id
    );
    $stmt = $bdd->prepare($query);
    if($stmt->execute($params))
    {
        $msg = 'Suppression effectué avec succés.';
        $eror = 'success';
    }
    else
    {
        $msg = 'Suppression non effectué.';
        $eror = 'danger';
    }
    $_SESSION['eror']['msg']=$msg;
	$_SESSION['eror']['type']=$eror;
	header('location:index.php');
?>

