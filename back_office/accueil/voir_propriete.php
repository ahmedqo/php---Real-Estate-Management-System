<?php include_once '../../libs/alert.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Accueil | IMMO-MAROC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style2.css">
    <link href="../../css/materialsicons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../css/font-awesome/css/all.css">
    <script src="../../js/ajax.js"></script>
    <style>
        .icon{
            width:80px;height:80px;position:relative;top:40px;left:30px;background:linear-gradient(60deg, #66bb6a, #43a047);border-radius:50%;color:white;font-size:40px;line-height:80px;text-align:center;box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgba(76, 175, 80, .4);
        }
    </style>
</head>
<body>
    <?php
        include_once("../../libs/connexion.php");
        $eror = $msg = 0;
        if(isset($_REQUEST['id']))
        {
            if(isset($_POST['envoyer']))
            {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $tele = $_POST['tele'];
                $email = $_POST['email'];
                $date = $_POST['date'];
                $now = date('Y-m-d');
                $id_propriete = $_POST['id'];
                if($date < $now)
                {
                    $eror = 'danger';
                    $msg = 'Date est expire.';
                }
                else
                {
                    $query00 = 'SELECT * FROM demande_visite WHERE id_propriete = :id AND nom = :nom AND prenom = :prenom AND tele = :tele AND email = :email LIMIT 1';
                    $params00 = array(
                        ':id' => $id_propriete,
                        ':nom' => $nom,
                        ':prenom' => $prenom,
                        ':tele' => $tele,
                        ':email' => $email
                    );
                    $stmt00 = $bdd->prepare($query00);
                    $stmt00->execute($params00);
                    if($stmt00->rowCount() > 0)
                    {
                        $eror = 'danger';
                        $msg = 'Demande deja exsiste.';
                    }
                    else
                    {
                        $query0 = 'INSERT INTO demande_visite(id_propriete,nom,prenom,tele,email,status,temp,created_at) VALUES(:id_propriete,:nom,:prenom,:tele,:email,:status,:temp,:created_at)';
                        $params0 = array(
                            ':id_propriete' => $id_propriete,
                            ':nom' => $nom,
                            ':prenom' => $prenom,
                            ':tele' => $tele,
                            ':email' => $email,
                            ':status' => 'En attend',
                            ':temp' => $_POST['date'],
                            ':created_at' => date("Y-m-d").' '.date("h:i:sa")
                        );
                        $stmt0 = $bdd->prepare($query0);
                        if($stmt0->execute($params0))
                        {               
                            $eror = 'success';
                            $msg = 'Demande bien ajoute.';            
                        }
                        else
                        {
                            $eror = 'danger';
                            $msg = 'Un erreur est effectue.'; 
                            print_r($stmt0->errorInfo()); 
                        }
                    }
                }
                $_SESSION['eror']['msg']=$msg;
                $_SESSION['eror']['type']=$eror;
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
    ?>
            <div class="container" style="flex-wrap: wrap;">
                <div class="col-5" id="nav" style="padding:0">
                </div>
                <div class="container col-2-5" style="justify-content:left">
                    <div class="col-1" style="padding:50px 0">
                        <div class="container">
                            <span style="font-size:40px">Detail immobilier</span>    
                        </div>
                    </div>
                    <div class='icon'>
                        <?php 
                            if($results['type'] == 'appartement')
                            { 
                        ?>
                            <i class="fas fa-building"></i>
                        <?php 
                            }
                            if($results['type'] == 'commerce')
                            { 
                        ?>
                            <i class="fas fa-store"></i>
                        <?php 
                            }
                            if($results['type'] == 'immeuble')
                            { 
                        ?>
                        <i class="fas fa-hotel"></i>
                        <?php 
                            }
                            if($results['type'] == 'terrain')
                            { 
                        ?>
                        <i class="fas fa-layer-group"></i>
                        <?php 
                            }
                            if($results['type'] == 'villa')
                            { 
                        ?>
                        <i class="fas fa-home"></i>
                        <?php 
                            }
                        ?>
                    </div>
                    <div class="col-1">
                        <div class="container contents">
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1">
                                <div class="container">
                                    <div class="col-1" style="font-size: 2em;display:flex;justify-content:center;color:blue">
                                        <span style="font-size:25px;line-height:34px;"><?= $results['title'] ?></span>
                                    </div>
                                    <div class="col-1">
                                        <?php
                                            $query = 'SELECT * FROM image WHERE id_propriete = :id';
                                            $params = array(
                                                ':id' => $_REQUEST['id']
                                            );
                                            $stmt = $bdd->prepare($query);
                                            $stmt->execute($params);
                                            if($stmt->rowCount() != 0)
                                            {
                                        ?>
                                            <div class="slideshow-container">
                                            <?php
                                                while($row = $stmt->fetch())
                                                {
                                            ?>
                                                <div class="mySlides">
                                                    <img src="../../img/<?= $row['image_path'] ?>" style="padding-top:4px;width:auto;height:auto;max-width:100%;">
                                                </div>
                                            <?php
                                                }
                                            ?>
                                                <a class="prev" style="left:0" onclick="plusSlides(-1)">&#10094;</a>
                                                <a class="next" style="right:0" onclick="plusSlides(1)">&#10095;</a>
                                            </div>  
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Type
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;" >
                                        <?= $results['type'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Ville
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;" >
                                        <?= $results['ville'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Type de bail
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;" >
                                        <?php  if($results['est_location']){echo 'location';}else{ echo 'vente';} ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Prix
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;" >
                                        <?= $results['prix'] ?> DH<?php  if($results['est_location']){echo ' / Mois';}?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Adresse
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;" >
                                        <?= $results['adresse'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Description
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;" >
                                        <?= $results['description'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <?php 
                                        if($results['type'] == 'appartement')
                                        { 
                                    ?>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Numero
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['numero'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Etage
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['etage'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Surface
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['surface'] ?> m²
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Chambres
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['chambre'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style=";font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Ascenseur
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?php if($results['ascenseur']){echo '<span style="color:green;font-size:40px">&#9745;</span>';}else{echo '<span style="color:red;font-size:40px">&#9746;</span>';} ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style=";font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Piscine
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?php if($results['piscine']){echo '<span style="color:green;font-size:40px">&#9745;</span>';}else{echo '<span style="color:red;font-size:40px">&#9746;</span>';} ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style=";font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Terrasse
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?php if($results['terrasse']){echo '<span style="color:green;font-size:40px">&#9745;</span>';}else{echo '<span style="color:red;font-size:40px">&#9746;</span>';} ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <?php 
                                        }
                                        if($results['type'] == 'commerce')
                                        { 
                                    ?>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Designation
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['designation'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Surface
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['surface'] ?> m²
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <?php 
                                        }
                                        if($results['type'] == 'immeuble')
                                        { 
                                    ?>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Nombre des etages
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['nbr_etage'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Nombre des unites
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['nbr_unite'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Surface du unite
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['surface_unite'] ?> m²
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Surface totale
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['surface_totale'] ?> m²
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style=";font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Ascenseur
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?php if($results['ascenseur']){echo '<span style="color:green;font-size:40px">&#9745;</span>';}else{echo '<span style="color:red;font-size:40px">&#9746;</span>';} ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style=";font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Piscine
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?php if($results['piscine']){echo '<span style="color:green;font-size:40px">&#9745;</span>';}else{echo '<span style="color:red;font-size:40px">&#9746;</span>';} ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <?php 
                                        }
                                        if($results['type'] == 'terrain')
                                        {         
                                    ?>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Surface
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['surface'] ?> m²
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <?php 
                                        }
                                        if($results['type'] == 'villa')
                                        { 
                                    ?>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Chambres
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['chambres'] ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Surface du jardin
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['surface_jardin'] ?> m²
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Surface du villa
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?= $results['surface_villa'] ?> m²
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <div class="col-4" style=";font-size: 1.5em;color:grey;display:flex;align-items:center">
                                        Piscine
                                    </div>
                                    <div class="col-2-4" style=";font-size: 1.3em;">
                                        <?php if($results['piscine']){echo '<span style="color:green;font-size:40px">&#9745;</span>';}else{echo '<span style="color:red;font-size:40px">&#9746;</span>';} ?>
                                    </div>
                                    <div style="border:1px solid silver;width:100%"></div>
                                    <?php 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1" style="padding:50px 0">
                    </div>
                </div>  
            </div>
    <?php
        }  
    ?>
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
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slides[slideIndex-1].style.display = "block";  

        }
    </script>
</body>
</html>