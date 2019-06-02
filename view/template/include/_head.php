<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?= dirname(getenv('SCRIPT_NAME')) ?>/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Blog OpenClassroom">
  <meta name="author" content="Ampuero Pierre">

  <title><?= $title ?></title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <!-- Custom fonts for this template -->

  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:700|Raleway:300,500,600,800,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="public/css/style.css" rel="stylesheet">

</head>

<body>

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
            <a class="nav-link" href="posts">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact">Contact</a>
          </li>
          <?php if (isset($userSession) && $userSession->getRolesId() != 3): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administration</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="admin/posts">Liste des Postes</a>
              <a class="dropdown-item" href="admin/comments">Liste des Commentaires</a>
              <?php if (isset($userSession) && $userSession->getRolesId() == 1): ?>
              <a class="dropdown-item" href="admin/users">Liste des Utilisateurs</a>
              <?php endif ?>        
            </div>
          </li> 
          <?php endif; ?>     
        </ul>
        <ul class="navbar-nav">
          <?php if (!isset($userSession)): ?>
          <li class="nav-item">
            <a class="nav-link" href="register">Créer un compte</a>
          </li>
          <li class="nav-item">
            <a class="nav-connexion" href="login">Connexion</a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a href="profil/<?= $userSession->getId() ?>" class="nav-mail"><?= $userSession->getMail() ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-deco" href="?action=destroy">Déconnexion</a>
          </li>
          <?php endif; ?>
        </ul>
      </div> 
    </div>
  </nav>