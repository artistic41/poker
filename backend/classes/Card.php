<?php

namespace Adil\Poker;

class Card{
    private $suit;
    private $value;

    function __construct($suit, $value){
        $this->suit = $suit;
        $this->value = $value;
    }

    function getSuit(){
        return $this->suit;
    }

    function getValue(){
        return $this->value;
    }
    function showCard(){
        return ['suit' => $this->suit, 'value' => $this->value];
    }
}