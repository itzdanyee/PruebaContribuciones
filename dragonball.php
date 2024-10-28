<?php
/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @version 5.2.1
 */

/**
 * Database `dragonball`
 */

/* `dragonball`.`characters` */
$characters = array(
  array('id' => '12','user_id' => '1','name' => 'Vegeta','race' => 'Saiyan','level' => '1','strength' => '50','speed' => '50','endurance' => '50','experience' => '0','avatar' => 'Saitama'),
  array('id' => '22','user_id' => '2','name' => 'Freezer','race' => 'Freezer Race','level' => '1','strength' => '50','speed' => '50','endurance' => '50','experience' => '0','avatar' => 'Jonathan Joestar')
);

/* `dragonball`.`character_transformations` */
$character_transformations = array(
  array('id' => '1222','character_id' => '22','transformation_id' => '222'),
  array('id' => '2222','character_id' => '12','transformation_id' => '122')
);

/* `dragonball`.`tournaments` */
$tournaments = array(
  array('id' => '12222','name' => 'El pentatlon','date' => '2024-10-14','winner_id' => '12'),
  array('id' => '22222','name' => 'Megatlon','date' => '2024-10-14','winner_id' => '22')
);

/* `dragonball`.`tournament_participants` */
$tournament_participants = array(
  array('id' => '122222','tournament_id' => '12222','character_id' => '22'),
  array('id' => '222222','tournament_id' => '22222','character_id' => '12')
);

/* `dragonball`.`transformations` */
$transformations = array(
  array('id' => '122','name' => 'Ultra Transformacion','level_required' => '100'),
  array('id' => '222','name' => 'Mega Transformacion','level_required' => '120')
);

/* `dragonball`.`users` */
$users = array(
  array('id' => '1','name' => 'Daniela','email' => 'danielamendoza@gmail.com','password' => 'DanielaM','avatar' => 'Saitama'),
  array('id' => '2','name' => 'Uriel','email' => 'urieldominyk@gmail.com','password' => 'UrielD','avatar' => 'Jonathan Joestar')
);
