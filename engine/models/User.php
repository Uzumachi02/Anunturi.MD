<?php

class User {

    /**
     * Logarea utilizatorului
     * @param type $login <p>Loginul utlizatorului</p>
     * @param type $password <p>Parola utlizatorului</p>
     * @return array <p>Masisul ca datele utilizatorului</p>
     */
    public static function checkAndGetUserData($login, $password) {

        $db = Db::getConnection();

        $sql = "SELECT `id`, `id_group`, `login`, `password`
                FROM `users`
                WHERE `login` = :login
                AND `password` = :password";

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function passwordEncode($login, $password) {

        return md5('Uzu*'.md5($password.'@#228Anunt').md5('lg%5'.$login.'WoT~'));
    }

    public static function Logare($var) {

        foreach ( $var as $key => $value ) {
            $_SESSION['USER_' . strtoupper($key)] = $value;
        }

        setcookie ('UZE_auth', $_SESSION['USER_PASSWORD'], strtotime('+15 days'), '/');

        return true;
    }

    public static function comparePassword($post) {

        if ($post['password'] == $post['password1']) {
            return true;
        }

        return false;
    }

    /**
     * Verificarea daca logicu este liber
     * @param type $login <p>Loginul spre verificate</p>
     * @return boolean <p>Efectuarea functiei</p>
     */
    public static function checkFreeLogin($login) {

        $db = Db::getConnection();

        $sql = "SELECT `login`
                FROM `users`
                WHERE `login` = :login";

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Verificarea daca email-u este liber
     * @param type $email <p>Email-u spre verificate</p>
     * @return boolean <p>Efectuarea functiei</p>
     */
    public static function checkFreeEmail($email) {

        $db = Db::getConnection();

        $sql = "SELECT `email`
                FROM `users`
                WHERE `email` = :email";

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Registra noului utilizator
     * @param type $post <p>Masicul cu datele fin forma</p>
     * @return boolean <p>Efectuarea functiei</p>
     */
    public static function Registrare($post) {

        $pass = self::passwordEncode($post['login'] ,$post['password']);

        $db = Db::getConnection();

        $sql = "INSERT INTO `users`
                VALUES ('', '1', :login, :pass, :name_user, :email, :phone, :timp )";

        $result = $db->prepare($sql);
        $result->bindParam(':login', $post['login'], PDO::PARAM_STR);
        $result->bindParam(':pass', $pass, PDO::PARAM_STR);
        $result->bindParam(':name_user', $post['name'], PDO::PARAM_STR);
        $result->bindParam(':email', $post['email'], PDO::PARAM_STR);
        $result->bindParam(':phone', $post['phone'], PDO::PARAM_STR);
        $result->bindParam(':timp', time(), PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function getUserGroup () {
        $res = 0;
        //echo isset($_SESSION['USER_ID_GROUP']);
        if (isset($_SESSION['USER_ID_GROUP']) && !empty($_SESSION['USER_ID_GROUP'])) {
            $res = $_SESSION['USER_ID_GROUP'];
        }

        return $res;
    }

    /**
     * Selectarea grupei utilizatorului
     * @param type $id <p>ID lui</p>
     * @return integer <p>ID Grupei lui</p>
     */
    public static function getUserGroupById($id) {

        $db = Db::getConnection();

        $sql = "SELECT `id_group`
                FROM `users`
                WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetchColumn();

    }

    public static function getDate($data, $form = 'd.m.Y') {

        return date($form, $data);
    }

    /**
     * Selectarea utilizatorului
     * @param type $param <p>Loginu utilizatorului</p>
     * @return array <p>Masivul cu date</p>
     */
    public static function getUserByLogin($param) {

        $db = Db::getConnection();

        $sql = "SELECT `a`.`id`, `a`.`login`, `b`.`denumire`, `a`.`nume`, `a`.`email`, `a`.`phone`, `a`.`reg_date`
                FROM `users` `a`
                INNER JOIN `users_group` `b` ON `a`.`id_group` = `b`.`id`
                WHERE `a`.`login` = :login";

        $result = $db->prepare($sql);
        $result->bindParam(':login', $param, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function getUserForEditByLogin($param) {

        $db = Db::getConnection();

        $sql = "SELECT *
                FROM `users`
                WHERE `login` = :login";

        $result = $db->prepare($sql);
        $result->bindParam(':login', $param, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Redactarea datelor unui utilizator
     * @param type $post <p>Masicul cu datele fin forma</p>
     * @param type $login <p>Loginul utilizatorului</p>
     * @param type $newPass [optional] <p>Parola noua</p>
     * @return boolean <p>Efectuarea functiei</p>
     */
    public static function editProfile($post, $login, $newPass = false) {

        $db = Db::getConnection();

        $sql = "UPDATE `users`
                SET `nume`= :nume, `email`= :email, `phone`= :phone";

        if ($newPass) {
            $sql = $sql . ", `password`= :newpass";
        }

        $sql = $sql . " WHERE `login` = :login";

        $result = $db->prepare($sql);
        $result->bindParam(':nume', $post['nume'], PDO::PARAM_STR);
        $result->bindParam(':email', $post['email'], PDO::PARAM_STR);
        $result->bindParam(':phone', $post['phone'], PDO::PARAM_INT);

        if ($newPass) {
            $result->bindParam(':newpass', $newPass, PDO::PARAM_STR);
        }

        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->execute();
    }

    /**
     * Selectarea numarului total de utilizati
     * @return integer <p>Numarul lor</p>
     */
    public static function getCountUsers() {

        $db = Db::getConnection();

        $sql = "SELECT COUNT(*)
                FROM `users`";

        $result = $db->query($sql);

        if ($result) {
            return $result->fetchColumn();
        }

        return 0;
    }

    /**
     * Selectarea ultimelor utilizatori
     * @param type $limit [optional] <p>Limita lor</p>
     * @return array <p>Masivul cu utilizatori</p>
     */
    public static function getLastUsers($limit = 5) {

        $db = Db::getConnection();

        $sql = "SELECT *
                FROM  `users`
                ORDER BY `id` DESC
                LIMIT :limit";

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);

         $result->execute();

        //return $result->fetchAll();
        $UsersList = array();
        foreach ($result->fetchAll() as $key => $value) {
            $UsersList[$key] = $value;
        }

        return $UsersList;
    }

    /**
     * Stergerea utilizatorului
     * @param type $id <p>Id utilizatorului</p>
     * @return boolean <p>Efectuarea functiei</p>
     */
    public static function removeUser($id) {

        $db = Db::getConnection();

        $sql = "DELETE
                FROM `users`
                WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->execute();
    }

    public static function getUserSession($param) {

        if (isset($_SESSION[$param]) && !empty($_SESSION[$param])) {
            return $_SESSION[$param];
        }

        return false;
    }
}