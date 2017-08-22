<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>admin annuaire</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css"> -->

  </head>
  <body>
    <header>
      <div class="navbar-fixed">
        <nav class="brown darken-2">
          <div class="nav-wrapper">
            <a href="annuaire.php" class="brand-logo">Annuaire</a>
            <ul class="right hide-on-med-and-down">
              <li><a href="annuaire.php">Annuaire</a></li>
              <li><a href="admin.php">Créer un contact</a></li>
              <li><a href="groupe.php">Créer un groupe</a></li>
            </ul>
          </div>
        </nav>
      </div>
    </header>

    <main>
      <form class="form" action="" method="post">
        <div class="row">

          <div class="col s12">
              <div class="input-field col s4">
                <label for="name">Nom</label>
                <input id="name" type="text" name="name"/>
              </div>

              <div class="input-field col s4">
                <label for="lastname">Prénom</label>
                <input id="lastname" type="text" name="lastname"/>
              </div>

              <div class="input-field col s4">
                <label for="email">E-mail</label>
                <input id="email" type="text" name="email"/>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col s12">
                <div class="input-field col s4">
                  <label for="phone">Téléphone</label>
                  <input id="phone" type="text" name="phone"/>
                </div>

                <div class="input-field col s4">
                  <label for="adress">Adresse</label>
                  <input id="adress" type="text" name="adress"/>
                </div>

                <div class="input-field col s4">
                  <select id="select" class="select" name="group">
                    <option value="" >Choisissez un groupe</option>
                    <?php

                        // connexion a la BDD
                        try{
                          $bdd = new PDO('mysql:host=localhost;dbname=annuaire;charset=utf8', 'root', 'root');
                        }
                        catch (Exception $e){
                          die('Erreur : ' . $e->getMessage());
                        }

                        $reponse = $bdd->query('SELECT * FROM groups');
                        while($donnees=$reponse->fetch()){
                          $array=[$donnees];
                          echo "<option>".$donnees['nom']."</option>";
                        }

                        print_r($array);

                    ?>
                    <label for="select">Groupes</label>

                  </select>
                </div>


              </div>

            </div>

              <div class="col s4">
                <button class="btn cyan lighten-1 right" type="submit" name="send">Envoyer</button>

              </div>

            </div>
      </form>
    </main>

    <footer>

      <div class="row">
        <div class="col s8">
            <?php

            $name=$_POST['name'];
            $lastname=$_POST['lastname'];
            $email=$_POST['email'];
            $phone= $_POST['phone'];
            $adress=$_POST['adress'];
            $group=$_POST['group'];


            // gestion des inputs obligatoires
            $errorsEmpty=[];

              if (empty($name)) {
                $errorsEmpty[]= "Veuillez renseigner le nom.";
              }
              if (empty($lastname)) {
                $errorsEmpty[]= "Veuillez renseigner le prénom.";

              }


                // ecriture sur la BDD

                $req = $bdd->prepare('
                INSERT INTO annuaireUser (name, lastname, email, adress, phone, groupSelected)
                VALUES(:name, :lastname, :email, :adress, :phone, :groupSelected);
                ');

                $req->execute(array(
                  'name' => $name,
                  'lastname' => $lastname,
                  'email' => $email,
                  'adress' => $adress,
                  'phone' => $phone,
                  'groupSelected' => $group,
                ));

            //    echo $req->errorInfo()[2];


            // affichage des champs requis
            if (isset($name) && isset($lastname)) {

                if (!empty($req->errorInfo()) && empty($errorsEmpty)) {
                  echo '<div class="row">
                          <div class="col s6 offset-s3">
                            <div class="card light-green lighten-1">
                              <div class="card-content center white-text">
                                  <p> Contact enregistré avec succès ! </p>
                              </div>
                            </div>
                         </div>
                       </div>
                     ';
                } elseif (!empty($errorsEmpty)) {
                  foreach ($errorsEmpty as $value) {
                    echo '<div class="row">
                            <div class="col s6 offset-s3">
                              <div class="card red lighten-1">
                                <div class="card-content center white-text">
                                    <p>'.$value.'</p>
                                </div>
                              </div>
                           </div>
                         </div>';
                  }

              }
            }


            // // essais jointure
            // $bdd->query('SELECT annuaireUser, groups
            // FROM groups
            // INNER JOIN annuaireUser
            // ON annuaireUser["_id"] = groups[_idUser"]
            // ');

            ?>

        </div>
    </footer>



    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script> -->
  </body>
</html>
