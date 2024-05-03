<?php
/**
* @Author: Adil EL Boruichi
*/
$mapping = array(
	"Adil\Poker\Card" => __DIR__ . "/classes/Card.php",
	"Adil\Poker\Deal" => __DIR__ . "/classes/Deal.php",
	"Adil\Poker\Deck" => __DIR__ . "/classes/Deck.php",
	"Adil\Poker\Hand" => __DIR__ . "/classes/Hand.php",
	"Adil\Poker\Player" => __DIR__ . "/classes/Player.php",
	"Adil\Poker\Table" => __DIR__ . "/classes/Table.php",
);

spl_autoload_register(function ($class) use ($mapping) {
	if (isset($mapping[$class])) {
		require $mapping[$class];
	}
}, true);