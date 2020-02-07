<?php
    ob_start();
    include("../../libs/connexion.php");
    $id = $_REQUEST['id'];
    $query = 'SELECT * FROM propriete WHERE id=:id';
    $params = array(
        ':id' => $id
    );
    $stmt = $bdd->prepare($query);
    $stmt->execute($params);
    $row =  $stmt->fetch();
    $query1 = 'SELECT * FROM image WHERE id_propriete=:id';
    $params1 = array(
        ':id' => $id
    );
    $stmt1 = $bdd->prepare($query1);
    $stmt1->execute($params1);
    while($row1 =  $stmt1->fetch())
    {
        unlink('../../img/'.$row1['image_path']);
        $query2 = 'DELETE FROM image WHERE id=:id';
        $params2 = array(
            ':id' => $row1['id']
        );
        $stmt2 = $bdd->prepare($query2);
        $stmt2->execute($params2);
    }
    $query3 = 'DELETE FROM '.$row['type'].' WHERE id_propriete=:id';
    $params3 = array(
        ':id' => $id
    );
    $stmt3 = $bdd->prepare($query3);
    $stmt3->execute($params3);
    $query4 = 'DELETE FROM propriete WHERE id=:id';
    $params4 = array(
        ':id' => $id
    );
    $stmt4 = $bdd->prepare($query4);
    $stmt4->execute($params4);
    $msg = 'Suppression effectué avec succés.';
    $eror = 'success';
    $_SESSION['eror']['msg']=$msg;
	$_SESSION['eror']['type']=$eror;
	header('location:index.php');
?>