<?php
require_once ('maSession.php');
$message = isset($_GET['message']) ? $_GET['message'] : "";
?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Erreur Message</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
<?php include("menu.php");
?>
        <div class="container">
            <div class="panel panel-danger margetop">
                <div class="panel-heading"><h4>Erreur suppression</h4></div>
                <div class="panel-body">
                    <h3><?php echo $message ?></h3>
                    <h4><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Retour >>></a></h4>
                </div>

            </div>
        </div>

    </body>
</html>