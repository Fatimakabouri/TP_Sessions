<?php
session_start();



?>
<html>
<head></head>
<body>

<form method="post" action="index.php">
Login : <input type="text" name="log" /><br />
Password : <input type="password" name="pass" /><br />
<input type="submit" value="Entrer" />
</form>
<?php
$connection=new PDO('mysql:host=localhost;dbname=mabase', 'root', '');
if (isset ($_POST['log'])){
$login = $_POST["log"];
$password = $_POST["pass"];

$query=$connection->query("SELECT * FROM user WHERE login='$login' AND password='$password'");
$row=$query->fetchAll(\PDO::FETCH_ASSOC);

if (!$row){

    $_SESSION["msg"] = "Votre login ou mot de passe est incorrect";
    ?>
    <h3 align="left"><?php echo $_SESSION["msg"]; ?></h3>
    <?php
    $a=0;

    } 
    else {
    // Ici l’utilisateur a fourni les bonnes informations
    $_SESSION["login"] = 1;
    $_SESSION["msg"] ="Bienvenu M. " . $row[0]['login'];
    ?>
        <h3 align="left"><?php echo $_SESSION["msg"]; ?></h3>
    
    <!-- <h3 align="left"><?php echo $_SESSION["msg"]; ?></h3> -->
    <?php
     echo "<div class='bienvenu'></div><h2>Ma page protégée</h2><a href='login.php?fer=1'>Logout</a>";
    }

    
}
if (isset ($_POST['fer'])){
    session_start();
session_destroy();

}
?>

</body>
</html>