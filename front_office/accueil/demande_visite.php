<?php include_once '../../libs/alert.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Demande visite | IMMO-MAROC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style1.css">
    <link href="../../css/materialsicons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../css/font-awesome/css/all.css">
    <script src="../../js/ajax.js"></script>
    <style>
        .icon{
            width:80px;height:80px;position:relative;top:40px;left:20px;background:linear-gradient(60deg, #4940ec, #d81b60);border-radius:50%;color:white;font-size:40px;line-height:80px;text-align:center;box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgba(60, 52, 201, 0.4);
        }
        a{
            text-decoration:underline
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            border:unset;
        }
        /* Zebra striping */
        tr:nth-of-type(odd) { 
            background: lightgrey; 
        }
        th { 
            background: #333; 
            color: white; 
            font-weight: bold; 
        }
        td, th { 
            padding: 6px; 
            border-bottom: 1px solid #ccc; 
            text-align: left; 
        }
        @media
            only screen 
            and (max-width: 760px), (min-device-width: 768px) 
            and (max-device-width: 1024px)  {
                table, thead, tbody, th, td, tr {
                    display: block;
                }
                thead tr {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }
                tr:nth-child(odd) {
                    background: #ccc;
                }
                td {
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50%;
                }
                td:before {
                    position: absolute;
                    top: 50%;
                    left:10px;
                    transform: translateY(-50%);
                    width: 30%;
                    white-space: nowrap;
                }
                td:nth-of-type(1):before { content: "Annonce"; }
                td:nth-of-type(2):before { content: "Date demande"; }
                td:nth-of-type(3):before { content: "Demander par"; }
                td:nth-of-type(4):before { content: "Status"; }
            }
    </style>
</head>
<body>
<div class="nav" id="nav"></div>
    <div class="container" style="flex-wrap: wrap;">
        <div class="container col-2-4" style="flex-wrap: wrap;">
            <div class="col-1">
                <div class='icon'>
                    <i class="fa fa-search"></i>
                </div>
                <div class="container contents">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-1">
                        <form action="demande_visite.php" method="post" enctype="multipart/form-data">
                            <div class="container">
                                <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                    Nom
                                </div>
                                <div class="col-2-4">
                                    <input type="text" class="input" name="nom" placeholder="Nom" required>
                                </div>
                                <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                    Prenom
                                </div>
                                <div class="col-2-4">
                                    <input type="text" class="input" name="prenom" placeholder="Prenom" required>
                                </div>
                                <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                    Telephone
                                </div>
                                <div class="col-2-4">
                                    <input type="text" class="input" name="tele" placeholder="Telephone" required>
                                </div>
                                <div class="col-4" style="font-size: 1.5em;color:grey;display:flex;align-items:center">
                                    Email
                                </div>
                                <div class="col-2-4">
                                    <input type="email" class="input" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-1">
                                    <input type="submit" value="RECHERCHER" name="recherche" class="button" style="background:#337ab7;width:100%">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                include_once("../../libs/connexion.php");
                $query = 0;
                $test = 1;
                if(isset($_POST['recherche']))
                {
                    $query = 'SELECT * FROM demande_visite WHERE nom = :nom AND prenom = :prenom AND email = :email AND tele = :tele ORDER BY id DESC  ';
                    $param = array(
                        ':nom' => $_POST['nom'],
                        ':prenom' => $_POST['prenom'],
                        ':email' => $_POST['email'],
                        ':tele' => $_POST['tele']
                    );
                    $stmt = $bdd->prepare($query);
                    $stmt->execute($param);
                    if($stmt->rowCount() == 0)
                    {
                        echo '
                            <div class="col-2">
                                <div class="col-1 contents" style="text-align:center;font-size:2em">
                                    Aucune resultat trouvé.
                                </div>
                            </div>
                        ';
                    }
                    else
                    {	
            ?>
                        <div class="col-1">                        
                            <div class="col-1 contents" style="padding:0">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Annonce</th>
                                            <th>Date demande</th>
                                            <th>Demander en</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php	
                                            while($row = $stmt->fetch())
                                            {
                                                if($row['status'] == 'En attend'){ echo '<tr style="background:#ffa100">'; }
                                                if($row['status'] == 'Accepter'){ echo '<tr style="background:#47ca4c">'; }
                                                if($row['status'] == 'Rejecter'){ echo '<tr style="background:#ff0024">'; }
                                        ?> 
                                                <td>
                                                    <?php	
                                                        $query1 = 'SELECT * FROM propriete WHERE id='.$row['id_propriete'].' LIMIT 1';
                                                        $stmt1 = $bdd->prepare($query1);
                                                        $stmt1->execute();
                                                        $row1 = $stmt1->fetch();
                                                        extract($row1);
                                                    ?> 
                                                    <a href="../../front_office/accueil/details_propriete.php?id=<?= $row['id_propriete'] ?>" target="_blank" ><?= $title ?></a>
                                                </td>
                                                <td><?= $row['temp'] ?></td>
                                                <td><?= $row['created_at'] ?></td>
                                                <td><?= $row['status'] ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>  
                        </div>
            <?php	
                    }
                }
            ?>
        </div>
    </div>
    <script>
        $(function(){
            $("#nav").load("../../front_office/menu.html"); 
        });
    </script>
</body>
</html>