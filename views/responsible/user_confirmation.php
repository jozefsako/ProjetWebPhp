<div class="container">

  <form action="index.php?action=userConfirmation" method="post">
    <div class="card mt-4">

      <div class="card-body">
        <h3 class="card-title">Gestion de membres</h3>
        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Liste de membres non validés
          </div>

          <div class="card-body">

            <table class="table table-striped">
              <tbody>
                <?php foreach ($tab_users as $i => $user) { ?>
                  <tr>
                    <td><?php echo $user->html_firstname() ?></td>
                    <td><?php echo $user->html_lastname() ?></td>
                    <td><?php echo $user->html_email() ?></td>
                    <td><input style="margin-left: -90%;" type="checkbox" name="user[]" id="user" value="<?php echo $i ?>"/></td>
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
            <input type="submit" name="form_user" value="Confirmer" class="btn btn-success"/>
			<input type="submit" name="form_user_delete" value="Supprimer" class="btn btn-danger"/>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>
