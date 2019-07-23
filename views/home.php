</br></br>

<div class="container">
  <!-- Heading Row -->
  <div class="row my-4">
    <div class="col-lg-8">
      <?php if(!file_exists($random_picture)){ ?>
        <img class="img-fluid rounded" src="http://placehold.it/900x400" alt="">
      <?php }else{ ?>
        <img class="img-fluid rounded" src="<?php echo $random_picture ?>" alt="<?php echo $random_picture ?>">
      <?php } ?>
    </div>
    <!-- /.col-lg-8 -->
    <div class="col-lg-4">
      <h1>Gestion de Coureurs</h1>
      <p align="justify">Bienvenue sur le site officiel des coureurs du groupe <span class="font-weight-bold"><?php echo $XXX ?></span> de la ville de <span class="font-weight-bold"><?php echo $YYY ?></span> en Belgique. Ce site est réservé aux membres du club ; il permet la gestion de ses membres (cotisations), des événements ainsi que des plans d'entrainement. </p>
      <a class="btn btn-primary " href="index.php?action=login">Se Connecter</a>
      <a class="btn btn-primary " href="index.php?action=login&page=signin" style="margin-left:5%;">S'inscrire</a>
    </div>
    <!-- /.col-md-4 -->
  </div>

  <div class="card text-white bg-secondary my-4 text-center">
    <div class="card-body">
      <p class="text-white m-0">Pour s'inscrire, il faut être membre -  L'inscription doit être validé par un responsable.</p>
      <p>Mail : <?php echo $responsible->email(); ?> - Télephone : <?php echo $responsible->phone(); ?></p>
    </div>
  </div>

  <div class="card text-white bg-secondary my-4 text-center">
    <div class="card-body">
      <p class="text-white m-0">Developpé par <?php echo $VVV ?> © <br/><?php echo DATE_TODAY ?></p>
    </div>
  </div>
</div>
