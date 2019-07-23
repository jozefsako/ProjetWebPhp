<div class="container">
  <br/></br>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- <a class="navbar-brand" href="index.php?action=setting" style="margin-left: 3%; margin-right: 3%" ><?php echo $_SESSION['label']?></a> -->

    <?php if(!file_exists($_SESSION['picture'])){ ?>
      <a class="navbar-brand" href="index.php?action=setting"><img style="margin-left: 50%; margin-right: 50%; vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" src="<?php echo PATH_USERS_PICTURES.'common2.png' ?>" alt="Alternate Text" class="img-responsive" /></a>
    <?php }else{ ?>
    <a class="navbar-brand" href="index.php?action=setting"><img style="margin-left: 50%; margin-right: 50%; vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" src="<?php echo $_SESSION['picture'] ?>" alt="Alternate Text" class="img-responsive" /></a>
  <?php } ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" style="margin-left: 5%;">
      <!-- <ul class="navbar-nav mr-auto"> -->
      <?php if($_SESSION['type']!="m"){ ?>
        <?php if($current_page=="userConfirmation"){ ?>
          <li class="nav-item active">
        <?php } else { ?>
          <li class="nav-item">
        <?php } ?>
          <a class="nav-link" href="index.php?action=userConfirmation">Membres <span class="sr-only">(current)</span></a>
        </li>
        <?php if($current_page=="userResponsibility"){ ?>
          <li class="nav-item active">
        <?php } else { ?>
          <li class="nav-item">
        <?php } ?>
        <a class="nav-link" href="index.php?action=userResponsibility">Roles</a>
      </li>
      <?php if($current_page=="eventsManagement"){ ?>
        <li class="nav-item active">
      <?php } else { ?>
        <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="index.php?action=eventsManagement&page=create">Evenements</a>
      </li>
      <?php if($current_page=="userPayement"){ ?>
        <li class="nav-item active">
      <?php } else { ?>
        <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="index.php?action=userPayement">Paiements</a>
      </li>
      <?php if($current_page=="contribution"){ ?>
        <li class="nav-item active">
      <?php } else { ?>
        <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="index.php?action=contribution">Cotisations</a>
      </li>
      <?php if($_SESSION['type']=="c") { ?>
      <?php if($current_page=="trainingPlan"){ ?>
        <li class="nav-item active">
      <?php } else { ?>
        <li class="nav-item">
      <?php } ?>
        <a class="nav-link" href="index.php?action=trainingPlan">Plans-Entraintements</a>
      </li>
    <?php }} ?>
    
      

    </ul>

  </div>
</nav>
</div>
