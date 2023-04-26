<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /");
}
else {
    $dbconn = pg_connect("host=localhost port=5432 dbname=EsameLTW user=postgres password=biar") 
    or die('Could not connect: ' . pg_last_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthyFridge</title>
    <meta name="author" content="Valario Solina 1935046, Francesco Rosa 1956680">
    <meta name="Esame pratico" content="Linguaggi e tecnologie del Web">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="styleSignup.css">
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body id="bodyPHP">
    <?php
        if ($dbconn) {
            $email = $_POST["inputEmail"];
            $q1="SELECT * FROM utente WHERE email= $1";
            $result=pg_query_params($dbconn, $q1, array($email));
            if ($tuple=pg_fetch_array($result, null, PGSQL_ASSOC)) {
                echo "<h1> Spiacente, l'indirizzo email è già associato ad un account. Se vuoi, <a href=/indexLogin.html> clicca qui per loggarti</a></h1>";
            } else {
                $nome = $_POST["inputName"];
                $pswd = $_POST["inputPswd"];
                $q2 = "insert into utente values ($1,$2,$3)";
                $data = pg_query_params($dbconn, $q2, array($nome, $email, $pswd,));
                if ($data) {
                    echo    "<div class=\"text-center my-5\">
                                <h1> Registrazione completata. Puoi iniziare a usare il sito <br/></h1>";
                    echo        "<a href=/indexLogin.html> Clicca qui </a>per loggarti!
                            </div>";
                }
            }
         }
     ?>
    <script src="/js/bootstrap.bundle.js"></script>
</body>
</html>