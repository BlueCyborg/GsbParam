<div id="bandeau">
	<!-- Images En-tête -->
	<img src="images/logo.jpg" alt="GsbLogo" title="GsbLogo" />
</div>
<!--  Menu haut-->
<ul id="menu">
	<li><a href="index.php?uc=accueil"> Accueil </a></li>
	<li><a href="index.php?uc=voirProduits&action=voirCategories"> Nos produits par catégorie </a></li>
	<li><a href="index.php?uc=voirProduits&action=nosProduits"> Nos produits </a></li>
	<li><a href="index.php?uc=gererPanier&action=voirPanier"> Voir son panier </a></li>
	<?php
	if (isset($_SESSION['user'])) { ?>
		<li><a href="index.php?uc=connexion&action=deconnexion"> Déconnexion </a></li>
	<?php } else { ?>
		<li><a href="index.php?uc=connexion&action=connexion"> Connexion </a></li>
	<?php } ?>
</ul>