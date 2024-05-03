<?php

namespace Adil\Poker;

class Hand{
    private $card1;
    private $card2;
    function __construct(Card $card1, Card $card2){
        $this->card1 = $card1;
        $this->card2 = $card2;
    }
    function foldHand(){

    }
    function showHand(){
        return [$this->card1->showCard(), $this->card2->showCard()];
    }
}