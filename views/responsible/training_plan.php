<div class="container">

  <form enctype="multipart/form-data" action="index.php?action=trainingPlan" method="post">
    <div class="card mt-4">

      <div class="card-body">

        <h3 class="card-title">Gestion des Plans d'entraintement</h3>

        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Introduire un Plan d'entraintement
          </div>

          <div class="card-body">

            <label>Nom</label>
            <input type="text" class="form-control" name="name" placeholder="* Optionnel">
            <br/>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
    				<input type="file" name="csvfile" />
            <hr>
          </form>
          
          <?php if(!empty($notification)){ ?>
            <div class="alert alert-danger">
              <strong>Attention</strong> <?php echo $notification; ?></a>
            </div>
          <?php }else if(!empty($success)){?>
            <div class="alert alert-success">
              <strong>Félicitations!</strong> <?php echo $success; ?></a>
            </div>
          <?php } ?>
          <input type="submit" name="form_import_plan" value="Importer" class="btn btn-success"/>
        </div>
      </div>
    </div>
  </div>
</form>

</div>
