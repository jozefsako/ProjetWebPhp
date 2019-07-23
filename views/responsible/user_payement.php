<div class="container">

  <form action="index.php?action=userPayement" method="post">
    <div class="card mt-4">

      <div class="card-body">
        <h3 class="card-title">Gestion de Paiement</h3>
        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Liste des membres pas en ordre de paiement à un évènement
          </div>

          <div class="card-body">

            <table class="table table-striped">
              <tbody>
                <?php foreach ($tab_registrations as $i => $registration) { ?>
                  <tr>
                  <td><?php echo $registration[1] ?></td>
                  <td><?php echo $registration[3] ?></td>
                  <td><input type="checkbox" name="user[]" id="user" value="<?php echo $i ?>"/></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <hr>
            <?php if(!empty($notification)){ ?>
              <div class="alert alert-danger">
                <strong>Attention</strong> <?php echo $notification; ?></a>
              </div>
            <?php }else if(!empty($success)){?>
              <div class="alert alert-success">
                <strong>Félicitations!</strong> <?php echo $success; ?></a>
              </div>
            <?php } ?>
            <input type="submit" name="form_registration" value="Confirmer" class="btn btn-success"/>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>
