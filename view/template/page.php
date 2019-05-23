<?php include 'include/_head.php'; ?>  
  <!-- Page Header -->
  <header class="masthead d-flex align-items-center" style="background-image: url('public/img/home-bg.png')">
    <div class="container">
      <div class="row">
          <div class="page-heading">
            <h1><?= $title ?></h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?= $content ?>
          <!-- Pager -->
        </div>
      </div>
    </div>
  </main>

<?php include 'include/_footer.php'; ?>
<?php include 'include/_bottom.php'; ?>