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

    function hero($id){
        $ch = curl_init('https://overwatch-api.net/api/v1/hero/' . $id);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result=curl_exec($ch);
		curl_close($ch);
        $result = json_decode($result);
		return $result;
    }

    function search(){
        $ch = curl_init('https://overwatch-api.net/api/v1/hero');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result=curl_exec($ch);
		curl_close($ch);
        $result = json_decode($result);
		return $result;
    }
?>