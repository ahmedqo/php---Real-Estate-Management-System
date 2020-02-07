<?php
 ob_start();
    include_once("../../libs/connexion.php");
    session_start();
    $eror = $msg = 0;
    $query = 'UPDATE propriete SET title = :titre,ville = :ville,adresse = :adresse,description = :description,prix = :prix,est_location = :est_location WHERE id = :id';
    $params = array(
        ':id' => $_POST['id'],
        ':titre' => $_POST['titre'],
        ':ville' => $_POST['ville'],
        ':adresse' => $_POST['adresse'],
        ':description' => $_POST['desc'],
        ':prix' => $_POST['prix'],
        ':est_location' => $_POST['location']
    );
    $stmt = $bdd->prepare($query);
    if($stmt->execute($params))
    {               
        $eror = 'success';             
    }
    else
    {
        $eror = 'danger';
    }  
    if(isset($_FILES['file']))
    {
        for($i=0;$i < count($_FILES['file']['name']); $i++)
        {
            $dir = '../../img/';
            $imagetype = $_FILES["file"]["type"][$i];
            $type = explode('/', $imagetype);
            $ext = end($type);
            $name = rand(111111, 999999) . "_" . rand(111111, 999999) . "_" . rand(111111, 999999) . "_" . time() . "." . $ext;
            $size  = $_FILES["file"]["size"][$i];
            if ($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif") 
            {
                if($size < 5000000)
                {
                    $path = $dir.$name;
                    if(move_uploaded_file( $_FILES["file"]["tmp_name"][$i],$path))
                    {
                        $query = 'INSERT INTO image(id_propriete,image_path) VALUES(:id_propriete,:image_path)';
                        $params = array(
                            ':id_propriete' => $_POST['id'],
                            ':image_path' => $name
                        );
                        $stmt = $bdd->prepare($query);
                        $stmt->execute($params);
                    }
                }
            }
        }
    }
    if(isset($_POST['appartement']))
    {
        $query = 'UPDATE appartement SET numero = :numero,etage = :etage,surface = :surface,chambre = :chambre,ascenseur = :ascenseur,piscine = :piscine,terrasse = :terrasse WHERE id_propriete = :id_propriete';
        $params = array(
            ':id_propriete' => $_POST['id'],
            ':numero' => $_POST['numero'],
            ':etage' => $_POST['etage'],
            ':surface' => $_POST['surface'],
            ':chambre' => $_POST['chambre'],
            ':ascenseur' => $_POST['Ascenseur'],
            ':piscine' => $_POST['Piscine'],
            ':terrasse' => $_POST['Terrasse']
        );
        $stmt = $bdd->prepare($query);
        if($stmt->execute($params))
        {               
            $eror = 'success';             
        }
        else
        {
            $eror = 'danger';
        }
    }
    if(isset($_POST['commerce']))
    { 
        $query = 'UPDATE commerce SET designation = :designation,surface = :surface WHERE id_propriete = :id_propriete';
        $params = array(
            ':id_propriete' => $_POST['id'],
            ':designation' => $_POST['designation'],
            ':surface' => $_POST['surface']
        );
        $stmt = $bdd->prepare($query);
        if($stmt->execute($params))
        {               
            $eror = 'success';             
        }
        else
        {
            $eror = 'danger';
        }
    }
    if(isset($_POST['immeuble']))
    { 
        $query = 'UPDATE immeuble SET nbr_etage = :nbr_etage,nbr_unite = :nbr_unite,surface_unite = :surface_unite,surface_totale = :surface_totale,ascenseur = :ascenseur,piscine = :piscine WHERE id_propriete = :id_propriete';
        $params = array(
            ':id_propriete' => $_POST['id'],
            ':nbr_etage' => $_POST['nbr_etage'],
            ':nbr_unite' => $_POST['nbr_unite'],
            ':surface_unite' => $_POST['unit_surface'],
            ':surface_totale' => $_POST['total_surface'],
            ':ascenseur' => $_POST['Ascenseur'],
            ':piscine' => $_POST['Piscine']
        );
        $stmt = $bdd->prepare($query);
        if($stmt->execute($params))
        {               
            $eror = 'success';             
        }
        else
        {
            $eror = 'danger';
        }
    }
    if(isset($_POST['terrain']))
    { 
        $query = 'UPDATE terrain SET surface = :surface WHERE id_propriete = :id_propriete';
        $params = array(
            ':id_propriete' => $_POST['id'],
            ':surface' => $_POST['surface']
        );
        $stmt = $bdd->prepare($query);
        if($stmt->execute($params))
        {               
            $eror = 'success';             
        }
        else
        {
            $eror = 'danger';
        }
    }
    if(isset($_POST['villa']))
    { 
        $query = 'UPDATE villa SET chambres = :chambre, surface_jardin = :surface_jardin, surface_villa = :surface_villa, piscine = :piscine WHERE id_propriete = :id_propriete';
        $params = array(
            ':id_propriete' => $_POST['id'],
            ':chambre' => $_POST['chambre'],
            ':surface_jardin' => $_POST['garden_surface'],
            ':surface_villa' => $_POST['villa_surface'],
            ':piscine' => $_POST['Piscine']
        );   
        $stmt = $bdd->prepare($query);
        if($stmt->execute($params))
        {               
            $eror = 'success';             
        }
        else
        {
            $eror = 'danger';
            print_r($stmt->errorInfo());
        }
    }
    if($eror == 'success'){  $msg = 'Modification effectué avec succés.'; }
    if($eror == 'danger'){ $msg = 'Modification non effectué.'; }
    $_SESSION['eror']['msg']=$msg;
	$_SESSION['eror']['type']=$eror;
	header('location:index.php');
?>