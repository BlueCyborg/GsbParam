<div id="bandeau">
	<!-- Images En-tête -->
	<img src="images/logo.jpg" alt="GsbLogo" title="GsbLogo" />
</div>
<!--  Menu haut-->
<ul id="menu">
	<li><a href="index.php?uc=accueil"> Accueil </a></li>
	<?php if (isset($_SESSION['administrateur'])) { ?>
		<li><a href="index.php?uc=administrer&action=voirCategories"> Produits par catégorie </a></li>
	<?php } else { ?>
		<li><a href="index.php?uc=voirProduits&action=voirCategories"> Nos produits par catégorie </a></li>
	<?php } ?>
	<?php if (isset($_SESSION['administrateur'])) { ?>
		<li><a href="index.php?uc=administrer&action=nosProduits"> Les produits </a></li>
		<li><a href="index.php?uc=administrer&action=creerProduit"> Creer un produit </a></li>
	<?php } else { ?>
		<li><a href="index.php?uc=voirProduits&action=nosProduits"> Nos produits </a></li>
	<?php } ?>
	<?php if (!isset($_SESSION['administrateur'])) { ?>
		<li><a href="index.php?uc=gererPanier&action=voirPanier"> Voir son panier </a></li>
	<?php } ?>
	<?php
	if (isset($_SESSION['user'])) { ?>
		<li><a href="index.php?uc=connexion&action=deconnexion"> Déconnexion </a></li>
	<?php } else if (isset($_SESSION['administrateur'])) { ?>
		<li><a href="index.php?uc=administrer&action=deconnexion"> Déconnexion </a></li>
	<?php } else { ?>
		<li><a href="index.php?uc=connexion&action=connexion"> Connexion </a></li>
	<?php } ?>
</ul>