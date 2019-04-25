<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title ?></title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <!-- Custom fonts for this template -->

  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:700|Raleway:300,500,600,800" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="public/css/style.css" rel="stylesheet">

</head>

<body <?= ($title == "Home") ? 'style="height: 100vh"' : ''?>>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container-fluid">
      <a class="navbar-brand" href=".">Ampuero Pierre</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarResponsive">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href=".">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=listPost">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=contact">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=admin">Administration</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <?php if (!isset($user)): ?>
          <li class="nav-item">
            <a class="nav-link" href="?action=connexion">Connexion</a>
          </li>
          <li class="nav-item">
            <a href="?action=createUser">Créer un compte</a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <span class="nav-info"><?= $user->mail() ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-deco" href="?action=destroy">Déconnexion</a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>