<?php

class UserController {

    public function actionRegisterAjax() {

        if (count($_POST) == 6) {
            //echo count($_POST);

            foreach ( $_POST as $key => $value ) {
                if ($value != '') {
                    $value = htmlspecialchars(trim($value), ENT_QUOTES);
                } else {
                    echo '["1", "Datele nu sunt depline!"]';
                    return true;
                }
            }
        } else {
            echo '["1", "Eroare!"]';
        }

        if (strlen($_POST['password']) >= 6) {
            if (!User::comparePassword($_POST)) {
                echo '["1", "Parolele nu coencid!"]';
                return true;
            }
        } else {
            echo '["1", "Parola ii scurta!"]';
            return true;
        }

        if (strlen($_POST['login']) >= 3) {
            if (User::checkFreeLogin($_POST['login'])) {
                echo '["1", "Login-ul este ocupat!"]';
                return true;
            }
        } else {
            echo '["1", "Login-u este scurt!"]';
            return true;
        }

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            if (User::checkFreeEmail($_POST['email'])) {
                echo '["1", "Email-ul este ocupat!"]';
                return true;
            }
        } else {
            echo '["1", "Email-u este introdus gresit!"]';
            return true;
        }

        if (!User::Registrare($_POST)) {
            echo '["0", "'.$_POST['login'].', sunteti inregistrat."]';
        } else {
            echo '["1", "Eroare la inregistrare. Incercati din nou!"]';
        }

        return true;
    }

    public function actionLoginAjax() {

        $log = '';

        if (!isset($_SESSION['USER_LOGIN']) && empty($_SESSION['USER_LOGIN'])) {
            if ((isset($_POST['login']) && empty($_POST['login'])) || (isset($_POST['password']) && empty($_POST['password']))) {
                $log = '["1", "Datele nu sunt depline!"]';
            } else {
                $login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES);
                $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES);

                $password = User::passwordEncode($login, $password);
                $check = User::checkAndGetUserData($login, $password);

                if ($check) {
                    User::Logare($check);
                    $log = '["0", "'.$_SESSION['USER_LOGIN'].', ati intrat cu succes."]';
                } else {
                    $log = '["1", "Loginul sau parola sunt incorecte!"]';
                }
            }
        } else {
            $log = '["1", "Dumneavoastra de-am sunteti logati"]';
        }

        if ($log != '') {
            echo $log;
        }

        return true;
    }

    public function actionLogoutAjax() {

        setcookie ('UZE_auth', '', time() - 3600, '/');
        session_unset();

        echo '["0", "Ati ieshit cu succes!"]';
        return true;
    }
}