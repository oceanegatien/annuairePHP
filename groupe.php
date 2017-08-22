<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Créer un groupe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
    <link rel="stylesheet" href="style.css">
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
    <main class="container">
      <form class="" action="" method="post">
        <div class="row">
          <div class="col s12">
            <div class="input-field col s8">
              <label for="name">Nom du groupe</label>
              <input id="name" type="text" name="nameGroup"/>
            </div>
          </div>

            <div class="row">

              <div class="col s4">
                <button id="btnGroup" class="btn" type="submit" name="sendGroup">Créer un groupe</button>
              </div>
            </div>

      </form>

    </main>
    <?php
    $nomGroup=$_POST['nameGroup'];

    try{
      $bdd = new PDO('mysql:host=localhost;dbname=annuaire;charset=utf8', 'root', 'root');
    }
    catch (Exception $e){
      die('Erreur : ' . $e->getMessage());
    }

    $array=[];
    $reponse = $bdd->query('SELECT * FROM groups');
    while($donnees=$reponse->fetch()){

      echo $donnees['nom'];
      $array=$donnees['nom'];
    }
    print_r($array);
    if (isset($nomGroup)) {

    // $count=count($array);
    // for ($i=0; $i <$count ; $i++) {
    //   if ($array[$i] === $nomGroup) {
    //     echo '<div class="row">
    //     <div class="col s6 offset-s3">
    //     <div class="card red lighten-1">
    //     <div class="card-content center white-text">
    //     <p> Le groupe '.$donnees['nom'].' éxiste déjà </p>
    //     </div>
    //     </div>
    //     </div>
    //     </div>';
    //
    //   }else {
    //     // enregistrement group
    //
    //     $reqGroup = $bdd->prepare('
    //     INSERT INTO groups (nom)
    //     VALUES(:nom)
    //     ');
    //
    //     $reqGroup->execute(array(
    //       'nom' => $nomGroup,
    //     ));
    //
    //     if(!empty($reqGroup->errorInfo())){
    //       echo '<div class="row">
    //       <div class="col s6 offset-s3">
    //       <div class="card light-green lighten-1">
    //       <div class="card-content center white-text">
    //       <p> Groupe enregistré avec succès ! </p>
    //       </div>
    //       </div>
    //       </div>
    //       </div>
    //       ';
    //     }
    //
    //   }
    //
    // }


  }







    ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
  </body>
</html>
