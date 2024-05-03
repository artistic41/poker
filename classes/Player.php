<?php

namespace Adil\Poker;

class Player{
    private $id;
    private Hand $hand;
    function __construct($id){
        $this-> id = $id;
    }
    function getId(){
        return $this->id;
    }
    function setHand(Hand $hand){
        $this->hand = $hand;
    }
    function getHand(){
        return $this->hand;
    }
}