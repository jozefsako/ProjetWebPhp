<div class="container">

  <form action="index.php?action=eventsManagement&page=create" method="post">
    <div class="card mt-4">

      <div class="card-body">

        <!-- <h3 class="card-title">Gestion des Evenements</h3> -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

          <a class="navbar-brand" href="">Gestion des Evenements</a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" >

              <li class="nav-item active">
                <a class="nav-link" href="index.php?action=eventsManagement&page=create">Créer un évènement <span class="sr-only">(current)</span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="index.php?action=eventsManagement&page=coming">Evènements à venir</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="index.php?action=eventsManagement&page=old">Evènements passés</a>
              </li>

            </ul>

          </div>
        </nav>
        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Créer un évènement
          </div>

          <div class="card-body">

            <form>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Titre</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" placeholder="Entrez ici le nom de l'évènement"/>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Date début</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="start_date" placeholder="Entrez ici la date de début de l'évènement"/>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Date fin</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="end_date" placeholder="Entrez ici la date de fin de l'évènement"/>
                </div>
              </div>


              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Descriptif</label>
                <div class="col-sm-10">
                  <form action="index.php?action=eventsManagement" method="post">
                    <textarea id="editor" name="html_input" placeholder="Entrez ici le descriptif de l'évènement">
                      <?php echo $this->getRawHtml(); ?>
                    </textarea>
                    <!-- <input type="submit" name="result_wysiwyg" value="Rendu"> -->
                  </form>
                  <!-- <?php if(!empty($_POST['result_wysiwyg'])){?>
                  <section>
                  <h6>Rendu :</h6>
                  <div>
                  <?php echo $this->getRawHtml(); ?>
                </div>
              </section>
            <?php }?> -->
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Lieu</label>
          <div class="col">
            <input type="text" class="form-control" name="longitude" placeholder="Entrez ici la longitude"/>
          </div>
          <div class="col">
            <input type="text" class="form-control" name="latitude" placeholder="Entrez ici la latitude"/>
          </div>
        </div>

        <div class="form-group row">
          <label  class="col-sm-2 col-form-label">URL</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="url" placeholder="Entrez ici l'URL de l'évènement"/>
          </div>
        </div>

        <div class="form-group row">
          <label  class="col-sm-2 col-form-label">Coût Approx</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="cost" placeholder="Entrez ici le Coût Approximatif de l'évènement">
          </div>
        </div>
        <hr>

        <div class="form-group ">
          <?php if(!empty($errors)){ ?>
            <div class="alert alert-danger">
              <strong>Attention</strong>
              <?php foreach ($errors as $i => $err) { ?>
                <br/>
                <?php echo $err; ?>
              <?php  }  ?>
            </div>
          <?php  }else if(!empty($success)){ ?>
            <div class="alert alert-success">
              <strong>Félicitations!</strong> <?php echo $success; ?></a>
            </div>
          <?php } ?>
          <input type="submit" name="form_add_event" value="Confirmer" class="btn btn-success"/>
        </div>

      </form>
    </div>
  </div>
</div>
</div>
</form>

<script src="./assets/ckeditor.js">
</script>
<script src="<?php echo PATH_VIEWS?>javascript/wysiwyg.js">
</script>

</div>
