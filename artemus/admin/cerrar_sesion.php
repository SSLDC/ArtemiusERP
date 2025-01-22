<?php
session_start();

// Destruir todos los datos de la sesión
$_SESSION = array();

// Si se desea destruir la sesión completamente, también se borra la cookie de sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();

// Redirigir a la página principal o de login
header("Location: ../main.html");
exit();
?>
