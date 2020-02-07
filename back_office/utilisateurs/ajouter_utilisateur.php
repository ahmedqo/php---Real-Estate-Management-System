<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nouveau utilisateur | IMMO-MAROC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style2.css">
    <link href="../../css/materialsicons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../css/font-awesome/css/all.css">
    <script src="../../js/ajax.js"></script>
</head>
<body>     
    <div class="container">
        <div class="col-5" id="nav" style="padding:0">
        </div>
        <div class="container col-2-5">
            <div class="col-1" style="padding:50px 0">
                <div class="container">
                    <span style="font-size:40px">Nouveau utilisateur</span>    
                </div>
            </div>
            <div class="col-1">
                <div class="container contents">
                    <div class="col-1">
                        <form method="post" enctype="multipart/form-data" action="ajouter_utilisateur_code.php">	
                            <div class="container">
                                <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey">
                                    Pseudo
                                </div>
                                <div class="col-2-4">
                                    <input class="input" type="text" name="pseudo" id="pseudo"  placeholder="Pseudo" required />
                                </div>
                                <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey">
                                    Mot de passe
                                </div>
                                <div class="col-2-4">
                                    <input class="input" type="password" name="pass" id="pass" placeholder="Mot de passe" required />
                                </div>
                                <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey">
                                    Email
                                </div>
                                <div class="col-2-4">
                                    <input class="input" type="email" name="email" id="email" placeholder="Email" required />
                                </div>
                                <div class="col-4" style="font-size: 1.5em;display:flex;align-items:center;color:grey">
                                    Admin
                                </div>
                                <div class="col-2-4">
                                    <label class="lbl"><input type='radio' name='admin' value="0" checked>
                                        <span style="border-right: 1px solid black;width:50%;">
                                            Non
                                        </span>
                                    </label>                       
                                    <label class="lbl"><input type='radio' name='admin' value="1" >
                                        <span style="border-left: 1px solid black;width:50%;">
                                            Oui
                                        </span>
                                    </label>
                                </div>
                                <div class="col-1">
                                    <input type="submit" value="Ajouter" class="button" style="background:#337ab7;width:100%">
                                </div>
                            </div>
                        </form>
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
	</script>
</body>
</html>