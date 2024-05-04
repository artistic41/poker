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
    function getHighCard($communityCards){
        $allCards = [$this->card1, $this->card2];
        $allCards = array_merge($allCards, $communityCards);
        $allCardValues = [];
        foreach($allCards as $card){
            $value = $card->getValue();
            $pos = array_search($value, Deck::$VALUES);
            if(isset($allCardValues[$pos])) $allCardValues[$pos][] = $value;
            else $allCardValues[$pos] = [$value];
        }
        $maxKey = max(array_keys($allCardValues));
        return Deck::$VALUES[$maxKey];
    }
    function evaluate($communityCards){
        $highCard = $this->getHighCard($communityCards);
        if($this->isStraightFlush()) return "Straight Flush - High $highCard";
    }
}