<?php

namespace Adil\Poker;

class Table{
    private $smallBlind;
    private $bigBlind;
    private $players;
    function __construct($smallBlind = 1, $bigBlind = 2){
        $this->smallBlind = $smallBlind;
        $this->bigBlind = $bigBlind;
    }
    function getSmallBlind(){
        return $this->smallBlind;
    }
    function getBigBlind(){
        return $this->bigBlind;
    }
    function getPlayers(){
        return $this->players;
    }
    function getNumberOfPlayers(){
        return count($this->players);
    }
    function setSmallBlind($smallBlind){
        $this->smallBlind = $smallBlind;
    }
    function setBigBlind($bigBlind){
        $this->bigBlind = $bigBlind;
    }
    function addPlayer(Player $player){
        $this->players[] = $player;
    }
    function removePlayer(Player $player){
        foreach($this->players as $key => $value){
            if($value->getId() === $player->getId()) unset($this->players[$key]);
        }
    }
    function distributeHand(){
        foreach($this->players as $player){
            //distribute hand to each player
        }
    }
    function distributeFlop(){

    }
    function distributeTurn(){
        
    }
    function distributeRiver(){
        
    }

    function showDown(){

    }
}