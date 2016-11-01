<?php
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

    function bddPdo() {
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
?>