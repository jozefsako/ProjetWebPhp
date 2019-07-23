<div class="container">

  <form action="index.php?action=contribution" method="post">
    <div class="card mt-4">

      <div class="card-body">

        <h3 class="card-title">Gestion de cotisations</h3>

        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Débuter une nouvelle année de cotisation
          </div>

          <div class="card-body">
            <label for="exampleInputEmail1">Période</label>
            <input type="text" class="form-control" name="year" placeholder="Entez la période de la nouvelle cotisation">
            <br/>
            <label >Montant</label>
            <input type="text" name="cost" class="form-control" placeholder="Entez le montant de la nouvelle cotisation">
            <hr>
            <?php if(!empty($errors)){ ?>
              <div class="alert alert-danger">
                <strong>Attention</strong> <br/>
                <?php foreach ($errors as $i => $err) { ?>
                  <?php echo $err; ?>
                  <br/>
                <?php } ?>
              </div>
            <?php }else if(!empty($success)){?>
              <div class="alert alert-success">
                <strong>Félicitations!</strong> <?php echo $success; ?>
              </div>
            <?php } ?>
            <input type="submit" name="form_contribution" value="Confirmer" class="btn btn-success"/>
          </div>

        </div>
      </div>
    </div>
  </form>

  <form action="index.php?action=contribution" method="post">
    <div class="card mt-4">

      <div class="card-body">
        <div class="card card-outline-secondary my-4">

          <div class="card-header">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              Liste de membres pas en ordre de cotisation

              <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <form class="form-inline my-2 my-lg-0">
                  <input style="margin-left: 8%;" class="form-control mr-sm-2" name="date_contribution" placeholder="Chercher à une période précise Ex: 2017 ..." aria-label="Filtrer">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher</button>
                </form>

              </div>
            </nav>

          </div>


          <div class="card-body">

            <table class="table">
              <tbody>

                <?php if(!empty($tab_user_contributions)){ ?>
                  <?php foreach ($tab_user_contributions as $i => $user_contribution) { ?>
                    <tr>
                      <td><?php echo $user_contribution[1] ?></td>
                      <td><input style="margin-left: -10%;" class="form-control" type="text" name="<?php echo $i ?>amount_payement" placeholder="Introduisez le montant ici"/></td>
                      <td><?php echo $user_contribution[3] ?></td>
                      <td style="display: none;"><input type="checkbox" name="user[]" checked id="user" value="<?php echo $i ?>"/></td>
                    </tr>
                  <?php } ?>
                <?php }else{ ?>
                  <div class="alert alert-warning">
                    <strong>Attention</strong> <?php echo $notification_date; ?>
                  </div>
                <?php } ?>
              </tbody>
            </table>
            <hr>
            <input type="submit" name="form_user_contribution" value="Confirmer" class="btn btn-success"/>
            <input type="submit" name="list_user" value="Lister" class="btn btn-primary"/><br/>

            <?php if(!empty($users)){ ?>
              <br/>
              <div class="alert alert-warning">
                Il y a <strong><?php echo count($users); ?></strong> membres pas en ordre de paiement !</a><br/><br/>
                <?php foreach ($users as $i => $user_contribution) { ?>
                  <strong><?php echo $user_contribution[1].';';?></strong>
                <?php } ?>
              </div>
            <?php } ?>
            <br/>
            <?php if(!empty($notification_contribution)){ ?>
              <div class="alert alert-danger">
                <strong>Attention</strong> <br/>
                <?php echo $notification_contribution; ?>
              </div>
            <?php }else if(!empty($success_contribution)){ ?>
              <div class="alert alert-success">
                <?php echo $success_contribution; ?>
              </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>
