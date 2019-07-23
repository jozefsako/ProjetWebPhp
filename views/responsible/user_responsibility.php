<div class="container">

  <form action="index.php?action=userResponsibility" method="post">
    <div class="card mt-4">

      <div class="card-body">

        <h3 class="card-title">Gestion des rôles</h3>

        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Modifier le rôle d'un autre membre responsable
          </div>

          <div class="card-body">

            <table class="table">

          <tbody >
            <?php foreach ($tab_users as $i => $user) { ?>
              <tr>
                <td><?php echo $user->html_firstname(); ?></td>
                <td><?php echo $user->html_lastname(); ?></td>
                <td><input type="text" class="form-control" name="<?php echo $i?>role" value="<?php echo $user->html_role() ?>" placeholder="Entrez un rôle ici .." /></td>
                <td> <input type="radio" <?php if($user->type()=="m"){ echo 'checked="checked"'; } ?> name="<?php echo $i?>type" value="m"> M</td>
                <td> <input type="radio" <?php if($user->type()=="r"){ echo 'checked="checked"'; } ?> name="<?php echo $i?>type" value="r"> R</td>
                <td> <input type="radio" <?php if($user->type()=="c"){ echo 'checked="checked"'; } ?> name="<?php echo $i?>type" value="c"> C</td>
                <td style="display:none;" ><input type="checkbox" checked="checked" name="user[]" id="user" value="<?php echo $i ?>"/></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <hr>
        <?php if(!empty($notification)){ ?>
          <div class="alert alert-danger">
            <strong>Attention !</strong> <br/><?php echo $notification; ?></a>
          </div>
        <?php }else if(!empty($success)){?>
          <div class="alert alert-success">
            <strong>Félicitations!</strong> <?php echo $success; ?></a>
          </div>
        <?php } ?>
        <input type="submit" name="form_responsibility" value="Modifier" class="btn btn-success"/>
      </div>

    </div>
  </div>
</div>
</form>

</div>
