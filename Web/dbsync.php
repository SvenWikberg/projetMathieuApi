<?php
    include_once("functions.php");

    $myPDO = bddPdo();

////////////////Sync Heroes
    $heroes = heroes();

    $myPDO->query('TRUNCATE TABLE heroes');
    foreach($heroes->data as $hero_id){
        $hero = hero($hero_id->id);
        $height = (empty($hero->height))?'NULL':$hero->height;
        $affiliation = (empty($hero->affiliation))?'NULL':$hero->affiliation;
        $boo = (empty($hero->base_of_operations))?'NULL':$hero->base_of_operations;

        $myPDO->query('INSERT INTO heroes VALUES (' . $hero->id . ',"' . $hero->name . '",\'' . str_replace('\'', '\\\'', $hero->description) . '\',' . $hero->role->id . ',' . $hero->health . ',' . $hero->armour . ',' . $hero->shield . ',"' . $hero->real_name . '",' . $hero->age . ',' . $height . ',"' . $affiliation . '","' . $boo . '",' . $hero->difficulty . ')');
    } 
////////////////


////////////////Sync Abilities
    /*$myPDO->query('TRUNCATE TABLE abilities');
    for($i = 1; $i <= 3; $i++){
        $abilities = abilities($i);
        foreach($abilities->data as $ability){
                $is_ultimate = ($ability->is_ultimate == 'false')?'0':'1';
                $myPDO->query('INSERT INTO abilities VALUES (' . $ability->id . ',"' . $ability->name . '","' . $ability->description . '",' . $ability->hero->id . ',' . $is_ultimate .')');
        }
    }*/
////////////////


////////////////Sync Events
    /*$events = events();

    $myPDO->query('TRUNCATE TABLE events');
    foreach($events->data as $event){
                $myPDO->query('INSERT INTO events VALUES (' . $event->id . ',"' . $event->name . '","' . $event->start_date . '","' . $event->end_date . '")');
    }*/
////////////////

header('Location: admin.php');
?>