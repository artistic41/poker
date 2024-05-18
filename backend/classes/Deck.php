<?php

namespace Adil\Poker;

class Deck{
    private $cards;
    public static $SUITS = ['C', 'D', 'H', 'S'];
    public static $VALUES = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K', 'A'];
    function __construct(){
        foreach(self::$SUITS as $suit){
            foreach(self::$VALUES as $value){
                $card = new Card($suit, $value);
                $this->cards[] = $card;
            }
        }
    }
    function removeCard($search){
        foreach($this->cards as $key => $card){
            if($card->getSuit() === $search->getSuit() && $card->getValue() === $search->getValue()) unset($this->cards[$key]);
        }
    }
    function isEmpty(){
        return count($this->cards) === 0;
    }
    function containsCard(Card $search){
        foreach($this->cards as $card){
            if($card->getSuit() === $search->getSuit() && $card->getValue() === $search->getValue()) return true;
        }
        return false;
    }
    function getCard(){
        if($this->isEmpty()) throw new \Exception("Empty Deck!");
        //1. get random suit
        $randomSuit = self::$SUITS[array_rand(self::$SUITS)];
        //2. get random value
        $randomValue = self::$VALUES[array_rand(self::$VALUES)];
        //3. If the card is in the deck, deal the card
        $newCard = new Card($randomSuit, $randomValue);
        if($this->containsCard($newCard)) {
            $this->removeCard($newCard);
            return $newCard;
        }
        else{
            //4. If the card is not in the deck, repeat by calling getCard again
            return $this->getCard();
        }
    }
}