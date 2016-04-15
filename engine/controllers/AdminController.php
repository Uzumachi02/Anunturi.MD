<?php

class AdminController {

    public function actionIndex () {

        if (User::getUserGroup() < 2) {
            require_once(TPLADM . 'noAcces.php');
            return true;
        }

        $content = "stats.php";

        $title = 'Admin Panel' . TITL;
        $users = User::getCountUsers();
        $actAnunt = Anunturi::getActiveCountAnunt();
        $NoactAnunt = Anunturi::getNoActiveCountAnunt();
        $sumAnunt = $actAnunt + $NoactAnunt;
        $lastUsers = User::getLastUsers(5);
        $lastAnunt = Anunturi::getLastAnunt(5);

        require_once(TPLADM . 'main.php');
        return true;
    }

    public function actionAnunts () {

        if (User::getUserGroup() < 2) {
            require_once(TPLADM . 'noAcces.php');
            return true;
        }

        $content = "anunts.php";
        $title = 'Anunturile / AdminPanel' . TITL;
        $lastAnunt = Anunturi::getLastAnunt(20);

        require_once(TPLADM . 'main.php');
        return true;
    }

    public function actionUsers () {

        if (User::getUserGroup() < 2) {
            require_once(TPLADM . 'noAcces.php');
            return true;
        }

        $content = "users.php";
        $title = 'Utilizatorii / AdminPanel' . TITL;
        $lastUsers = User::getLastUsers(20);

        require_once(TPLADM . 'main.php');
        return true;
    }

}