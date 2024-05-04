<?php

require 'autoload.php';

use Adil\Poker\Table;
use Adil\Poker\Player;

$table = new Table();
for($i = 1; $i <= 4; $i++){
    $player = new Player($i);
    $table->addPlayer($player);
}
$table->distributeHand();
$table->distributeFlop();
$table->distributeTurn();
$table->distributeRiver();
$table->showDown();
// var_dump($table->getPlayers());
// var_dump($table->getFlop());
// var_dump($table->getTurn());
// var_dump($table->getRiver());