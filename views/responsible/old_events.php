<div class="container">

  <form action="index.php?action=eventsManagement&page=old" method="post">
    <div class="card mt-4">

      <div class="card-body">

        <!-- <h3 class="card-title">Gestion des Evenements</h3> -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

          <a class="navbar-brand" href="">Gestion des Evenements</a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" >
              <!-- <ul class="navbar-nav mr-auto"> -->

              <li class="nav-item">
                <a class="nav-link" href="index.php?action=eventsManagement&page=create">Créer un évènement <span class="sr-only">(current)</span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="index.php?action=eventsManagement&page=coming">Evènements à venir</a>
              </li>

              <li class="nav-item active">
                <a class="nav-link" href="index.php?action=eventsManagement&page=old">Evènements passés</a>
              </li>

            </ul>

          </div>
        </nav>

        <?php if(empty($tab_events)){ ?>
          <br/><br/>
          <div class="alert alert-warning">
            <strong>Attention ! </strong><?php echo $notification_empty_events; ?>
          </div>
        <?php }else{ ?>

          <div class="card card-outline-secondary my-4">

            <div class="card-header">
              Liste des évènements
            </div><br/>

            <div class="row">
              <div style="margin-left: 1%;" class="table-responsive col-md-2">
                <ul class="list-group" >

                  <?php foreach ($tab_events as $i => $event) { ?>
                    <?php if($event->id() == $selected_event_id){?>
                      <input class="list-group-item" style="text-align: left; font-size: 15px; color: white; background-color:rgba(28, 29, 32, 0.93);" type="submit" name="event_i" value="<?php echo $i; echo' - ';echo $event->title() ?>">
                    <?php }else{ ?>
                      <input class="list-group-item" style="text-align: left; font-size: 15px;" type="submit" name="event_i" value="<?php echo $i; echo' - ';echo $event->title() ?>">
                    <?php } ?>
                  <?php }?>

                </ul>
              </div>
              <div class="table-responsive col-md" >

                <!-- https://developers.google.com/maps/documentation/geocoding/intro?hl=fr -->
                <div id="map" style="height: 450px; width: 100%; margin-left: -1%;"></div>
                <script>
                function initMap() {

                  var position = {lat: <?php echo $selected_event->lat(); ?>, lng: <?php echo $selected_event->lng(); ?> };
                  var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 18,
                    center: position
                  });
                  var marker = new google.maps.Marker({
                    position: position,
                    map: map
                  });
                }
                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $API_KEY_JOZEF ?>&callback=initMap"></script>

              </div>
            </div>
            <br/>
          </div>

        <?php }?>
      </div>
    </div>
  </form>
</div>

<?php if(!empty($selected_event)){ ?>

  <div class="container">

    <div class="card mt-4">

      <div class="card-body">

        <div class="card card-outline-secondary my-4">

          <div class="card-header">
            Modifier un évènement

          </div>

          <div class="card-body">

            <form action="index.php?action=eventsManagement&page=old" method="post">

              <input style="visibility: hidden;" type="text" name="id_event" value="<?php echo $selected_event->id();?>" />
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Titre</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" value="<?php echo $selected_event->title() ?>" placeholder="Entrez ici le nom de l'évènement"/>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Date début</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="start_date"  value="<?php echo $selected_event->start(); ?>" placeholder="Entrez ici la date de début de l'évènement"/>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Date fin</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="end_date" value="<?php echo $selected_event->end(); ?>" placeholder="Entrez ici la date de fin de l'évènement"/>
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Descriptif</label>
                <div class="col-sm-10">
                  <textarea id="editor" name="html_input" placeholder="Entrez ici le descriptif de l'évènement">
                    <?php echo $selected_event->description(); ?>
                  </textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lieu</label>
                <div class="col">
                  <input type="text" class="form-control" name="lng_event" value="<?php echo $selected_event->lng(); ?>" placeholder="Entrez ici la longitude"/>
                </div>
                <div class="col">
                  <input type="text" class="form-control" name="lat_event" value="<?php echo $selected_event->lat(); ?>" placeholder="Entrez ici la latitude"/>
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">URL</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="url" value="<?php echo $selected_event->url(); ?>" placeholder="Entrez ici l'URL de l'évènement"/>
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">URL photos</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="picture" value="<?php echo $selected_event->picture(); ?>" placeholder="Entrez ici l'URL de l'évènement"/>
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Coût Approx</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="cost" value="<?php echo $selected_event->cost(); ?>" placeholder="Entrez ici le Coût Approximatif de l'évènement">
                </div>
              </div>

              <hr>
              <input type="submit" name="modify_event" value="Modifier" class="btn btn-success" />
              <input type="submit" name="list_users" value="Lister" class="btn btn" />
              <input type="submit" style='float: right;' name="both" value="Inscrits & Interessés" class="btn btn" />
              <input type="submit" style='float: right; margin-right: 0.5%;' name="interested" value="Interessés" class="btn btn-primary" />
              <input type="submit" style='float: right; margin-right: 0.5%;' name="subscripted" value="Inscrits" class="btn btn-primary" />

              <div class="form-group ">
                <?php if(!empty($errors)){ ?><br/>
                  <div class="alert alert-danger">
                    <strong>Attention</strong>
                    <?php foreach($errors as $i => $err) { ?>
                      <br/>
                      <?php  echo $err; ?>
                    <?php } ?>
                  </div>
                <?php  }else if(!empty($success_modify)){ ?>
                  <br/>
                  <div class="alert alert-success">
                    <?php echo $success_modify; ?>
                  <?php } else if(!empty($success)){ ?>
                    <br/>
                    <div class="alert alert-warning">
                      <?php echo $success; ?><strong>
                      <?php } ?>
                      <!-- </div> -->

                      <div class="form-group ">
                        <?php if(!empty($user_interested)){ ?>
                          <br/>
                          <?php foreach ($user_interested as $i => $email) { ?>
                            <?php  echo $email.';'; ?>
                          <?php  }
                        } ?>
                      </div>

                      <div class="form-group ">
                        <?php if(!empty($user_subscripted)){
                          foreach ($user_subscripted as $i => $email) {
                            echo $email.';';
                          }
                        } ?>
                      </div>

                      <div class="form-group ">
                        <?php if(!empty($all_users)){
                          foreach ($all_users as $i => $email) {
                            echo $email.';';
                          }
                        } ?>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <script src="./assets/ckeditor.js">
    </script>
    <script src="<?php echo PATH_VIEWS?>javascript/wysiwyg.js">
    </script>

  <?php } ?>

  <?php if(!empty($_POST['list_users'])){ ?>
    <div class="container">

      <div class="card mt-4">

        <div class="card-body">

          <div class="card card-outline-secondary my-4">

            <div class="card-header">
              Les membres inscrits et intéressée : <strong><?php echo $selected_event->title(); ?></strong>
            </div>

            <div class="card-body">

              <?php if(!empty($users_from_event)){ ?>

                <table class="table table-striped" >
                  <tbody>
                    <?php foreach ($users_from_event as $i => $user) { ?>
                      <tr>
                        <td><?php echo $user[0] ?></td>
                        <td><?php echo $user[1] ?></td>
                        <td><?php echo $user[2] ?></td>

                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

              <?php }else{ ?>
                <div class="alert alert-warning">
                  Il n'a aucun membre inscrits et/ou intéressé par <strong><?php echo $selected_event->title(); ?></strong>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>

    </div>
  <?php }?>
