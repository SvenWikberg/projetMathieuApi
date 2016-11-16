<?php
////////////////Overwatch-APi
    function heroes(){
        $ch = curl_init('https://overwatch-api.net/api/v1/hero');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result=curl_exec($ch);
		curl_close($ch);
        $result = json_decode($result);
		return $result;
    }

    function events(){
        $ch = curl_init('https://overwatch-api.net/api/v1/event');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result=curl_exec($ch);
		curl_close($ch);
        $result = json_decode($result);
		return $result;
    }

    function abilities($page){
        $ch = curl_init('https://overwatch-api.net/api/v1/ability?page=' . $page);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result=curl_exec($ch);
		curl_close($ch);
        $result = json_decode($result);
		return $result;
    }

    function rewards($page){
        $ch = curl_init('https://overwatch-api.net/api/v1/rewards?page=' . $page);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result=curl_exec($ch);
		curl_close($ch);
        $result = json_decode($result);
		return $result;
    }

    function hero($id){
        $ch = curl_init('https://overwatch-api.net/api/v1/hero/' . $id);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result=curl_exec($ch);
		curl_close($ch);
        $result = json_decode($result);
		return $result;
    }
////////////////

////////////////Bdd local
    function &bddPdo() {
        $myPdo = null;

        try {
            if ($myPdo == null) {
                $myBdd = new PDO('mysql:host=127.0.0.1;dbname=overwatchcollection', 'wikbergs', '1234', array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_PERSISTENT => true));
                return $myBdd;
            }
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex;
        }
    }

    function sqlSelectEvents() {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM events')->fetchAll();
        return $reqArray;
    }

    function sqlSelectHeroes() {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM heroes')->fetchAll();
        return $reqArray;
    }

    function sqlSelectRewardTypes() {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM reward_types')->fetchAll();
        return $reqArray;
    }

    function sqlSelectQualities() {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM qualities')->fetchAll();
        return $reqArray;
    }

    function sqlSelectHeroById($id) {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM heroes WHERE id_hero = ' . $id)->fetchAll();
        return $reqArray;
    }

    function sqlSelectRoleById($id) {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM roles WHERE id_role = ' . $id)->fetchAll();
        return $reqArray;
    }

    function sqlSelectSubRolesByIdHero($id) {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT sub_roles.id_sub_role as id, sub_roles.name as name FROM sub_roles JOIN heroes_sub_roles ON heroes_sub_roles.id_sub_role = sub_roles.id_sub_role JOIN heroes ON heroes.id_hero = heroes_sub_roles.id_hero WHERE heroes.id_hero = ' . $id)->fetchAll();
        return $reqArray;
    }

    function sqlSelectAbilitiesByIdHero($id) {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM abilities WHERE id_hero = ' . $id)->fetchAll();
        return $reqArray;
    }

    function sqlSelectRewardsByIdHero($id) {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM rewards WHERE id_hero = ' . $id)->fetchAll();
        return $reqArray;
    }

    function sqlSelectPlayerIcons(){
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM rewards WHERE id_reward_type = 3 ORDER BY name ASC')->fetchAll();
        return $reqArray;
    }

    function sqlSelectSprays(){
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM rewards WHERE id_reward_type = 1 AND id_hero IS NULL ORDER BY name ASC')->fetchAll();
        return $reqArray;
    }

    function sqlSelectUserByUsername($user_name) {
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM users WHERE username = "' . $user_name . '"')->fetchAll();
        return $reqArray;
    }

    function sqlSelectIdRewardByIdUser($id){
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT * FROM users_rewards WHERE id_user = ' . $id)->fetchAll();
        return $reqArray;
    }

    function sqlInsertUser($user_name, $user_pwd, $email){
        $myPDO = bddPdo();
        $myPDO->query('INSERT INTO users VALUES (NULL, "' . $user_name . '", "' . $user_pwd . '", "' . $email . '")');
        $_SESSION['id_user'] = $myPDO->lastInsertId();
    }

    function sqlSelectRewardCountByIdUser($id){
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT COUNT(DISTINCT id_reward) FROM users_rewards WHERE id_user = ' . $id)->fetchAll();
        return $reqArray[0][0];
    }   

    function sqlSelectRewardCount(){
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT COUNT(DISTINCT id_reward) FROM rewards')->fetchAll();
        return $reqArray[0][0];
    } 

    function sqlSelectRewardCountByIdEvent($id){
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT COUNT(DISTINCT id_reward) FROM rewards WHERE id_event = ' . $id)->fetchAll();
        return $reqArray[0][0];
    }

    function sqlSelectRewardCountByIdEventIdUser($idEvent, $idUser){
        $myPDO = bddPdo();
        $reqArray = $myPDO->query('SELECT COUNT(DISTINCT rewards.id_reward) FROM rewards JOIN users_rewards ON rewards.id_reward = users_rewards.id_reward WHERE id_event = ' . $idEvent . ' AND id_user = ' . $idUser)->fetchAll();
        return $reqArray[0][0];
    }

    function sqlInsertUserReward($id_user, $id_reward){
        $myPDO = bddPdo();
        $myPDO->query('INSERT INTO users_rewards VALUES (' . $id_user . ', ' . $id_reward . ')');
    }
////////////////

    function print_rr($item) {
        echo '<pre>';
        print_r($item);
        echo '</pre>';
    }
?>