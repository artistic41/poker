<?php

namespace Adil\Poker;

class Table{
    private $smallBlind;
    private $bigBlind;
    private $button;

    private Deck $deck;
    private $players;
    private $community;
    
    function __construct($smallBlind = 1, $bigBlind = 2){
        $this->smallBlind = $smallBlind;
        $this->bigBlind = $bigBlind;
        $this->button = 1;
        $this->deck = new Deck();
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

    function moveButton(){
        $this->button ++;
    }

    function deckIsEmpty(){
        return $this->deck->isEmpty();
    }

    function distributeHand(){
        foreach($this->players as $player){
            //distribute a new hand to each player
            $card1 = $this->deck->getCard();
            $card2 = $this->deck->getCard();
            $hand = new Hand($card1, $card2);
            $player->setHand($hand);
        }
    }

    function distributeFlop(){

    }

    function distributeTurn(){
        
    }

    function distributeRiver(){
        
    }

    function showDown(){
        $this->moveButton();
    }
}