<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Accueil | IMMO-MAROC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style1.css">
    <link href="../../css/materialsicons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../css/font-awesome/css/all.css">
    <script src="../../js/ajax.js"></script>
    <style>
        .icon{
            width:80px;height:80px;position:relative;top:40px;left:20px;background:linear-gradient(60deg, #4940ec, #d81b60);border-radius:50%;color:white;font-size:40px;line-height:80px;text-align:center;box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgba(60, 52, 201, 0.4);
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
                        <form action="index.php" method="post" enctype="multipart/form-data">
                            <div class="container">
                                <div class="col-3-5">
                                    <select name="ville" class="select" id="ville" style='margin:0'>
                                        <option disabled selected>Ville</option>
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
                                <div class="col-5">
                                    <label class="lbl"><input type="checkbox" name="location">
                                        <span style="width:100%;">
                                            location
                                        </span>
                                    </label>
                                </div>
                                <div class="col-5">
                                    <label class="lbl"><input type="checkbox" name="vente">
                                        <span style="width:100%;">
                                            vente
                                        </span>
                                    </label>
                                </div>
                                <div class="col-5"  >
                                    <label class="lbl"><input type="checkbox" name="appartement">
                                        <span style="width:100%;">
                                            appartement
                                        </span>
                                    </label>
                                </div>
                                <div class="col-5"  >
                                    <label class="lbl"><input type="checkbox" name="commerce">
                                        <span style="width:100%;">
                                            commerce
                                        </span>
                                    </label>
                                </div>
                                <div class="col-5"  >
                                    <label class="lbl"><input type="checkbox" name="immeuble">
                                        <span style="width:100%;">
                                            immeuble
                                        </span>
                                    </label>
                                </div>
                                <div class="col-5"  >
                                    <label class="lbl"><input type="checkbox" name="terrain">
                                        <span style="width:100%;">
                                            terrain
                                        </span>
                                    </label>
                                </div>
                                <div class="col-5"  >
                                    <label class="lbl"><input type="checkbox" name="villa">
                                        <span style="width:100%;">
                                            villa
                                        </span>
                                    </label>
                                </div>
                                <div class="col-2">
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
                    $query = 'SELECT * FROM propriete WHERE 1 ';
                    if(isset($_POST['ville']))
                    {
                        $query .= ' AND ville = "'.$_POST['ville'].'"';
                        $test = 0;
                    }
                    if(isset($_POST['location']) && isset($_POST['vente']))
                    {
                        $test = 0;
                    }
                    else
                    {
                        if(isset($_POST['location']))
                        {
                            $query .= ' AND est_location = 1';
                            $test = 0;
                        }
                        if(isset($_POST['vente']))
                        {
                            $query .= ' AND est_location = 0';
                            $test = 0;
                        }
                    }
                    if(!isset($_POST['appartement']) && !isset($_POST['immeuble']) && !isset($_POST['commerce']) && !isset($_POST['terrain']) && !isset($_POST['villa']))
                    {
                        $test = 0;
                    }
                    else
                    {
                        if(!isset($_POST['appartement']))
                        {
                            $query .= ' AND type <> "appartement"';
                            $test = 0;
                        }
                        if(!isset($_POST['commerce']))
                        {
                            $query .= ' AND type <> "commerce"';
                            $test = 0;
                        }
                        if(!isset($_POST['immeuble']))
                        {
                            $query .= ' AND type <> "immeuble"';
                            $test = 0;
                        }
                        if(!isset($_POST['terrain']))
                        {
                            $query .= ' AND type <> "terrain"';
                            $test = 0;
                        }
                        if(!isset($_POST['villa']))
                        {
                            $query .= ' AND type <> "villa"';
                            $test = 0;
                        }
                        if($test == 1 && !isset($_POST['ville']))
                        {
                            $query = 'SELECT * FROM propriete';
                        }
                    }
                }
                else
                {
                    $query = 'SELECT * FROM propriete';
                }
                $query .= ' ORDER BY id DESC ';
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
                while($row = $stmt->fetch()) 
                { 		
                    $query1 = 'SELECT * FROM image WHERE id_propriete=:id LIMIT 1';
                    $params = array(
                        ':id' => $row['id']
                    );
                    $stmt1 = $bdd->prepare($query1);
                    $stmt1->execute($params);
                    $row1 = $stmt1->fetch();
                    if($stmt1->rowCount() != 0)
                    {
                        extract($row1);
                    }
                    else
                    {
                        $image_path = 'vide.jpg';
                    }
            ?>
                    <div class="col-3">
                        <a href="details_propriete.php?id=<?= $row['id'] ?>">
                            <div class="col-1 contents" style="padding:0">
                                <div class="col-1" style="padding-bottom:0">
                                    <div class="container" style='background:black;height:250px'>
                                        <img src='../../img/<?= $image_path ?>' style='width:auto;height:auto;max-width:100%;max-height:100%;'>
                                    </div>
                                </div>
                                <div class="container col-1">
                                    <div class="col-1" style="padding:0;font-size:1.5em;color:blue;">
                                        <input type="text" value="<?= $row['title'] ?>" style="all:unset;width:100%" readonly>
                                    </div>
                                    <div class="col-1" style="padding:10px 0;font-size:19px">
                                        <input type="text" value="<?= $row['adresse'] ?> <?= $row['ville'] ?>" style="all:unset;width:100%" readonly>
                                    </div>
                                    <div class="" style="flex:1;padding:0;font-size:20px;color:grey;"><?= $row['type'] ?></div>
                                    <div class="" style="width:auto;padding:0;font-size:20px;color:tomato;">
                                        <b><?= $row['prix'] ?></b><span style="font-size:0.8em"> DH
                                        <?php 
                                            if($row['est_location'] == 1)
                                            {
                                                echo '/ Mois</span>';
                                            }
                                        ?>
                                    </div>     
                                    <div class="col-1" style="padding:0;padding-top:10px;font-size:20px;color:silver;">
                                        <i class="fa fa-clock"></i> <?= $row['created_at'] ?>
                                    </div>                       
                                </div> 
                            </div>
                        </a>
                    </div>
            <?php	
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