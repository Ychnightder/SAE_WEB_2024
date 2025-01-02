    <?php
    session_start() ;
    $_SESSION['logged_in'] = false;
    $_SESSION['role'] = null;
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();

