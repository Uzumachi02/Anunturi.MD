<?php

class AnuntController {

    public function actionView ($id) {

        $content = "fullAnunt.php";
        $sideBar = "find.php";
        $photo = array();

        $anunt = Anunturi::getAnuntById ($id);
        if ($anunt) {
            Anunturi::addViewAnuntById($id);
            $sess = User::getUserSession('USER_LOGIN');
            $dostup = User::getUserGroup();

            if ($anunt['login'] == $sess or $dostup > 1) {
                $sideBar = "CPAnunt.php";
            }

            if (!empty($anunt['foto'])) {
                $photo = Anunturi::getAllPhoto($anunt['foto']);
            }

            $title = $anunt['title'] . TITL;
        } else {
            $title = 'Eroare' . TITL;
            $errorText = 'Anuntul nu exista.';
            $content = 'Error.php';
        }
        require_once(TPL . 'main.php');
        return true;
    }

    public function actionAdd () {

        $content = "addAnunt.php";
        $sideBar = "find.php";
        $title = 'Adaugarea anuntului' . TITL;
        $error = false;
        $dostup = User::getUserGroup();

        if ($dostup < 1) {
            $errorText = 'Nu aveti acces. Logativa sau inregistratica.';
            $content = 'Error.php';
        }

        if (isset($_POST['submit'])) {

            if ($dostup >= 1) {

                foreach ($_POST as $key => $value) {
                    if ($value == '') {
                        $error[] = '- Datele nu sunt depline!<br />';
                        break;
                    }
                }

                if (strlen($_POST['title']) < 12) {
                    $error[] = '- Denumirea este scurta!<br />';
                }

                if (strlen($_POST['desrc']) < 12) {
                    $error[] = '- Descrierea este scurta!<br />';
                }

                if ($error == false) {
                    $phArray = Anunturi::photoToArray($_FILES);
                    $id = Anunturi::addAnunt($_POST, $phArray);

                    if ($id == 0) {
                        $error[] = '- Eroare la transmiterea datelor!<br />';
                    } else {
                        header("Location: /anunt/{$id}");
                    }
                }


            } else {
                $error[] = 'Nu aveti acces!';
            }
        }

        require_once(TPL . 'main.php');
        return true;
    }

    public function actionFind () {

        $content = "shortAnunt.php";
        $sideBar = "find.php";
        $title = 'Cautarea apartamentelor' . TITL;
        $h2text = 'Anunturile cautate';
        $errorText = 'Dupa criteriile alese, anunturi nu sunt.';

        foreach ( $_GET as $key => $value ) {
            $value = htmlspecialchars(trim($value), ENT_QUOTES);
        }

        $ultimeleAnunturi = Anunturi::getFindAnunt($_GET);

        require_once(TPL . 'main.php');
        return true;
    }

    public function actionEdit($param) {
        $content = "editAnunt.php";
        $sideBar = "find.php";
        $title = 'Redactarea anuntului: '. $param . TITL;


        $anunt = Anunturi::getAnuntForEditById ($param);
        if ($anunt) {
            $dostup = User::getUserGroup();
            $sess = User::getUserSession('USER_ID');

            if ($anunt['id_user'] != $sess and $dostup < 2) {
                $errorText = 'Nu aveti acces.';
                $content = 'Error.php';
            }

            if (!empty($anunt['foto'])) {
                $photo = Anunturi::getAllPhoto($anunt['foto']);
            }
        } else {
            $title = 'Eroare' . TITL;
            $errorText = 'Anuntul nu exista.';
            $content = 'Error.php';
        }

        require_once(TPL . 'main.php');
        return true;
    }

    public function actionSaveEditAjax($param) {

        if ($param != $_POST['id']) {
            echo '["1", "Eroare!"]';
            return true;
        }

        $dostup = User::getUserGroup();
        $id_user = Anunturi::getAnuntIdUser($param);
        $id_user = $id_user['id_user'];

        if ($id_user != $_POST['id_user']) {
            echo '["1", "Eroare la validarea datelor!"]';
            return true;
        }

        if ( $id_user != $_SESSION['USER_ID'] ) {
            if ($dostup < 2) {
                echo '["1", "Nu sunteti stapinul anuntului!"]';
                return true;
            }
        }

        foreach ( $_POST as $key => $value ) {
            if ($value == '') {
                echo '["1", "Nu ati introdus toate datele!"]';
                return true;
            }
        }

        if (strlen($_POST['title']) < 12) {
            echo '["1", "Denumirea este scurta!"]';
            return true;
        }

        if (strlen($_POST['desrc']) < 12) {
            echo '["1", "Descrierea este scurta!"]';
            return true;
        }

        if (Anunturi::editAnunt($_POST, $param)) {
            echo '["0", "Anuntul a fost redactat."]';
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

        $anunt = Anunturi::getPhotoForDelete($param);
        if (!empty($anunt['foto'])) {
            $uploads_dir = ROOT_DIR . '/uploads/';
            $photo = Anunturi::getAllPhoto($anunt['foto']);

            foreach ($photo as $val) {
                $delFile = $uploads_dir . $val;
                if (file_exists($delFile)) {
                    unlink($delFile);
                }
            }
        }

        if (Anunturi::removeAnunt($param)) {
            echo '["0", "Anuntul cu Id = '.$param.' a fost sters."]';
            return true;
        }

        echo '["1", "Eroare la stergere!"]';
        return true;
    }
}