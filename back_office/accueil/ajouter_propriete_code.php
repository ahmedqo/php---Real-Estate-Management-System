<?php
 ob_start();
    include_once("../../libs/connexion.php");
    session_start();
    $id = $danger = $eror = $msg = 0;
    $query = 'INSERT INTO propriete(title,ville,adresse,description,type,prix,est_location,created_at) VALUES(:titre,:ville,:adresse,:description,:type,:prix,:est_location,:created_at)';
    $params = array(
        ':titre' => $_POST['titre'],
        ':ville' => $_POST['ville'],
        ':adresse' => $_POST['adresse'],
        ':description' => $_POST['desc'],
        ':type' => $_POST['type'],
        ':prix' => $_POST['prix'],
        ':est_location' => $_POST['location'],
        ':created_at' => date("Y/m/d").' '.date("h:i:sa")
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
    $id = $bdd->lastInsertId();
    if(isset($_POST['appartement']))
    {
        if( $id != 0)
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
                                ':id_propriete' => $id,
                                ':image_path' => $name
                            );
                            $stmt = $bdd->prepare($query);
                            $stmt->execute($params);
                        }
                    }
                }
            }
            $query = 'INSERT INTO appartement(id_propriete,numero,etage,surface,chambre,ascenseur,piscine,terrasse) VALUES(:id_propriete,:numero,:etage,:surface,:chambre,:ascenseur,:piscine,:terrasse)';
            $params = array(
                ':id_propriete' => $id,
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
                print_r($stmt->errorInfo());
            }
        }
    }
    if(isset($_POST['commerce']))
    {
        if( $id != 0)
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
                                ':id_propriete' => $id,
                                ':image_path' => $name
                            );
                            $stmt = $bdd->prepare($query);
                            $stmt->execute($params);
                        }
                    }
                }
            }
            $query = 'INSERT INTO commerce(id_propriete,designation,surface) VALUES(:id_propriete,:designation,:surface)';
            $params = array(
                ':id_propriete' => $id,
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
    }
    if(isset($_POST['immeuble']))
    {
        if( $id != 0)
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
                                ':id_propriete' => $id,
                                ':image_path' => $name
                            );
                            $stmt = $bdd->prepare($query);
                            $stmt->execute($params);
                        }
                    }
                }
            }
            $query = 'INSERT INTO immeuble(id_propriete,nbr_etage,nbr_unite,surface_unite,surface_totale,ascenseur,piscine) VALUES(:id_propriete,:nbr_etage,:nbr_unite,:surface_unite,:surface_totale,:ascenseur,:piscine)';
            $params = array(
                ':id_propriete' => $id,
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
                print_r($stmt->errorInfo());
            }
        }
    }
    if(isset($_POST['terrain']))
    {
        if( $id != 0)
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
                                ':id_propriete' => $id,
                                ':image_path' => $name
                            );
                            $stmt = $bdd->prepare($query);
                            $stmt->execute($params);
                        }
                    }
                }
            }
            $query = 'INSERT INTO terrain(id_propriete,surface) VALUES(:id_propriete,:surface)';
            $params = array(
                ':id_propriete' => $id,
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
    }
    if(isset($_POST['villa']))
    {
        if( $id != 0)
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
                                ':id_propriete' => $id,
                                ':image_path' => $name
                            );
                            $stmt = $bdd->prepare($query);
                            $stmt->execute($params);
                        }
                    }
                }
            }
            $query = 'INSERT INTO villa(id_propriete,chambres,surface_jardin,surface_villa,piscine) VALUES(:id_propriete,:chambre,:surface_jardin,:surface_villa,:piscine)';
            $params = array(
                ':id_propriete' => $id,
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
            }
        }
    }
    if($eror == 'danger')
    {
        $msg = "Erreur d'insertion du proriete";
        $eror = 'danger';
        $query = 'DELETE * FROM propriete WHERE id=:id';
        $params = array(
            ':id' => $id
        );
        $stmt = $bdd->prepare($query);
        $stmt->execute($params);
        $query = 'SELECT * FROM image WHERE id_propriete=:id';
        $params = array(
            ':id' => $id
        );
        $stmt = $bdd->prepare($query);
        $stmt->execute($params);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            unlink('../../img/'.$row['image_path']);
            $query = 'DELETE FROM image WHERE id=:id';
            $params = array(
                ':id' => $row['id']
            );
            $stmt = $bdd->prepare($query);
            $stmt->execute($params);
        }
    }
    if($eror == 'success'){  $msg = 'Ajout effectué avec succés.'; }
    if($eror == 'danger'){ $msg = 'Ajout non effectué.'; }
    $_SESSION['eror']['msg']=$msg;
	$_SESSION['eror']['type']=$eror;
	header('location:index.php');
?>