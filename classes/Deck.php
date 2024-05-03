<?php

namespace Adil\Poker;

class Deck{
    private $cards;
    function __construct(){
        $suits = ['C', 'D', 'H', 'S'];
        $values = ['J', 'Q', 'K', 'A'];
        for($i = 2; $i <= 10; $i++){
            $values[] = $i;
        }
        foreach($suits as $suit){
            foreach($values as $value){
                $card = new Card($suit, $value);
                $this->cards[] = $card;
            }
        }
    }
    function retrieveCard($suit, $value){
        
    }
}