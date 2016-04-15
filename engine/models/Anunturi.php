<?php

class Anunturi {

    const SHOW_BY_DEFAULT = 6;

    /**
     * Selectam ultimele anunturi
     * @param type $count [optional] <p>Numarul de extragere</p>
     * @return array <p>Masivul cu anunturi</p>
     */
    public static function getUltimeleAnunturi ($count = self::SHOW_BY_DEFAULT) {

        // Conectarea cu BD
        $db = Db::getConnection();

        // Descrierea Selectului
        $sql = "SELECT `id`, `title`, `descriere`, `pret`, `add_data`, `foto`
                FROM `anunt`
                WHERE `valabil` = 1
                ORDER BY `id`
                DESC LIMIT :count";

        // Pregatim pentru executarea Selectu
        $result = $db->prepare($sql);
        // Inlocuim in Select variabila :count
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Executam apelul
        $result->execute();

        $i = 0;
        $AnunturiList = array();
        while ($row = $result->fetch()) {
            $AnunturiList[$i]['id'] = $row['id'];
            $AnunturiList[$i]['title'] = $row['title'];
            $AnunturiList[$i]['descriere'] = $row['descriere'];
            $AnunturiList[$i]['pret'] = $row['pret'];
            $AnunturiList[$i]['add_data'] = $row['add_data'];
            $AnunturiList[$i]['foto'] = self::getPrimaPoza($row['foto']);
            $i++;
        }

        return $AnunturiList;
    }

    /**
     * Selectam anuntul dupa ID
     * @param type $id <p>Id anuntului</p>
     * @return array <p>Masivul cu anunt</p>
     */
    public static function getAnuntById($id) {

        $db = Db::getConnection();

        $sql = "SELECT `b`.`login`, `b`.`nume`, `b`.`email`, `b`.`phone`, `c`.`name_loc`, `a`.*
                FROM `anunt` `a`
                INNER JOIN `users` `b` ON `a`.`id_user` = `b`.`id`
                INNER JOIN `localitare` `c` ON `a`.`id_loc` = `c`.`id`
                WHERE `a`.`id` = :id
                LIMIT 1";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Selectam toate anunturile unui utilizator
     * @param type $id <p>Id utilizatorului</p>
     * @return array <p>Masivul cu anunturi</p>
     */
    public static function getAddAnuntByIdUser ($id) {

        $db = Db::getConnection();

        $sql = "SELECT `id`, `title`, `add_data`
                FROM `anunt`
                WHERE `id_user` = :id
                ORDER BY `add_data`
                DESC ";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $i = 0;
        $AnunturiList = array();
        while ($row = $result->fetch()) {
            $AnunturiList[$i]['id'] = $row['id'];
            $AnunturiList[$i]['title'] = $row['title'];
            $AnunturiList[$i]['add_data'] = $row['add_data'];
            $i++;
        }

        return $AnunturiList;
    }

    /**
     * Adaugarea anuntului
     * @param type $post <p>Masivul cu datele din forma</p>
     * @param type $phArray <p>Masivul cu id fotografiilor</p>
     * @return integer <p>Id anuntului adaugat</p>
     */
    public static function addAnunt($post, $phArray) {

        $db = Db::getConnection();

        $sql = "INSERT INTO `anunt`
                VALUES ('', :user_id, :location, :categor, :title, :descr,
                        :nrcam, :starea, :marimea, :pret, :dat_add,
                        '0', :photo, '1'
                        )
                ";

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $_SESSION['USER_ID'], PDO::PARAM_INT);
        $result->bindParam(':location', $post['location'], PDO::PARAM_INT);
        $result->bindParam(':categor', $post['categor'], PDO::PARAM_INT);
        $result->bindParam(':title', $post['title'], PDO::PARAM_STR);
        $result->bindParam(':descr', $post['desrc'], PDO::PARAM_STR);
        $result->bindParam(':nrcam', $post['nrcam'], PDO::PARAM_INT);
        $result->bindParam(':starea', $post['starea'], PDO::PARAM_INT);
        $result->bindParam(':marimea', $post['marimea'], PDO::PARAM_INT);
        $result->bindParam(':pret', $post['pret'], PDO::PARAM_INT);
        $result->bindParam(':dat_add', time(), PDO::PARAM_INT);
        $result->bindParam(':photo', $phArray, PDO::PARAM_STR);

        if ($result->execute()) {
            return $db->lastInsertId();
        }

        return 0;
    }

    public static function getPrimaPoza ($row_photo) {
        if (!empty($row_photo)) {
            $photo = explode ('::', $row_photo);
            $photo = $photo[0];
            return 'uploads/'.$photo;
        } else return 'uploads/noPhoto.png';
    }

    public static function getAllPhoto ($photo) {
        $res = array();
        $res = explode ('::', $photo);
        return $res;
    }

    public static function getCategoriaText($categor) {
        $cat = '';
        switch ($categor) {
            case 1: $cat = "Vinzare"; break;
            case 2: $cat = "Schimbare"; break;
            case 3: $cat = "Chirie"; break;
        }

        return $cat;
    }

    public static function getStareaText($starea) {
        $str = '';
        switch ($starea) {
            case 1: $str = "Euro reparatie"; break;
            case 2: $str = "Necesita reparatie"; break;
            case 3: $str = "Buna"; break;
        }

        return $str;
    }

    public static function getDate($data, $form = 'd.m.Y') {

        return date($form, $data);
    }

    public static function photoToArray($files) {

        $photo = array();
        $uploads_dir = ROOT_DIR . '/uploads';

        foreach($files['phFile']['name'] as $k => $f) {
            if (!$files['phFile']['error'][$k]) {
                list ($sec, $micro_sec) = explode ('.', microtime(true));

                $tmp_name = $files["phFile"]["tmp_name"][$k];
                $temp = explode('.', $files["phFile"]["name"][$k]);
                $name = $sec.$micro_sec.'.'.end($temp);

                if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
                    $photo[] = $sec.$micro_sec.'.'.end($temp);
                    //echo '<br />Файл успешно загружен.<br />';
                } //else echo '<br />Ошибка переноса файла';
            } //else echo '<br />Ошибка '. $files['usfile']['error'][$k];
            usleep(100);
        }

        return implode('::', $photo);
    }

    /**
     * Selectam anunturilor dupa anumite criterii
     * @param type $get <p>Masivul ca parametri</p>
     * @return array <p>Masivul cu anunturi</p>
     */
    public static function getFindAnunt($get) {

        $db = Db::getConnection();

        // Descrierea initiala a Selectului
        $sql = "SELECT `id`, `title`, `descriere`, `pret`, `foto`, `add_data` FROM `anunt` WHERE ";

        // Adaugarea la Where conditii, daca ele exista
        foreach ( $get as $key => $value ) {
            if ($value != '' and $key != 'p_dela' and $key != 'p_pin' and $key != 'm_dela' and $key != 'm_pin') {
                $sql = $sql . "`{$key}` = '{$value}' AND ";
            }
        }

        // Adaugarea conditiilor cu parametri de comparare
        if (!empty($get['p_dela']) && !empty($get['p_pin'])) {
            $sql = $sql . " `pret` BETWEEN '{$get['p_dela']}' AND '{$get['p_pin']}' AND ";

        } else if (!empty($get['p_dela']) && empty($get['p_pin'])) {
            $sql = $sql . " `pret` > '{$get['p_dela']}' AND ";

        } else if (empty($get['p_dela']) && !empty($get['p_pin'])) {
            $sql = $sql . " `pret` < '{$get['p_pin']}' AND ";

        }

        if (!empty($get['m_dela']) && !empty($get['m_pin'])) {
            $sql = $sql . " `marimea` BETWEEN '{$get['m_dela']}' AND '{$get['m_pin']}' AND ";

        } else if (!empty($get['m_dela']) && empty($get['m_pin'])) {
            $sql = $sql . " `marimea` > '{$get['m_dela']}' AND ";

        } else if (empty($get['m_dela']) && !empty($get['m_pin'])) {
            $sql = $sql . " `marimea` < '{$get['m_pin']}' AND ";

        }

        $sql .= " `valabil` = '1' ORDER BY `id` DESC";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        $AnunturiList = array();
        while ($row = $result->fetch()) {
            $AnunturiList[$i]['id'] = $row['id'];
            $AnunturiList[$i]['title'] = $row['title'];
            $AnunturiList[$i]['descriere'] = $row['descriere'];
            $AnunturiList[$i]['pret'] = $row['pret'];
            $AnunturiList[$i]['add_data'] = $row['add_data'];
            $AnunturiList[$i]['foto'] = self::getPrimaPoza($row['foto']);
            $i++;
        }

        return $AnunturiList;
    }

    /**
     * Selectam datele anuntului pentru redactare
     * @param type $id <p>Id anuntului</p>
     * @return array <p>Masivul cu date</p>
     */
    public static function getAnuntForEditById($id) {

        $db = Db::getConnection();

        $sql = "SELECT *
                FROM `anunt`
                WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function getAnuntIdUser($id) {

        $db = Db::getConnection();

        $sql = "SELECT `id_user`
                FROM `anunt`
                WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Redactarea datelor anuntului
     * @param type $post <p>Masivul da date</p>
     * @param type $id <p>Id anuntului</p>
     * @return boolean <p>Efectuarea functiei</p>
     */
    public static function editAnunt($post, $id) {

        $valabil = 1;

        if (!isset($post['valb'])) {
            $valabil = 0;
        }

        $db = Db::getConnection();

        $sql = "UPDATE `anunt`
                SET `id_loc` = :loc, `categorie` = :catg, `title` = :title,
                  `descriere` = :descr, `nr_cam` = :nr_cam, `starea` = :starea,
                  `marimea` = :marimea, `pret` = :pret, `valabil` = :valb
                WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->bindParam(':loc', $post['location'], PDO::PARAM_INT);
        $result->bindParam(':catg', $post['categor'], PDO::PARAM_INT);
        $result->bindParam(':title', $post['title'], PDO::PARAM_STR);

        $result->bindParam(':descr', $post['desrc'], PDO::PARAM_STR);
        $result->bindParam(':nr_cam', $post['nrcam'], PDO::PARAM_INT);
        $result->bindParam(':starea', $post['starea'], PDO::PARAM_INT);

        $result->bindParam(':marimea', $post['marimea'], PDO::PARAM_INT);
        $result->bindParam(':pret', $post['pret'], PDO::PARAM_INT);
        $result->bindParam(':valb', $valabil, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->execute();
    }

    /**
     * Selectarea numarului total de anuturi valabile
     * @return integer <p>Numarul lor</p>
     */
    public static function getActiveCountAnunt() {

        $db = Db::getConnection();

        $sql = "SELECT COUNT(*)
                FROM `anunt`
                WHERE  `valabil` = '1'";

        $result = $db->query($sql);

        if ($result) {
            return $result->fetchColumn();
        }

        return 0;
    }

    /**
     * Selectarea numarului total de anuturi nevalabile
     * @return integer <p>Numarul lor</p>
     */
    public static function getNoActiveCountAnunt() {

        $db = Db::getConnection();

        $sql = "SELECT COUNT(*)
                FROM `anunt`
                WHERE  `valabil` = '0'";

        $result = $db->query($sql);

        if ($result) {
            return $result->fetchColumn();
        }

        return 0;
    }

    /**
     * Selectarea ultimelor anunturi
     * @param type $limit [optional] <p>Limita lor</p>
     * @return array <p>Masivul cu anunturi</p>
     */
    public static function getLastAnunt($limit = 5) {

        $db = Db::getConnection();

        $sql = "SELECT `a`.*, `b`.`login`
                FROM  `anunt` `a`
                INNER JOIN `users` `b` ON `a`.`id_user` = `b`.`id`
                ORDER BY `id` DESC
                LIMIT :limit";

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $AnuntList = array();
        foreach ($result->fetchAll() as $key => $value) {
            $AnuntList[$key] = $value;
        }

        return $AnuntList;
    }

    public static function getLocText($id_loc) {

        $db = Db::getConnection();

        $sql = "SELECT `name_loc`
                FROM `localitare`
                WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id_loc, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetchColumn();
    }

    /**
     * Stergerea anuntului
     * @param type $id <p>Id anuntului</p>
     * @return boolean <p>Efectuarea functiei</p>
     */
    public static function removeAnunt($id) {

        $db = Db::getConnection();

        $sql = "DELETE
                FROM `anunt`
                WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->execute();
    }

    public static function addViewAnuntById($id) {

        $db = Db::getConnection();

        $sql = "UPDATE `anunt`
                SET  `vizionari` =  `vizionari` + 1
                WHERE  `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->execute();
    }

    public static function getPhotoForDelete($id) {

        $db = Db::getConnection();

        $sql = "SELECT `foto`
                FROM `anunt`
                WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }
}