<?php
    include_once("config.php");
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
                $myBdd = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USERNAME, PASSWORD, array(
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

        $req = $myPDO->prepare('SELECT * FROM events');
        $req->execute();
        return $req;
    }

    function sqlSelectEventById($id) {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM events WHERE id_event = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch();
    }

    function sqlSelectHeroes() {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM heroes');
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectRewardTypes() {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM reward_types');
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectQualities() {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM qualities');
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectHeroById($id) {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM heroes WHERE id_hero = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch();
    }

    function sqlSelectRoleById($id) {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM roles WHERE id_role = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectSubRolesByIdHero($id) {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT sub_roles.id_sub_role as id, sub_roles.name as name FROM sub_roles JOIN heroes_sub_roles ON heroes_sub_roles.id_sub_role = sub_roles.id_sub_role JOIN heroes ON heroes.id_hero = heroes_sub_roles.id_hero WHERE heroes.id_hero = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectAbilitiesByIdHero($id) {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM abilities WHERE id_hero = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectRewardsByIdHero($id) {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM rewards WHERE id_hero = :id ORDER BY name ASC');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectRewardsByIdEvent($id) {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM rewards WHERE id_event = :id ORDER BY name ASC');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function sqlSelectPlayerIcons(){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM rewards WHERE id_reward_type = 3 ORDER BY name ASC');
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectSprays(){
        $myPDO = bddPdo();
        $req = $myPDO->prepare('SELECT * FROM rewards WHERE id_reward_type = 1 AND id_hero IS NULL ORDER BY name ASC');
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectUserByUsername($user_name) {
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM users WHERE username = :user_name');
        $req->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $req->execute();
        return $req->fetchAll();
    }

    function sqlSelectIdRewardByIdUser($id){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT * FROM users_rewards WHERE id_user = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    function sqlInsertUser($user_name, $user_pwd, $email){
        $myPDO = bddPdo();

        $req = $myPDO->prepare("INSERT INTO users VALUES (NULL, :user_name, :user_pwd, :email);");
        $req->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $req->bindParam(':user_pwd', $user_pwd, PDO::PARAM_STR);
        $req->bindParam(':email', $email, PDO::PARAM_STR);
        $req->execute();

        $_SESSION['id_user'] = $myPDO->lastInsertId();
    }

    function sqlSelectRewardCountByIdUser($id){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT COUNT(DISTINCT id_reward) FROM users_rewards WHERE id_user = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll()[0][0];
    }   
///
    function sqlSelectRewardCount(){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT COUNT(DISTINCT id_reward) FROM rewards');
        $req->execute();
        return $req->fetchAll()[0][0];
    } 

    function sqlSelectRewardCountByIdEvent($id){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT COUNT(DISTINCT id_reward) FROM rewards WHERE id_event = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll()[0][0];
    }

    function sqlSelectRewardCountByIdEventIdUser($id_event, $id_user){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT COUNT(DISTINCT rewards.id_reward) FROM rewards JOIN users_rewards ON rewards.id_reward = users_rewards.id_reward WHERE id_event = :id_event AND id_user = :id_user');
        $req->bindParam(':id_event', $id_event, PDO::PARAM_INT);
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll()[0][0];
    }

    function sqlSelectRewardCountByIdHero($id){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT COUNT(DISTINCT id_reward) FROM rewards WHERE id_hero = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll()[0][0];
    }

    function sqlSelectRewardCountByIdHeroIdUser($id_event, $id_user){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT COUNT(DISTINCT rewards.id_reward) FROM rewards JOIN users_rewards ON rewards.id_reward = users_rewards.id_reward WHERE id_hero = :id_hero AND id_user = :id_user');
        $req->bindParam(':id_hero', $id_event, PDO::PARAM_INT);
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll()[0][0];
    }

    function sqlInsertUserReward($id_user, $id_reward){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('INSERT INTO users_rewards VALUES (:id_user, :id_reward)');
        $req->bindParam(':id_reward', $id_reward, PDO::PARAM_INT);
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();
    }

    function sqlSelectIdRewardByIdUserIdReward($id_user, $id_reward){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('SELECT id_reward FROM users_rewards WHERE id_user = :id_user AND id_reward = :id_reward');
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->bindParam(':id_reward', $id_reward, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }   

    function sqlDeleteUserRewardyIdUserIdReward($id_user, $id_reward){
        $myPDO = bddPdo();

        $req = $myPDO->prepare('DELETE FROM users_rewards WHERE id_user = :id_user AND id_reward = :id_reward');
        $req->bindParam(':id_reward', $id_reward, PDO::PARAM_INT);
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();
    }

    function sqlInsertBaseRewards($id_user){
        $myPDO = bddPdo();   

        $req = $myPDO->prepare('INSERT INTO users_rewards(id_user, id_reward) SELECT :id_user, id_reward FROM rewards WHERE name LIKE "Heroic" OR name LIKE "Classic"');
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();
    }

////////////////

    function print_rr($item) {
        echo '<pre>';
        print_r($item);
        echo '</pre>';
    }
?>