<?php

class ProfileController {

    public function actionIndex() {

        $content = "profile.php";
        $sideBar = "find.php";
        echo 'Profile';


        require_once(TPL . 'main.php');
        return true;
    }

    public function actionView($param) {

        $content = "profile.php";
        $sideBar = "find.php";

        if (!empty($param)) {
            $param = htmlspecialchars(trim($param), ENT_QUOTES);
            $dostup = User::getUserGroup();
            $sess = User::getUserSession('USER_LOGIN');

            $user = User::getUserByLogin($param);
            if ($user) {
                $news_user = Anunturi::getAddAnuntByIdUser($user['id']);
                $title = $user['nume'] . TITL;
            } else {
                $title = 'Eroare' . TITL;
                $errorText = 'Utilizatorul nu exista.';
                $content = 'Error.php';
            }


        } else {
            $title = 'Eroare' . TITL;
            $errorText = 'Nui introdus utilizatorul.';
            $content = 'Error.php';
        }

        require_once(TPL . 'main.php');
        return true;
    }

    public function actionEdit($param) {

        $content = "editUser.php";
        $sideBar = "find.php";
        $title = 'Redactarea profilui: '. $param . TITL;

        $dostup = User::getUserGroup();
        $sess = User::getUserSession('USER_LOGIN');

        if ($param != $sess and $dostup < 2) {
            $errorText = 'Nu aveti acces.';
            $content = 'Error.php';
        } else {
            $user = User::getUserForEditByLogin($param);
            if (!$user) {
                $title = 'Eroare' . TITL;
                $errorText = 'Utilizatorul nu exista.';
                $content = 'Error.php';
            }
        }
        //echo 'EditUser ' . $param;

        require_once(TPL . 'main.php');
        return true;
    }

    public function actionSaveEditAjax ($param) {

        if ($param != $_POST['login']) {
            echo '["1", "Eroare!"]';
            return true;
        }

        $dostup = User::getUserGroup();

        if ($param != $_SESSION['USER_LOGIN']) {
            if ($dostup < 2) {
                echo '["1", "Nu puteti redacta alti utilizatori!"]';
                return true;
            }
        }

        if (!empty($_POST['nume']) and strlen($_POST['nume']) < 3) {
            echo '["1", "Numele este scurt"]';
            return true;
        }

        if (!empty($_POST['email']) and !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo '["1", "Emailu este introdus gresit"]';
            return true;
        }

        if (!empty($_POST['phone']) and strlen($_POST['phone']) < 8) {
            echo '["1", "Telefonul este scurt"]';
            return true;
        }

        $newPass = false;

        if ($dostup < 2) {

            if (!empty($_POST['thisPass'])) {

                $password = User::passwordEncode($param, $_POST['thisPass']);
                if (!User::checkAndGetUserData($param, $password)) {
                    echo '["1", "Parola curenta este gresita"]';
                    return true;
                } else if ((!empty($_POST['newPass']) or !empty($_POST['confNewPass'])) and
                    ($_POST['newPass'] == $_POST['confNewPass'])
                ) {
                    $newPass = User::passwordEncode($param, $_POST['newPass']);
                } else {
                    echo '["1", "Parolele nu coencid"]';
                    return true;
                }
            }
        } else {
            if ((!empty($_POST['newPass']) or !empty($_POST['confNewPass'])) and
                ($_POST['newPass'] == $_POST['confNewPass']) ) {
                $newPass = User::passwordEncode($param, $_POST['newPass']);
            } else {
                echo '["1", "Parolele nu coencid"]';
                return true;
            }
        }


        if (User::editProfile($_POST, $param, $newPass)) {
            echo '["0", "Profilul a fost redactat."]';
        } else {
            echo '["1", "Eroare la transmiterea datelor. Incercati mai tirziu."]';
        }

        return true;
    }

    public function actionRemoveAjax($param) {

        $dostup = User::getUserGroup();

        if ($dostup < 2) {
            echo '["1", "Nu aveti acces la comanda!"]';
            return true;
        }

        $idGroupUser = User::getUserGroupById($param);

        if ($dostup < 3 and $idGroupUser > 1) {
            echo '["1", "Nu puteti sterge acest utilizator!"]';
            return true;
        }

        if (User::removeUser($param)) {
            echo '["0", "Utilizatorul cu Id = '.$param.' a fost sters."]';
            return true;
        }

        echo '["1", "Eroare la '.$idGroupUser.' stergere!"]';
        return true;
    }
}