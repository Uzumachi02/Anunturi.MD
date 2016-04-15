<?php

class SiteController {

    // Generarea paginii principale
    public function actionIndex () {

        // Stabelirea variabelilor
        $content = "shortAnunt.php";
        $sideBar = "find.php";
        $title = 'Pagina principala' . TITL;
        $h2text = 'Ultimele anunturi';
        $errorText = 'Anunturi nu sunt. Adaugati.';

        // Extragerea ultimelor anunturi
        $ultimeleAnunturi = Anunturi::getUltimeleAnunturi(5);

        // Afisarea pagini principale
        require_once(TPL . 'main.php');
        return true;
    }

    public function actionError () {
        $title = 'Error 404. Pagina nu exista' . TITL;
        require_once(TPLERROR . '404.php');
        return true;
    }
}