<?php include_once '../../libs/alert.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Utilisateurs | IMMO-MAROC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style2.css">
    <link href="../../css/materialsicons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../css/font-awesome/css/all.css">
    <script src="../../js/ajax.js"></script>
    <style>
         .icon{
            width:80px;height:80px;position:relative;top:40px;left:30px;background:linear-gradient(60deg, #4940ec, #d81b60);border-radius:50%;color:white;font-size:40px;line-height:80px;text-align:center;box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgba(60, 52, 201, 0.4);
        }
    </style>
</head>
<body>     
    <div class="container" style="flex-wrap: wrap;">
        <div class="col-5" id="nav" style="padding:0">
        </div>
        <div class="container col-2-5" style="justify-content:left">
            <div class="col-1" style="padding:50px 0">
                <div class="container">
                    <span style="font-size:40px">Utilisateurs</span>    
                </div>
            </div>
            <div class='icon'>
                <i class="fa fa-search"></i>
            </div>
            <div class="col-1">
                <div class="container contents">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-1">
                        <form action="index.php" method="post" enctype="multipart/form-data">
                            <div class="container">
                                <div class="col-2-4">
                                    <input type="text" style="" class="input" name="search" placeholder="Pseudo ou Email">
                                </div>
                                <div class="col-4">
                                    <input type="submit" value="RECHERCHER" name="recherche" class="button" style="background:#337ab7;width:100%">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                include_once("../../libs/connexion.php");
                $query = 'SELECT * FROM users WHERE admin=0';
                if(isset($_POST['search']))
                {
                    $query .= ' AND username LIKE "%'.$_POST['search'].'%" AND email LIKE "%'.$_POST['search'].'%" ';
                    $test = 0;
                }
                $stmt = $bdd->prepare($query);
                $stmt->execute();
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
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                { 
            ?>			
                    <div class="col-3 items">
                        <div class="container contents">
                            <div id="ss" class="container contents col-1" style="padding:0;position:relative;height:120px">
                                <div class="col-1" style="font-size:1.5em;padding:5px 10px">
                                    <?= $row['username'] ?>
                                </div>
                                <div class="col-1" style="font-size:1.5em;padding:5px 10px">
                                    <?= $row['email'] ?>
                                </div>
                                <div class="col-1" style="font-size:1.5em;padding:5px 10px">
                                    <?= $row['created_at'] ?>
                                </div>
                            </div>
                        </div>
                        <div style="height:0">
                            <div id="action" class="container" style="width:100%;display:none;position:relative;top:-36px">
                                <a style="color:#f5d142;" class="btnlink1" href="modifier_utilisateur.php?id=<?= $row['id'] ?>" title="Modifier"><i class="fa fa-pen"></i></a> 
                                <a style="color:tomato;" class="btnlink1" href="supprimer_utilisateur_code.php?id=<?= $row['id'] ?>" title="Supprimer"><i class="fa fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
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
        $(".items").hover(function () {
            $(this).find("#ss").animate({top : '-37px'},'fast');
            $(this).find("#ss").css({cursor : "pointer",border : ".5px solid black"});
            $(this).find("#action").fadeIn();
        }, function () {
            $(this).find("#ss").animate({top : '0'},'fast');
            $(this).find("#ss").css({border : "unset"});
            $(this).find("#action").hide();
        });
        $("#ok").on("click",function(){
            $("#error").hide();
        });
        
        $(document).ready(function(){
            $("#error").fadeIn(1000).delay(10000).fadeOut(1000);
        });
	</script>
</body>
</html>