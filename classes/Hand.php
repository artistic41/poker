<?php

namespace Adil\Poker;

class Hand{
    private $cards;
    function __construct($cards){
        $this->cards = $cards;
    }
    function foldHand(){

    }
    function getCards(){
        return $this->cards;
    }
    function setCards($cards){
        $this->cards = $cards;
    }
    function showHand(){
        $json = "{";
        foreach($this->cards as $card) $json .= "{'suit':'" . $card->getSuit()."','value':'" . $card->getValue() . "'},";
        //remove the last comma
        $json = rtrim($json, ",");
        $json .= "}";
        return $json;
    }
    function getHighCard(){
        $allCardValues = [];
        foreach($this->cards as $card){
            $value = $card->getValue();
            $pos = array_search($value, Deck::$VALUES);
            if(isset($allCardValues[$pos])) $allCardValues[$pos][] = $value;
            else $allCardValues[$pos] = [$value];
        }
        $maxKey = max(array_keys($allCardValues));
        return Deck::$VALUES[$maxKey];
    }
    function evaluate($communityCards){
        $allCards = array_merge($this->cards, $communityCards);
        $this->setCards($allCards);
        var_dump($this->showHand()); 
        if($this->isStraightFlush()) return "Straight Flush - High " .  $this->getHighCard();
        // if($this->isFourOfAKind()) return "Four of a Kind - High " .  $this->getHighCard();
        // if($this->isFullHouse()) return "Full House - High " .  $this->getHighCard();
        // if($this->isFlush()) return "Flush - High " .  $this->getHighCard();
        // if($this->isStraight()) return "Straight - High " .  $this->getHighCard();
        // if($this->isThreeOfAKind()) return "Three of a Kind - High " .  $this->getHighCard();
        // if($this->isTwoPair()) return "Two Pair - High " .  $this->getHighCard();
        // if($this->isOnePair()) return "One Pair - High " .  $this->getHighCard();
        return "High Card - High " .  $this->getHighCard();
    }
    function isStraightFlush(){
        
    }
}