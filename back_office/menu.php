<?php 
    session_start();
    if($_SESSION['admin'])
    { 
        echo '
            <script>
                $(function(){
                    $(".usernav").show();
                });
            </script>
        ';
    } 
?>
<div style="display:flex;background:#252525;">
		<div class="headmenu" style="width:calc(100% - 50px)">
		STOCK-MAROC
		</div>
		<a class="button btn" id="open">
			<i class="fas fa-th"></i>
		</a>
	</div>
	<div class="nav-wrapper" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('../../img/sidebar-4.jpg');">
		<div class="headmenu">
		STOCK-MAROC
		</div>
		<div style="border:2px solid white;margin-bottom:10px;"></div>
		<div class="cont usernav" style="display:none">
			<a href="../../back_office/utilisateurs/" id="l1">
				<div style="width:100%;display:flex;">
					<i class="fas fa-users" style="font-size:30px"></i>
					<span style="line-height:30px;padding:0 10px">Les utilisateurs</span>	
				</div>
			</a>
		</div>
		<div class="cont usernav" style="display:none">
			<a href="../../back_office/utilisateurs/ajouter_utilisateur.php" id="l2">
				<div style="width:100%;display:flex;">
					<i class="fas fa-user-plus" style="font-size:30px"></i>
					<span style="line-height:30px;padding:0 10px">Nouveau utilisateur</span>
				</div>
			</a>
		</div>
		<div class="cont">
			<a href="../../back_office/accueil/" id="l3">
				<div style="width:100%;display:flex;">
					<i class="fas fa-university" style="font-size:30px"></i>
					<span style="line-height:30px;padding:0 10px">Les immobilier</span>
				</div>
			</a>
		</div>	
		<div class="cont">
			<a href="../../back_office/accueil/ajouter_propriete.php">
				<div style="width:100%;display:flex;">
					<i class="fas fa-plus-square" style="font-size:30px;"></i>	
					<span style="line-height:30px;padding:0 10px">Nouveau immobilier</span>
				</div>
			</a>
		</div>	
		<div class="cont">
			<a href="../../back_office/demande_visite/">
				<div style="width:100%;display:flex;">
						<i class="fas fa-file-signature" style="font-size:30px;"></i>
					<span style="line-height:30px;padding:0 10px">Gestion demandes</span>
				</div>
			</a>
		</div>
		<div class="cont">
			<a href="../../libs/logout.php">
				<div style="width:100%;display:flex;">
					<div style="width:100%;display:flex;">
						<i class="fas fa-sign-out-alt" style="font-size:30px"></i>
						<span style="line-height:30px;padding:0 10px">Deconnexion</span>
					</div>
				</div>
			</a>
		</div>	
    </div>
<script>
	$('#open').on("click",function(){
		$('#close').show();
		$(".nav-wrapper").animate({
			width : 'toggle'
		})
	})
</script>
