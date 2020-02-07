<?php
    include_once("../../libs/connexion.php");
    $query = 'SELECT * FROM image WHERE id_propriete = :id';
    $params = array(
        ':id' => $_REQUEST['id']
    );
    $stmt = $bdd->prepare($query);
    $stmt->execute($params);
    $img = '';
    if($stmt->rowCount() != 0)
    {
        while($row = $stmt->fetch())
        {
            $img .= '
                <div style="width:180px;height:180px;margin:10px;float:left">
                    <div style="width:180px;height:180px;display:flex;justify-content:center;align-items:center;border:2px solid black;overflow:hidden">
                        <img src="../../img/'.$row['image_path'].'" style="width:auto;height:auto;max-height: 100%">
                    </div>
                    <div style="position:relative;top:-180px;left:140px;font-size:40px;color:white">
                        <span style="display:block;background:black;text-align: center;width: 40px;line-height: 40px">
                            <a href="supprimer_image_code.php?id='.$row['id'].'&ids='.$_REQUEST['id'].'" >&#x2716;</a>
                        </span>
                    </div>
                </div>
            ';
        }
    }
    $query1 = 'SELECT * FROM propriete WHERE id = :id LIMIT 1';
    $params1 = array(
        ':id' => $_REQUEST['id']
    );
    $stmt1 = $bdd->prepare($query1);
    $stmt1->execute($params1);
    $row1 = $stmt1->fetch();
    $query2 = 'SELECT * FROM '.$row1['type'].' WHERE id_propriete = :id LIMIT 1';
    $params2 = array(
        ':id' => $_REQUEST['id']
    );
    $stmt2 = $bdd->prepare($query2);
    $stmt2->execute($params2);
    $row2 = $stmt2->fetch();
    $results = array_merge($row1,$row2);
    $proriete = '
        <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
            Titre
        </div>
        <div class="col-2-4">
            <input type="text" class="input" id="titre" name="titre" placeholder="Titre" value="'.$results['title'].'" required>
        </div>
        <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
            Ville
        </div>
        <div class="col-2-4">
            <select name="ville" class="select" id="ville" required>
                <option value="Agadir-Ida Ou Tanan">Agadir</option>
                <option value="Al Haouz">Al Haouz</option>
                <option value="Al Hoceima">Al Hoceima</option>
                <option value="Azilal">Azilal</option>
                <option value="Azrou">Azrou</option>
                <option value="Beni Mellal">Beni Mellal</option>
                <option value="Benslimane">Benslimane</option>
                <option value="Berkane">Berkane</option>
                <option value="Boulemane">Boulemane</option>
                <option value="Casablanca">Casablanca</option>
                <option value="Chefchaouen">Chefchaouen</option>
                <option value="Chichaoua">Chichaoua</option>
                <option value="Chtouka Ait Baha">Chtouka Ait Baha</option>
                <option value="El Hajeb">El Hajeb</option>
                <option value="El Jadida">El Jadida</option>
                <option value="El Kelaa Des Sraghna">El Kelaa Des Sraghna</option>
                <option value="Errachidia">Errachidia</option>
                <option value="Essaouira">Essaouira</option>
                <option value="Fez">Fez</option>
                <option value="Figuig">Figuig</option>
                <option value="Ifrane">Ifrane</option>
                <option value="Inezgane Ait Melloul">Inezgane Ait Melloul</option>
                <option value="Jerada">Jerada</option>
                <option value="Kenitra">Kenitra</option>
                <option value="Khemisset">Khemisset</option>
                <option value="Khenifra">Khenifra</option>
                <option value="Khouribga">Khouribga</option>
                <option value="Larache">Larache</option>
                <option value="Marrakesh">Marrakesh</option>
                <option value="Mechra Bel Ksiri">Mechra Bel Ksiri</option>
                <option value="Mediouna">Mediouna</option>
                <option value="Meknes">Meknes</option>
                <option value="Mohammedia">Mohammedia</option>
                <option value="Moulay Yacoub">Moulay Yacoub</option>
                <option value="Nador">Nador</option>
                <option value="Nouaceur">Nouaceur</option>
                <option value="Ouarzazate">Ouarzazate</option>
                <option value="Ouezzane">Ouezzane</option>
                <option value="Oujda">Oujda</option>
                <option value="Rabat">Rabat</option>
                <option value="Safi">Safi</option>
                <option value="Salé">Salé</option>
                <option value="Sefrou">Sefrou</option>
                <option value="Settat">Settat</option>
                <option value="Sidi Kacem">Sidi Kacem</option>
                <option value="Skhirate-Temara">Skhirate-Temara</option>
                <option value="Tan-Tan">Tan-Tan</option>
                <option value="Tangier">Tangier</option>
                <option value="Taounate">Taounate</option>
                <option value="Taourirt">Taourirt</option>
                <option value="Tarudant">Tarudant</option>
                <option value="Taza">Taza</option>
                <option value="Tetouan">Tetouan</option>
                <option value="Tiznit">Tiznit</option>
                <option value="Zagora">Zagora</option>
            </select>
        </div>
        <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
            Adresse
        </div>
        <div class="col-2-4">
            <input type="text" class="input" id="adresse" name="adresse" placeholder="Adresse" value="'.$results['adresse'].'" required>
        </div>
        <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
            Prix
        </div>
        <div class="col-2-4">
            <input type="number" class="input" id="prix" name="prix" placeholder="Prix" value="'.$results['prix'].'" required>
        </div>
        <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
            Description
        </div>
        <div class="col-2-4">
            <textarea class="input" id="desc" name="desc" style="height:200px" placeholder="Description" required>'.$results['description'].'</textarea>
        </div>
    ';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modification immobiler | IMMO-MAROC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style2.css">
    <link href="../../css/materialsicons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../css/font-awesome/css/all.css">
    <script src="../../js/ajax.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-5" id="nav">
        </div>
        <div class="col-2-5" style="overflow:hidden">
            <div class="col-1" style="padding:50px">
            </div>
            <div class="col-1">
                <div class="container contents">
                    <div class="col-1">
                        <?php if($results['type'] == 'appartement'){ ?>
                            <form id="link1" action="modifier_propriete_code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="input" name="id" value="<?= $_REQUEST['id'] ?>" required>
                                <div class="container">
                                    <?= $proriete ?>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Chambres
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" id="chambre" name="chambre" placeholder="Nombre du chambres" value="<?= $results['chambre'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Surface
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" id="surface" name="surface" placeholder="Surface" value="<?= $results['surface'] ?>" required>
                                    </div>

                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Etage
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" id="etage" name="etage" placeholder="Etage" value="<?= $results['etage'] ?>" required>
                                    </div>

                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Numero
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" id="numero" name="numero" placeholder="Numero" value="<?= $results['numero'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Images
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl">             
                                        <input type="file" name="file[]" multiple style="display:none" title="file1">             
                                            <span id="file1" style="width:100%;color:grey">
                                                Selecter les images             
                                            </span>         
                                        </label>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Action
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type="radio" id="location" name="location" value="1" <?php if($results['est_location']){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Location
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type="radio" id="location" name="location" value="0" <?php if(!$results['est_location']){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Vente
                                            </span>
                                        </label> 
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Ascenseur
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type='radio' id="Ascenseur" name='Ascenseur' value="0" <?php if($results['ascenseur'] == 0){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Non
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type='radio' id="Ascenseur" name='Ascenseur' value="1" <?php if($results['ascenseur'] == 1){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Oui
                                            </span>
                                        </label> 
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Piscine
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type='radio' id="Piscine" name='Piscine' value="0" <?php if($results['piscine'] == 0){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Non
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type='radio' id="Piscine" name='Piscine' value="1" <?php if($results['piscine'] == 1){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Oui
                                            </span>
                                        </label> 
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Terrasse
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type='radio' id="Terrasse" name='Terrasse' value="0" <?php if($results['terrasse'] == 0){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Non
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type='radio' id="Terrasse" name='Terrasse' value="1" <?php if($results['terrasse'] == 1){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Oui
                                            </span>
                                        </label> 
                                    </div>
                                    <?= $img ?>	
                                    <div class="col-1">
                                        <input type="submit" value="Modifier" name="appartement" class="button" style="background:#337ab7;width:100%;">
                                    </div>
                                </div>
                            </form>
                        <?php }if($results['type'] == 'commerce'){ ?>
                            <form id="link2" action="modifier_propriete_code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="input" name="id" value="<?= $_REQUEST['id'] ?>" required>	
                                <div class="container">
                                    <?= $proriete ?> 
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Designation
                                    </div>
                                    <div class="col-2-4">
                                        <input type="text" class="input" name="designation" placeholder="Designation" value="<?= $results['designation'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Surface
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" name="surface" placeholder="Surface" value="<?= $results['surface'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Images
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"  id="files" title="file2">
                                        <input type="file" name="file[]" multiple style="display:none" title="file2">
                                            <span id="file2" style="width:100%;color:grey">                 
                                                Selecter les images             
                                            </span>         
                                        </label>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Action
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type="radio" id="location" name="location" value="1" <?php if($results['est_location']){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Location
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type="radio" id="location" name="location" value="0" <?php if(!$results['est_location']){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Vente
                                            </span>
                                        </label> 
                                    </div>
                                    <?= $img ?>
                                    <div class="col-1">
                                        <input type="submit" value="Modifier" name="commerce" class="button" style="background:#337ab7;width:100%;">
                                    </div>
                                </div>
                            </form>
                        <?php }if($results['type'] == 'immeuble'){ ?>
                            <form id="link3" action="modifier_propriete_code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="input" name="id" value="<?= $_REQUEST['id'] ?>" required>	
                                <div class="container">
                                    <?= $proriete ?>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Nombre etages
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" name="nbr_etage" placeholder="Nombre des etages" value="<?= $results['nbr_etage'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Nombre unite
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" name="nbr_unite" placeholder="Nombre des unites" value="<?= $results['nbr_unite'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Surface total
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" name="total_surface" placeholder="Surface Totale" value="<?= $results['surface_totale'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Surface unite
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" name="unit_surface" placeholder="Surface unite" value="<?= $results['surface_unite'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Images
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"  id="files" title="file3">
                                        <input type="file" name="file[]" multiple style="display:none" title="file3">             
                                            <span id="file3" style="width:100%;color:grey">                 
                                                Selecter les images             
                                            </span>         
                                        </label>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Action
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type="radio" id="location" name="location" value="1" <?php if($results['est_location']){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Location
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type="radio" id="location" name="location" value="0" <?php if(!$results['est_location']){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Vente
                                            </span>
                                        </label> 
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Ascenseur
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type='radio' id="Ascenseur" name='Ascenseur' value="0" <?php if($results['ascenseur'] == 0){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Non
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type='radio' id="Ascenseur" name='Ascenseur' value="1" <?php if($results['ascenseur'] == 1){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Oui
                                            </span>
                                        </label> 
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Piscine
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type='radio' id="Piscine" name='Piscine' value="0" <?php if($results['piscine'] == 0){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Non
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type='radio' id="Piscine" name='Piscine' value="1" <?php if($results['piscine'] == 1){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Oui
                                            </span>
                                        </label> 
                                    </div>
                                    <?= $img ?>	
                                    <div class="col-1">
                                        <input type="submit" value="Modifier" name="immeuble" class="button" style="background:#337ab7;width:100%;">
                                    </div>
                                </div>
                            </form>
                        <?php }if($results['type'] == 'terrain'){ ?>
                            <form id="link4" action="modifier_propriete_code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="input" name="id" value="<?= $_REQUEST['id'] ?>" required>	
                                <div class="container">
                                    <?= $proriete ?>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Surface
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" name="surface" placeholder="Surface" value="<?= $results['surface'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Images
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"  id="files" title="file4">             
                                        <input type="file" name="file[]" multiple style="display:none" title="file4">             
                                            <span id="file4" style="width:100%;color:grey">                 
                                                Selecter les images             
                                            </span>         
                                        </label>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Action
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type="radio" name="location" value="1" <?php if($results['est_location'] == 1){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Location
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type="radio" name="location" value="0" <?php if($results['est_location'] == 0){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Vente
                                            </span>
                                        </label> 
                                    </div>
                                    <?= $img ?>	
                                    <div class="col-1">
                                        <input type="submit" value="Modifier" name="terrain" class="button" style="background:#337ab7;width:100%;">
                                    </div>
                                </div>
                            </form>
                        <?php }if($results['type'] == 'villa'){ ?>
                            <form id="link5" action="modifier_propriete_code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="input" name="id" value="<?= $_REQUEST['id'] ?>" required>	
                                <div class="container">
                                    <?= $proriete ?>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Chambres
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" name="chambre" placeholder="Nombre du chambres" value="<?= $results['chambres'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Surface jardin
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" name="garden_surface" placeholder="Surface du jardin" value="<?= $results['surface_jardin'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Surface villa
                                    </div>
                                    <div class="col-2-4">
                                        <input type="number" class="input" name="villa_surface" placeholder="Surface du villa" value="<?= $results['surface_villa'] ?>" required>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Images
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"  id="files" title="file5">             
                                        <input type="file" name="file[]" multiple style="display:none" title="file5">             
                                            <span id="file5" style="width:100%;color:grey">                 
                                                Selecter les images             
                                            </span>         
                                        </label>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Action
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type="radio" id="location" name="location" value="1" <?php if($results['est_location']){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Location
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type="radio" id="location" name="location" value="0" <?php if(!$results['est_location']){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Vente
                                            </span>
                                        </label> 
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey;">
                                        Piscine
                                    </div>
                                    <div class="col-2-4">
                                        <label class="lbl"><input type='radio' id="Piscine" name='Piscine' value="0" <?php if($results['piscine'] == 0){echo 'checked';} ?>>
                                            <span style="border-right: 1px solid black;width:50%;">
                                                Non
                                            </span>
                                        </label>                       
                                        <label class="lbl"><input type='radio' id="Piscine" name='Piscine' value="1" <?php if($results['piscine'] == 1){echo 'checked';} ?>>
                                            <span style="border-left: 1px solid black;width:50%;">
                                                Oui
                                            </span>
                                        </label> 
                                    </div>
                                    <?= $img ?>	
                                    <div class="col-1">
                                        <input type="submit" value="Modifier" name="villa" class="button" style="background:#337ab7;width:100%;">
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-1" style="padding:50px">
            </div>
        </div>
    </div>


    <script>

        $(document).ready(function(){
			$.ajax({
				type:'POST',
				url:'../../libs/check.php',
				success: function(data){
					if(data == -1)
                    {
                        window.location.href = "../../back_office/login/";   
                    }
				}
			});
		});
        $(function(){
            $("#nav").load("../../back_office/menu.php"); 
        });
        $(':file').change(function(){
            var data = $(this).val();
            var array = data.split("\\")
            var colom = array.length - 1;
            var name = array[colom];
            var id = $(this).attr('title');
            $('#'+id).html(name);
            $('#'+id).css({color:'black'});
        })
    </script>
</body>
</html>