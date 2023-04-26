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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="styleSignup.css">
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body id="bodyPHP">
     <section class="vh-100 bg-image">
        <div class="d-flex align-items-center h-100" id="class1">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" id="cardSection">
                            <div class="card-body p-5">
                                <img class="img-fluid ms-5" src="../ImmaginiLogoLTW/logoSenzaScritta.svg" width="100px" alt="logoImage">
                                <img class="img-fluid ms-4" src="../ImmaginiLogoLTW/scrittaLogoNera.png" width="250px" alt="logoImage">
                                <h1 class="text-center">Registrati</h1>
                                <h5 class="text-center my-3 opacity-75">Crea un account per accedere al nostro sito</h5>
                                <form action="signup.php" class="form-signin m-auto"  method="POST" name="myForm" onsubmit="return functionSignup();">
                                <!----------FORM---------->
                                    <div class="form-outline mb-4">
                                        <!--name-->
                                        <label for="name" class="form-label fw-semibold">Nome</label>
                                        <div class="mb-4 input-group">
                                            <span class="input-group-text" id="inputGroupPrepend">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                                </svg></i></span>
                                            <input type="text" class="form-control" name="inputName" id="idInputName" maxlength="40" required autofocus>
                                        </div>
                                    </div>

                                    <!--<div class="form-outline mb-4">
                                        surname
                                        <label for="surname" class="form-label fw-semibold">Cognome</label>
                                        <input type="text" class="form-control" name="inputSurname" id="idInputSurname" required>
                                    </div>-->

                                    <div class="form-outline mb-4">
                                        <!--email-->
                                        <label for="email" class="form-label  fw-semibold">Email</label>
                                        <div class="mb-4 input-group">
                                            <span class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                              </svg></span>
                                            <input type="email" class="form-control" name="inputEmail" id="idInputEmail" maxlength="40" required>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <!--password-->
                                        <label for="pswd" class="form-label  fw-semibold">Password</label>
                                        <div class="mb-4 input-group">
                                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                              </svg></span>
                                            <input type="password" class="form-control" name="inputPswd" id="idInputPswd" maxlength="32" required>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <!--checkbox-->
                                        <input type="checkbox" class="form-check-input me-2" name="inputCheckBox" id="idInputCheckbox" required>
                                        <label class="form-check-label" for="checkbox">
                                            Accetto i <span class="text-decoration-underline">Termini di servizio</span>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <!--button-->
                                        <button type="submit" class="btn btn-lg text-body" id="buttonSpecial">Registrati</button>
                                    </div>

                                    <?php
        if ($dbconn) {
            $email = $_POST["inputEmail"];
            $q1="SELECT * FROM utente WHERE email= $1";
            $result=pg_query_params($dbconn, $q1, array($email));
            if ($tuple=pg_fetch_array($result, null, PGSQL_ASSOC)) {
                echo    "<p class=\"text-center text-danger fw-bold mt-2\"> Spiacente, l'indirizzo email è già associato ad un account</p>";
                $nome = $_POST["inputName"];
                $pswd = $_POST["inputPswd"];
                $q2 = "insert into utente values ($1,$2,$3)";
                $data = pg_query_params($dbconn, $q2, array($nome, $email, $pswd,));
                if ($data) {
                    header("location: indexLogin.php");
                }
            }
         }
     ?>

                                    <p class="text-center text-muted mt-2 mb-0">Hai già un account? <a href="../login/indexLogin.html" class="fw-bold">Accedi qui</a></p>
                                <!----------FORM---------->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/bootstrap.bundle.js"></script>
</body>
</html>