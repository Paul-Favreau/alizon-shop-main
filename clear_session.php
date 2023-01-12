<html>
    <?php
    # page qui tue ta session
    session_start();
    unset($_SESSION);
    echo 'Session cleared. Redirecting...'.PHP_EOL;
    session_destroy();
    header('Location: index.php');
    ?>
</html>