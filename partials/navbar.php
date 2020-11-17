<?php

    if(isset($_SESSION["user"]))
    {
        $session = intval($_SESSION["user"]["accreditation"]);
    }
    
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>ACTU JEU</title>
</head>
<body>
    <!-- Navbar content -->
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand">logo</a>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Recherche..." method="GET" aria-label="Search"  name="q" autofocus>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <ul id="bloc">
        </form>
        <?php if(isset($_SESSION["user"])) : ?>
                <li><a href="profilUser.php"><?= ucfirst(setPseudoForUser()) ?></a></li>
                <form action="../user/logout.php" >
                    <button type="submit">Se déconnecter</button>
                </form>
        <?php endif ?>

        <?php if(!isset($_SESSION["user"])) : ?>
            <li><a href="/vue/user/connexion.php"> se connecter /</a></li>
            <li><a href="/vue/user/inscription.php"> s'inscrire</a></li>
        <?php endif ?>
            
        </ul>
    </nav>
    <nav class="menu">
        <div>
            <ul>
                <?php if(isset($session) && $session === 200) : ?>
                    <li><a href="games.php">Jeux vidéo</a></li>
                    <li><a href="">Accéssoires</a></li>
                    <li><a href="">Coup de (coeur)</a></li>
                    <li><a href="addProduct.php">Ajouter un produit</a></li>
                    <li><a href="inscriptionContributorByAdmin.php">Ajouter contributeur</a></li>
                    <li><a href="displayUsers.php">Afficher tout les users</a></li>
                <?php endif ?>

                <?php if(isset($session) && $session === 100) : ?>
                    <li><a href="games.php">Jeux vidéo</a></li>
                    <li><a href="">Accéssoires</a></li>
                    <li><a href="">Coup de (coeur)</a></li>
                    <li><a href="addProduct.php">Ajouter un produit</a></li>
                <?php endif ?>

                <?php if(isset($session) && $session === 1 || !isset($_SESSION["user"]))  : ?>
                    <li><a href="games.php">Jeux vidéo</a></li>
                    <li><a href="">Accéssoires</a></li>
                    <li><a href="">Coup de (coeur)</a></li>
                <?php endif ?>
            
            </ul>
        </div>
    </nav>