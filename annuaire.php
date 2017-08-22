<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Annuaire</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
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
      <table class="table">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>E-mail</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Groupes</th>
          </tr>
        </thead>
      </table>
        <div class="row">
      <?php

      // connexion a la BDD
      try{
        $bdd = new PDO('mysql:host=localhost;dbname=annuaire;charset=utf8', 'root', 'root');
      }
      catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
      }

      // lecture de la table annuaireUser
      $reponse = $bdd->query('SELECT * FROM annuaireUser');

      while($donnees=$reponse->fetch()){
        echo '<form action="annuaire.php" method="post">
                <ul>
                  <li><input type="hidden" name="hidden" value="'.$donnees['_id'].'"/></li>
                  <li><input type="text" name="name" value="'.$donnees['name'].'"/></li>
                  <li><input type="text" name="lastname" value="'.$donnees['lastname'].'"/></li>
                  <li><input type="text" name="email" value="'.$donnees['email'].'"/></li>
                  <li><input type="text" name="adress" value="'.$donnees['adress'].'"/></li>
                  <li><input type="text" name="phone" value="'.$donnees['phone'].'"/></li>
                  <li>'.$donnees['groupSelected'].'</li>
                  <li><button type="submit" id="'.$donnees['_id'].'" name="update">Modif</button></li>
                  <li><button type="submit" id="'.$donnees['_id'].'" name="delete">Supp</button></li>
                </ul>
                </form>';
      }

          $name=$_POST['name'];
          $lastname=$_POST['lastname'];
          $email=$_POST['email'];
          $phone= $_POST['phone'];
          $adress=$_POST['adress'];
          $id=$_POST['hidden'];

          if (isset($name)) {
            # code...
          }
          if (isset($id)) {
            echo "suppréssion en cours ".$id;
            $bdd->exec('DELETE FROM annuaireUser WHERE _id = '.$id.'');
            //print_r($bdd->errorInfo());
          }
      ?>
    </div>

    </main>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
  </body>
</html>
