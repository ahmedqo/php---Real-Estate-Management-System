<?php include_once '../../libs/alert.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion demandes | IMMO-MAROC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style2.css">
    <link href="../../css/materialsicons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../css/font-awesome/css/all.css">
    <script src="../../js/ajax.js"></script>
    <style>
        a{
            text-decoration:underline
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
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
            border: 1px solid #ccc; 
            text-align: left; 
        }
        .spn2{
            display:none;
        }
        td:first-of-type{
            width:40%
        }
        td:last-of-type{
            width:30%
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
                td:first-of-type{
                    width:auto
                }
                td {
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 40%;
                }
                td:before {
                    position: absolute;
                    top: 50%;
                    left: 6px;
                    transform: translateY(-50%);
                    width: 30%;
                    white-space: nowrap;
                }
                td:last-of-type{
                    padding-left:0;
                    width:100%;
                    height:60px;
                    padding-left:6px;
                }
                td:nth-of-type(1):before { content: "Annonce"; }
                td:nth-of-type(2):before { content: "Date demande"; }
                td:nth-of-type(3):before { content: "Demander par"; }
            }
    </style>
</head>
<body>     
    <div class="container" style="flex-wrap: wrap;">
        <div class="col-5" id="nav" style="padding:0">
        </div>
        <div class="container col-2-5" style="flex-wrap: wrap;">
            <div class="col-1" style="padding:50px 0">
                <div class="container">
                    <span style="font-size:40px">Demandes visite</span>    
                </div>
            </div>
           
            <div class="col-1">                        
                <div class="container contents">       
                    <div class="col-1">
                        <label class="lbl" id="show" title="link1"><input type="radio" name="type" value="terrain" checked>
                            <span class="spn">
                                <i class="fas fa-clock" style="font-size:80px"></i><br>demande<br>en attend
                            </span>
                        </label>   
                        <label class="lbl" id="show" title="link2"><input type="radio" name="type" value="commerce">
                            <span class="spn">
                                <i class="fas fa-check-circle" style="font-size:80px"></i><br>demande<br>accepter
                            </span>
                        </label>
                        <label class="lbl"  id="show" title="link3"><input type="radio" name="type" value="appartement" >
                            <span class="spn">
                                <i class="fas fa-ban" style="font-size:80px"></i><br>demande<br>rejecter
                            </span>
                        </label>
                        <label class="lbl"  id="show" title="link4"><input type="radio" name="type" value="appartement" >
                            <span class="spn">
                                <i class="fas fa-times-circle" style="font-size:80px"></i><br>demande<br>expirer
                            </span>
                        </label>
                    </div>                                
                    <div id="link1" class="col-1">
                        <caption>
                            <input type="text" class="input" id="input1" placeholder="Rechercher">
                        </caption>
                        <div class="col-1"></div>
                        <?php	
                            include_once("../../libs/connexion.php");
                            $query = "SELECT * FROM demande_visite WHERE status = 'En attend' AND temp >= CURDATE() ";
                            $stmt=$bdd->prepare($query);
                            $stmt->execute();
                            $now = date('Y-m-d');
                            if($stmt->rowCount() == 0 )
                            {
                                echo '<div class="col-1" style="font-size:25px;text-align:center">
                                        Aucun resultat trouvé.
                                    </div>';
                            }
                            else
                            {
                        ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Annonce</th>
                                        <th>Date demande</th>
                                        <th>Demander par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table1">
                                    <?php
                                        while($row = $stmt->fetch())
                                        {
                                    ?> 
                                            <tr>
                                                <td>
                                                    <?php	
                                                        $query1 = 'SELECT * FROM propriete WHERE id='.$row['id_propriete'].' LIMIT 1';
                                                        $stmt1 = $bdd->prepare($query1);
                                                        $stmt1->execute();
                                                        $row1 = $stmt1->fetch();
                                                        extract($row1);
                                                    ?> 
                                                    <a href="../../back_office/accueil/voir_propriete.php?id=<?= $row['id_propriete'] ?>" target="_blank" ><?= $title ?></a>
                                                </td>
                                                <td><?= $row['temp'] ?></td>
                                                <td><?= $row['nom'] ?> <?= $row['prenom'] ?></td>
                                                <td>
                                                    <a style="background:#dc3545;" class="btnlink" href="demande_visite_code.php?id=<?= $row['id'] ?>&status=Rejecter"><i class="fas fa-ban"></i> Rejecter</a>
                                                    <a style="background:#218838;" class="btnlink" href="demande_visite_code.php?id=<?= $row['id'] ?>&status=Accepter"><i class="fas fa-check-circle"></i> Accepter</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                            }
                        ?>
                    </div>
                    <div id="link2" class="col-1"  style="display:none">
                        <caption>
                            <input type="text" class="input" id="input2" placeholder="Rechercher">
                        </caption>
                        <div class="col-1"></div>
                        <?php	
                            include_once("../../libs/connexion.php");
                            $query = "SELECT * FROM demande_visite WHERE status = 'Accepter' AND temp >= CURDATE() ";
                            $stmt=$bdd->prepare($query);
                            $stmt->execute();
                            $now = date('Y-m-d');
                            if($stmt->rowCount() == 0 )
                            {
                                echo '<div class="col-1" style="font-size:25px;text-align:center">
                                        Aucun resultat trouvé.
                                    </div>';
                            }
                            else
                            {
                        ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Annonce</th>
                                        <th>Date demande</th>
                                        <th>Demander par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table2">
                                    <?php
                                        while($row = $stmt->fetch())
                                        {
                                    ?> 
                                            <tr>
                                                <td>
                                                    <?php	
                                                        $query1 = 'SELECT * FROM propriete WHERE id='.$row['id_propriete'].' LIMIT 1';
                                                        $stmt1 = $bdd->prepare($query1);
                                                        $stmt1->execute();
                                                        $row1 = $stmt1->fetch();
                                                        extract($row1);
                                                    ?> 
                                                    <a href="../../back_office/accueil/voir_propriete.php?id=<?= $row['id_propriete'] ?>" target="_blank" ><?= $title ?></a>
                                                </td>
                                                <td><?= $row['temp'] ?></td>
                                                <td><?= $row['nom'] ?> <?= $row['prenom'] ?></td>
                                                <td> 
                                                    <a style="background:#6c757d;" class="btnlink" href="demande_visite_code.php?id=<?= $row['id'] ?>&status=En attend"><i class="fas fa-clock"></i> Suspendre</a>
                                                    <a style="background:#dc3545;" class="btnlink" href="demande_visite_code.php?id=<?= $row['id'] ?>&status=Rejecter"><i class="fas fa-ban"></i> Rejecter</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                            }
                        ?>
                    </div>  
                    <div id="link3" class="col-1"  style="display:none">
                        <caption>
                            <input type="text" class="input" id="input3" placeholder="Rechercher">
                        </caption>
                        <div class="col-1"></div>
                        <?php	
                            include_once("../../libs/connexion.php");
                            $query = "SELECT * FROM demande_visite WHERE status = 'Rejecter' AND temp >= CURDATE() ";
                            $stmt=$bdd->prepare($query);
                            $stmt->execute();
                            $now = date('Y-m-d');
                            if($stmt->rowCount() == 0 )
                            {
                                echo '<div class="col-1" style="font-size:25px;text-align:center">
                                        Aucun resultat trouvé.
                                    </div>';
                            }
                            else
                            {
                        ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Annonce</th>
                                        <th>Date demande</th>
                                        <th>Demander par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table3">
                                    <?php	

                                        while($row = $stmt->fetch())
                                        {
                                    ?> 
                                            <tr>
                                                <td>
                                                    <?php	
                                                        $query1 = 'SELECT * FROM propriete WHERE id='.$row['id_propriete'].' LIMIT 1';
                                                        $stmt1 = $bdd->prepare($query1);
                                                        $stmt1->execute();
                                                        $row1 = $stmt1->fetch();
                                                        extract($row1);
                                                    ?> 
                                                    <a href="../../back_office/accueil/voir_propriete.php?id=<?= $row['id_propriete'] ?>" target="_blank" ><?= $title ?></a>
                                                </td>
                                                <td><?= $row['temp'] ?></td>
                                                <td><?= $row['nom'] ?> <?= $row['prenom'] ?></td>
                                                <td>
                                                    <a style="background:#6c757d;" class="btnlink" href="demande_visite_code.php?id=<?= $row['id'] ?>&status=En attend"><i class="fas fa-clock"></i> Suspendre</a>
                                                    <a style="background:#218838;" class="btnlink" href="demande_visite_code.php?id=<?= $row['id'] ?>&status=Accepter"><i class="fas fa-check-circle"></i> Accepter</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                            }
                        ?>
                    </div>
                    <div id="link4" class="col-1" style="display:none">
                        <caption>
                            <input type="text" class="input" id="input4" placeholder="Rechercher">
                        </caption>
                        <div class="col-1"></div>
                        <?php	
                            include_once("../../libs/connexion.php");
                            $query = "SELECT * FROM demande_visite WHERE temp < CURDATE() ";
                            $stmt=$bdd->prepare($query);
                            $stmt->execute();
                            $now = date('Y-m-d');
                            if($stmt->rowCount() == 0 )
                            {
                                echo '<div class="col-1" style="font-size:25px;text-align:center">
                                        Aucun resultat trouvé.
                                    </div>';
                            }
                            else
                            {
                        ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Annonce</th>
                                        <th>Date demande</th>
                                        <th>Demander par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table4">
                                    <?php	
                                        while($row = $stmt->fetch())
                                        {
                                    ?> 
                                            <tr>
                                                <td>
                                                    <?php	
                                                        $query1 = 'SELECT * FROM propriete WHERE id='.$row['id_propriete'].' LIMIT 1';
                                                        $stmt1 = $bdd->prepare($query1);
                                                        $stmt1->execute();
                                                        $row1 = $stmt1->fetch();
                                                        extract($row1);
                                                    ?> 
                                                    <a href="../../back_office/accueil/voir_propriete.php?id=<?= $row['id_propriete'] ?>" target="_blank" ><?= $title ?></a>
                                                </td>
                                                <td><?= $row['temp'] ?></td>
                                                <td><?= $row['nom'] ?> <?= $row['prenom'] ?></td>
                                                <td>
                                                    <?= $row['status'] ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                            }
                        ?>
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
        $(document).on('click','#show',function(){
			var div = $(this).attr('title');
            for(var i=1; i <= 5; i++)
            {
                $('#link'+i).hide();
            }
            $('#'+div).show();
        });
        $("#ok").on("click",function(){
            $("#error").hide();
        });
        $(document).ready(function(){
            $("#input1").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table1 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        $(document).ready(function(){
            $("#input2").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table2 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        $(document).ready(function(){
            $("#input3").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table3 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        $(document).ready(function(){
            $("#input4").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table4 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        $(document).ready(function(){
            $("#error").fadeIn(1000).delay(10000).fadeOut(1000);
        });
	</script>
</body>
</html>