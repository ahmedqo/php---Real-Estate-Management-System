<?php
 ob_start();
    include("../../libs/connexion.php");
    $id = $_REQUEST['id'];
    $query = 'SELECT * FROM image WHERE id=:id';
    $params = array(
        ':id' => $id
    );
    $stmt = $bdd->prepare($query);
    $stmt->execute($params);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    unlink('../../img/'.$row['image_path']);
    $query = 'DELETE FROM image WHERE id=:id';
    $params = array(
        ':id' => $row['id']
    );
    $stmt = $bdd->prepare($query);
    $stmt->execute($params);
   header('location:modifier_propriete.php?id='.$_REQUEST['ids']);
?>