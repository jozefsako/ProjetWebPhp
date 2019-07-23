</br></br>
<div class="container">
  <div class="row main">

    <div class="main-login main-center">

      <form class="form-horizontal" method="post" action="index.php?action=login" >
        <div class="panel-heading">
          <div class="panel-title text-center">
            <h1 class="title">Inscription</h1>
            <hr />
          </div>
        </div>

        <div class="form-group">
          <label for="name" class="cols-sm-2 control-label">Votre Nom</label>
          <div class="cols-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true" style="margin-left:-5%;"></i></span>
              <input type="text" class="form-control" name="name" id="name"  placeholder="Entez votre Nom" style="margin-left:3%;"/>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="email" class="cols-sm-2 control-label">Votre Email</label>
          <div class="cols-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true" style="margin-left:-5%;"></i></span>
              <input type="text" class="form-control" name="email" id="email"  placeholder="Entez votre Email" style="margin-left:3%;"/>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="password" class="cols-sm-2 control-label">Mot de passe</label>
          <div class="cols-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true" style="margin-left:-5%;"></i></span>
              <input type="password" class="form-control" name="password" id="password"  placeholder="Entez votre Mot de passe" style="margin-left:3%;"/>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="confirm" class="cols-sm-2 control-label">Confirmation Mot de passe</label>
          <div class="cols-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true" style="margin-left:-5%;"></i></span>
              <input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirmez votre Mot de passe" style="margin-left:3%;"/>
            </div>
          </div>
        </div>

        <div class="form-group ">
          <?php if(!empty($errors)){ ?>
            <div class="alert alert-danger">
              <strong>Attention</strong>
              <?php foreach ($errors as $i => $err) { ?>
                <br/>
                <?php echo $err; ?>
              <?php }  ?>
            </div>
          <?php  }else if(!empty($success)){?>
            <div class="alert alert-success">
              <strong>Félicitations!</strong> <?php echo $success; ?></a>
            </div>
          <?php } ?>
          <input type="submit" name="form_signin" class="btn btn-primary btn-lg btn-block login-button" value="S'enregistrer"/>
        </div>
        <div class="login-register">
          <a href="index.php?action=login&page=login">Se connecter</a>
        </div>
      </form>
    </div>
  </div>
</div>
