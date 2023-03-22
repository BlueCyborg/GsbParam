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

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">

	<img class="navbar-brand" src="images/gsb_logo.png" alt="GsbLogo" title="GsbLogo" width="100px" />

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="index.php?uc=accueil">Accueil<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?uc=voirProduits&action=voirCategories">Nos produits par catégorie</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?uc=voirProduits&action=nosProduits">Nos produits</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?uc=gererPanier&action=voirPanier">Voir son panier</a>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="window.location='index.php?uc=connexion&action=connexion'">Connexion</button>
			<button class="btn btn-success my-2 my-sm-0" type="button" onclick="window.location='index.php?uc=connexion&action=inscription'">Inscription</button>
		</form>
	</div>
</nav>
<?php var_dump($_SESSION); ?>