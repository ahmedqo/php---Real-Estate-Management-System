<?php include_once '../../libs/alert.php'; ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Connexion | IMMO-MAROC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style2.css">
    <link href="../../css/materialsicons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../css/font-awesome/css/all.css">
    <script src="../../js/ajax.js"></script>
    <style>
        .icon{
            width:80px;height:80px;position:relative;top:30px;left:20px;background:linear-gradient(60deg, #4940ec, #d81b60);border-radius:50%;color:white;font-size:40px;padding-top:20px;text-align:center;box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgba(60, 52, 201, 0.4);
        }
    </style>
</head>
<body style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('../../img/index.jpg');background-repeat: no-repeat;background-size: cover;background-position:center">
    <div class="container" style="align-items:center;justify-content:center;height:100%">
        <div class="col-3">
            <div class="icon">
                <i class="fa fa-fingerprint"></i>
            </div>
            <div class="container contents">
                <div class="col-1"></div>
                <div class="col-1"></div>
                <div class="col-1">
                    <form method="post" action="login.php">
                        <div class="container">	
                            <div class="col-1" style="display:flex">
                                <div style="width:14%;background:black;color:white;font-size:30px;text-align:center;padding-top:5px;float:left">
                                    <i class="fa fa-user-circle"></i>
                                </div>	
                                <div style="width:86%">
                                    <input class="input" type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required />
                                </div>
                            </div>
                            <div class="col-1" style="display:flex">
                                <div style="width:14%;background:black;color:white;font-size:30px;text-align:center;padding-top:5px;float:left">
                                    <i class="fa fa-key"></i>
                                </div>
                                <div style="width:86%">
                                    <input class="input" type="password" name="pass" id="pass" placeholder="Mot de passe" required />
                                </div>
                            </div>
                            
                            <div class="col-1">
                                <input class="button" type="submit" name="connexion" value="Connexion"  style="color:#201fb7;width:100%;outline:none;border:none;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
         $(document).ready(function(){
			$.ajax({
				type:'POST',
				url:'../../libs/check.php',
				success: function(data){
					if(data == 1)
                    {
                        window.location.href = "../../back_office/accueil/";   
                    }
				}
			});
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