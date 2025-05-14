<?php
    function loginBDD(){
        $liaison = mysqli_connect("localhost", "root", "", "bdd_aeroport") or exit(mysqli_error());
        return $liaison;
    }

    //Tentative de login
    function tentativeLogin(){
        $liaison = loginBDD();
        //Récupération du mail et du mot de passe entré en paramètre
        $identifiant = $_GET["identifiant"];
        $motDePasse = hash("sha256", $_GET["motDePasse"]."dRp@y7At2KyvHDb9Dk!b");

        //Création de la requête et récupération du résultat
        $requete = "SELECT * FROM employe WHERE mail = '$identifiant' AND mdpHache = '$motDePasse'";
        $resultat = mysqli_query($liaison, $requete);
        $resultat = mysqli_fetch_assoc($resultat);

        if ($resultat["idEmploye"] != false){
            header("location:"."http://localhost/SiteAeroport/accueil.php");
        } else {
            header("Location:"."http://localhost/SiteAeroport/login.php"."?logfailed=true");
        }

        //Fermerture de la liaison
        mysqli_free_result($resultat);
        mysqli_close($liaison);
    }

    //Affichage des vols en fonction de l'état choisit
    function rechercheEtat(){
        $liaison = loginBDD();
        //Création d'un tableau
        $tableauVol = "<table>
            <tr>
                <th>Numéro Vol</th>
                <th>Heure Départ</th>
                <th>Heure Arrivée</th>
                <th>Etat</th>
                <th>Numéro Porte</th>
                <th>Numéro Avion</th>
                <th>Numéro Compagnie</th>
            </tr>
        ";

        //Récupération de l'état voulu
        $etat = $_GET["choixEtat"];

        //Création de la requête et récupération du résultat
        $requete = "SELECT numVol, heureDepart, heureArrivee, libelStatut, idPorte, idAvion, idCompagnie FROM Vol V, Statut S WHERE V.idStatut = S.idStatut AND S.libelStatut = '$etat'";

        $resultat = mysqli_query($liaison, $requete);
        while($ligne = mysqli_fetch_assoc($resultat)){
            $tableauVol = $tableauVol . "<tr>";
            foreach($ligne as $donnees){
                $tableauVol = $tableauVol . "<td>" . $donnees . "</td>";
            }
            $tableauVol = $tableauVol . "</tr>";
        };
        $tableauVol = $tableauVol . "</table>";

        //Fermerture de la liaison
        mysqli_free_result($resultat);
        mysqli_close($liaison);
        
        return $tableauVol;
    }
?>