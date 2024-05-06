<?php

namespace Adil\Poker;

class Table{
    private $smallBlind;
    private $bigBlind;
    private $button;

    private Deck $deck;
    private $players;
    private $flop;
    private $turn;
    private $river;
    
    function __construct($smallBlind = 1, $bigBlind = 2){
        $this->smallBlind = $smallBlind;
        $this->bigBlind = $bigBlind;
        $this->button = 1;
        $this->deck = new Deck();
    }
    function getSmallBlind(){
        return $this->smallBlind;
    }
    function setSmallBlind($smallBlind){
        $this->smallBlind = $smallBlind;
    }
    function getBigBlind(){
        return $this->bigBlind;
    }
    function setBigBlind($bigBlind){
        $this->bigBlind = $bigBlind;
    }
    function getPlayers(){
        return $this->players;
    }
    function getNumberOfPlayers(){
        return count($this->players);
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
            //distribute a new hand to each player
            //FOR DEBUGGING PURPOSES
            if($player->getId() === 1){
                $card1 = new Card('S', '10');
                $card2 = new Card('D', 'K');
                $this->deck->removeCard($card1);
                $this->deck->removeCard($card2);
            }
            else{
                $card1 = $this->deck->getCard();
                $card2 = $this->deck->getCard();
            }
            $hand = new Hand([$card1, $card2]);
            $player->setHand($hand);
        }
    }
    function getFlop(){
        return $this->flop;
    }
    function distributeFlop(){
        //FOR DEUBUGGING PURPOSES
        $card1 = new Card('H', '10');
        $card2 = new Card('C', '10');
        $card3 = new Card('H', 'K');
        $this->deck->removeCard($card1);
        $this->deck->removeCard($card2);
        $this->deck->removeCard($card3);
        // $card1 = $this->deck->getCard();
        // $card2 = $this->deck->getCard();
        // $card3 = $this->deck->getCard();
        $flop = [$card1, $card2, $card3];
        $this->flop = $flop;
    }
    function getTurn(){
        return $this->turn;
    }
    function distributeTurn(){
        $card = $this->deck->getCard();
        $this->turn = $card;
    }
    function getRiver(){
        return $this->river;
    }
    function distributeRiver(){
        $card = $this->deck->getCard();
        $this->river = $card;
    }
    function moveButton(){
        $this->button ++;
    }
    function deckIsEmpty(){
        return $this->deck->isEmpty();
    }
    function showDown(){
        $communityCards = $this->flop;
        if($this->turn !== NULL) $communityCards[] = $this->turn;
        if($this->river !== NULL) $communityCards[] = $this->river;
        foreach($this->players as $player){
            $strength = $player->getHand()->evaluate($communityCards);
            var_dump($player->getHand()->showHand()); 
            var_dump($strength);
        }
        $this->moveButton();
    }
}