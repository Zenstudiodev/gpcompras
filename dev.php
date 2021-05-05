<!DOCTYPE html>
<html>
<head>
    <h1 align="center" ></h1>

</head>
<body>
<body background ="fond.jpg"> </body>
</br>
<p> <strong> Bienvenue sur votre site MARKET </strong> </p>

<form method= "post" >
    <!---   PRODUIT 1      -->
    <p> PRODUCTO 1 </p>

    </strong> nom :</strong>
    <input type="text" name="nom1" />

    </strong> prix:</strong>
    <input type="int" name="prix1" />

    <!---   PRODUIT 2     -->

    <p> PRODUCTO 2 </p>

    </strong> nom :</strong>
    <input type="text" name="nom2" />

    </strong> prix:</strong>
    <input type="text" name="prix2" />



    <!---   PRODUIT 3      -->

    <p> PRODUCTO 3 </p>

    </strong> nom :</strong>
    <input type="text" name="nom3"/>


    </strong> prix: </strong>
    <input type="text" name="prix3" />


    <!---   PRODUIT 4      -->

    <p> PRODUCTO 4 </p>

    </strong> nom :</strong>
    <input type="text" name="nom4" />

    </strong> prix:</strong>
    <input type="text" name="prix4" />

    <br/>
    <br/>

    <input type="submit" value = "Valider" />


</form>


isset ($_POST["Valider"]);
$prix1=$_POST['prix1'];
$nom1=$_POST['nom1'];

$prix2=$_POST['prix2'];
$nom2=$_POST['nom2'];

$prix3=$_POST['prix3'];
$nom3=$_POST['nom3'];

$prix4=$_POST['prix4'];
$nom4=$_POST['nom4'];

// LE PLUS CHER -->

if ($prix2<$prix1 && $prix3<$prix1 && $prix4<$prix1)
{
    echo " L'article le plus cher est : $nom1 à $prix1 € euro.";
}
elseif($prix1<$prix2 && $prix3<$prix2 && $prix4<$prix2)
{
    echo " L'article le plus cher est : $nom2 à $prix2 € euro.";
}
elseif($prix1<$prix3 && $prix2<$prix3 && $prix4<$prix3)
{
    echo " L'article le plus cher est : $nom3 à $prix3 € euro.";
}
elseif($prix1<$prix4 && $prix2<$prix4 && $prix3<$prix4)
{
    echo " L'article le plus cher est : $nom4 à $prix4 € euro.";
}
echo "<br/>";
// LE MOINS CHER

if ($prix2>$prix1 && $prix3>$prix1 && $prix4>$prix1)
{
    echo " L'article le moins cher est : $nom1 à $prix1 € euro.";
}
elseif($prix1>$prix2 && $prix3>$prix2 && $prix4>$prix2)
{
    echo " L'article le moins cher est : $nom2 à $prix2 € euro.";
}
elseif($prix1>$prix3 && $prix2>$prix3 && $prix4>$prix3)
{
    echo " L'article le moins cher est : $nom3 à $prix3 € euro.";
}
elseif($prix1>$prix4 && $prix2>$prix4 && $prix3>$prix4)
{
    echo " L'article le moins cher est : $nom4 à $prix4 € euro.";
}

?>

</body>
</html>
<!--CALCUL -->