<?php 
session_start();
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time() && isset($_SESSION['login_id'])){
    $logid = $_SESSION['id'];
    $login_user_id = $_SESSION['login_id'];
    $_SESSION['time'] = time();
}else {
    header('Location: login.php');
}

// ログアウト処理
if(isset($_POST["out"]) || isset($_POST["out_x"])){
    $_SESSION = array();
    if(ini_get("session.use_cookies")){
        $params = session_get_cookie_params();
        setcookie(session_id(), '', time() - 3600, $params["path"],$params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();
    header('Location: login.php');
}
?>