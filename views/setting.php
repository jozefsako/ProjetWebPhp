<div class="container">
  <form  enctype="multipart/form-data" action="index.php?action=setting" method="post">
    <div class="card mt-4">

      <div class="card-body">
        <h3 class="card-title">Editer Profile</h3>
        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Photo de profile
          </div>

          <div class="card-body">
            <div class="row">

              <div class="col-md-5">
                  <?php if(!file_exists($user->picture())){ ?>
                  <!-- <img src="http://placehold.it/120x120" alt="Alternate Text" class="img-responsive" /> -->
                  <img style="width: 32%; border-radius: 50%;" src="<?php echo PATH_USERS_PICTURES.'common2.png' ?>" alt="Alternate Text" class="img-responsive" />
                <?php }else{ ?>
                  <img style="margin-left: 10%; width: 38%; border-radius: 50%;" src="<?php echo $user->picture() ?>" alt="Alternate Text" class="img-responsive" />
                <?php } ?>
              </div>

              <div class="col-md-7">
                <span>
                  <?php echo $user->firstname().' '.$user->lastname() ?> -
                  <?php if($user->type()=="r"){ ?>
                    Responsable
                  <?php }else if($user->type()=="c"){ ?>
                    Coach
                  <?php }else{ ?>
                    Membre
                  <?php } ?>
                </span>

                <p class="text-muted small"><?php echo $user->email() ?></p>

                <?php if((!empty($user->role()))){ ?>
                  <span>Role </span>
                  <p class="text-muted small">
                    <?php echo $user->role(); ?>
                  </p>
                <?php }?>
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                <input type="file" name="profile_picture" />
                <input type="submit" name="form_user_picture" value="Modifier" class="btn btn-primary btn-sm"/>
                <?php if(!empty($notification)){ ?>
                  <div class="alert alert-danger">
                    <strong>Attention</strong>
                    <?php echo $notification; ?>
                  </div>
                <?php  }else if(!empty($success)){ ?>
                  <div class="alert alert-success">
                    <strong>Félicitations</strong>
                    <?php echo $success; ?>
                  </div>
                <?php } ?>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </form>

  <form action="index.php?action=setting" method="post">
    <div class="card mt-4">

      <div class="card-body">

        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Informations Personnelles
          </div>

          <div class="card-body">
            <form>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="lastname" value="<?php echo $user->lastname() ?>"/>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Prenom</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="firstname" value="<?php echo $user->firstname() ?>"/>
                </div>
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Telephone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="phone" value="<?php echo $user->phone() ?>"/>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" value="<?php echo $user->email() ?>"/>
                </div>
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Adresse</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="address" value="<?php echo $user->address() ?>"/>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Compte</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="bank" value="<?php echo $user->bank() ?>">
                </div>
              </div>

            </form>

            <hr>

            <?php if(!empty($success_setting)){?>
              <div class="alert alert-success">
                <strong>Félicitations!</strong> <?php echo $success_setting; ?></a>
              </div>
            <?php } ?>
            <input type="submit" name="form_setting" value="Modifier" class="btn btn-success"/>
          </div>
        </div>

      </div>
    </div>
  </form>



  <form action="index.php?action=setting" method="post">
    <div class="card mt-4">

      <div class="card-body">
        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Gestion de Mot de Passe
          </div>

          <div class="card-body">
            <form>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Ancien</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="current_password" placeholder="Entrez votre mot de passe courrant"/>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Nouveau</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="new_password" placeholder="Entrez ici votre nouveau Mot de Passe"/>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Confirmation</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="confirmation" placeholder="Retapez votre nouveau Mot de Passe"/>
                </div>
              </div>

            </form>

            <hr>
            <?php if(!empty($errors)){ ?>
              <div class="alert alert-danger">
                <strong>Attention</strong>
                <?php foreach ($errors as $i => $err) { ?>
                  <br/>
                  <?php echo $err; ?>
                <?php }?>
              </div>

            <?php  }else if(!empty($success_password)){ ?>
              <div class="alert alert-success">
                <strong>Félicitations</strong>
                <?php echo $success_password; ?>
              </div>
            <?php } ?>
            <input type="submit" name="form_password" value="Modifier" class="btn btn-success"/>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>
