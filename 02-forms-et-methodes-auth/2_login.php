<?php

$user="c";
$pwd="p";


if ((isset($_POST["login"])) && (isset($_POST["password"]))) {

    if (($_POST["login"] == $user) && ($_POST["password"] == $pwd)) {
        echo ("OK");
    }
}

?>



 <form action="/2_login.php" method="post">
     <input type="text" name="login" value="" placeholder="Login"><br/>
     <input type="password" name="passwd" value="" placeholder="Password"><br/>
     <input type="submit" name="valider" value="Se connecter">
 </form>


<?php

//phpinfo();

 ?>
