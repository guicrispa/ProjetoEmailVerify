<?php
session_start();
require "Authenticator.php";


$Authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
    $secret = $Authenticator->generateRandomSecret();
    $_SESSION['auth_secret'] = $secret;
}


$qrCodeUrl = $Authenticator->getQR('EVERSON', $_SESSION['auth_secret']);


if (!isset($_SESSION['failed'])) {
    $_SESSION['failed'] = false;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Autenticação</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #65ADE2, #BA83C0);
    transition: 0,5s;
}

.container {
    position: relative;
    width: 800px;
    height: 550px;
    margin: 20px;
    justify-content: center;
}

.whiteForm {
    position: absolute;
    top: 40px;
    padding: 30px;
    background: #fff;
    box-shadow: 0 5px 45px rgba(0,0,0,0.15);
}

.whiteForm .form {
    position: absolute;
    left: 0;
    width: 100%;
    padding: 50px;
    transition: 0.5s;
}

.whiteForm .form form {
    display: flex;
    flex-direction: column;
}


.whiteForm .form form h2 {
    margin-bottom: 20px;
    font-weight: 600;
}


.whiteForm .form form input {
    width: 100%;
    margin-bottom: 20px;
    padding: 10px;
    outline: none;
    font-size: 16px;
    border: 1px solid #333;
}
</style>

<link rel="stylesheet" href="css/main.css">

</head>
<body>
   
        
            <div class="container">
                <div class="form signin">
                
                <p class="titulo">Everson Vieira - Guilherme Crispim - Sabrina Galvão</p>
                <p>Tente novamente!</p>
              
                    <form action="check.php" method="post" class="whiteForm">
                        <div style="text-align: center;">
                            <?php if ($_SESSION['failed']): ?>
                                <?php   
                                    $_SESSION['failed'] = false;
                                ?>
                            <?php endif ?>
                                
                                <img src="<?php   echo $qrCodeUrl ?>" alt="Verify this Google Authenticator"><br><br>        
                                <input type="text" name="code" placeholder="Código"><br> <br>    
                                <button type="submit">Verificar</button>

                        </div>

                    </form>
                </div>
            </div>
        
    
</body>
</html>