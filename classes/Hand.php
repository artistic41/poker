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
        if($this->isStraightFlush()) return "Straight Flush - High " .  $this->getHighCard();
        if($this->isFourOfAKind()) return "Four of a Kind - High " .  $this->getHighCard();
        if($this->isFullHouse()) return $this->isFullHouse();
        if($this->isFlush()) return "Flush - High " .  $this->getHighCard();
        if($this->isStraight()) return "Straight - High " .  $this->getHighCard();
        if($this->isThreeOfAKind()) return "Three of a Kind - High " .  $this->getHighCard();
        if($this->isTwoPair()) return $this->isTwoPair() . "- High " .  $this->getHighCard();
        if($this->isOnePair()) return $this->isOnePair() . "- High " .  $this->getHighCard();
        return "High Card - High " .  $this->getHighCard();
    }
    function isStraightFlush(){
        if($this->isFlush() && $this->isStraight()){
            return true;
        }
        return false;
    }
    function isFourOfAKind(){
        $occurences = [];
        foreach($this->cards as $card){
            if(isset($occurences[$card->getValue()])) $occurences[$card->getValue()] ++;
            else $occurences[$card->getValue()] = 1;
        }
        if(in_array(4, $occurences)){
            $winningValue = array_search(4, $occurences);
            foreach($this->cards as $key => $card){
                if($card->getValue() !== $winningValue) unset($this->cards[$key]);
            }
            return true;
        }
        return false;
    }
    function isFullHouse(){
        $occurences = [];
        foreach($this->cards as $card){
            if(isset($occurences[$card->getValue()])) $occurences[$card->getValue()] ++;
            else $occurences[$card->getValue()] = 1;
        }
        if(in_array(2, $occurences) && in_array(3, $occurences)){
            $winningValues = [];
            foreach($occurences as $key => $occurence){
                if($occurence === 2) {
                    $winningValues[] = $key;
                    $lowCard = $key;
                }
                if($occurence === 3) {
                    $winningValues[] = $key;
                    $highCard = $key;
                }
            }
            foreach($this->cards as $key => $card){
                if(!in_array($card->getValue(), $winningValues)) unset($this->cards[$key]);
            }
            return "Full House $highCard full of $lowCard";
        }
        return false;
    }
    function isFlush(){
        $count = ['C' => 0, 'D' => 0, 'H' => 0, 'S' => 0];
        foreach($this->cards as $card){
            $count[$card->getSuit()] ++;
        }
        if(!empty(array_intersect($count, [5, 6, 7]))){
            //remove from the hand the cards of a different color than the flush
            $inter = array_values(array_intersect($count, [5, 6, 7]))[0];
            $color = array_search($inter, $count);
            foreach($this->cards as $key => $value){
                if($value->getSuit() !== $color) unset($this->cards[$key]);
            }
            return true;
        }
        return false;
    }
    function isStraight(){
        if(count($this->cards) < 5) return false;
        $values = [];
        foreach($this->cards as $card){
            $values[] = array_search($card->getValue(), Deck::$VALUES);
        }
        $values = array_unique($values);
        rsort($values);
        $straightValues = [];
        for($i = 0; $i <= count($values) - 5; $i++){
            if(
                $values[$i] - $values[$i + 1] === 1 
                && $values[$i + 1 ] - $values[$i + 2] === 1 
                && $values[$i + 2 ] - $values[$i + 3] === 1 
                && $values[$i + 3 ] - $values[$i + 4] === 1 
            ) {
                if(!in_array(Deck::$VALUES[$values[$i]], $straightValues)) $straightValues[] =  Deck::$VALUES[$values[$i]];
                if(!in_array(Deck::$VALUES[$values[$i + 1]], $straightValues)) $straightValues[] =  Deck::$VALUES[$values[$i + 1]];
                if(!in_array(Deck::$VALUES[$values[$i + 2]], $straightValues)) $straightValues[] =  Deck::$VALUES[$values[$i + 2]];
                if(!in_array(Deck::$VALUES[$values[$i + 3]], $straightValues)) $straightValues[] =  Deck::$VALUES[$values[$i + 3]];
                if(!in_array(Deck::$VALUES[$values[$i + 4]], $straightValues)) $straightValues[] =  Deck::$VALUES[$values[$i + 4]];
            }
        }
        if(count($straightValues) >= 5) {
            foreach($this->cards as $key => $card){
                if(!in_array($card->getValue(), $straightValues)) unset($this->cards[$key]);
            }
            return true;
        }
        return false;
    }
    function isThreeOfAKind(){
        $occurences = [];
        foreach($this->cards as $card){
            if(isset($occurences[$card->getValue()])) $occurences[$card->getValue()] ++;
            else $occurences[$card->getValue()] = 1;
        }
        if(in_array(3, $occurences)){
            $winningValues = [];
            foreach($occurences as $key => $occurence){
                if($occurence === 3) $winningValues[] = $key;
            }
            sort($winningValues);
            $winningValue = end($winningValues);
            foreach($this->cards as $key => $card){
                if($card->getValue() !== $winningValue) unset($this->cards[$key]);
            }
            return true;
        }
        return false;
    }
    function isTwoPair(){
        $occurences = [];
        foreach($this->cards as $card){
            if(isset($occurences[$card->getValue()])) $occurences[$card->getValue()] ++;
            else $occurences[$card->getValue()] = 1;
        }
        if(in_array(2, $occurences)){
            $winningValues = [];
            foreach($occurences as $key => $occurence){
                if($occurence === 2) $winningValues[] = $key;
            }
            if(count($winningValues) < 2) return false;
            sort($winningValues);
            $description = implode(" and ", $winningValues);
            return "Two Pair of $description";
        }
        return false;
    }
    function isOnePair(){
        $occurences = [];
        foreach($this->cards as $card){
            if(isset($occurences[$card->getValue()])) $occurences[$card->getValue()] ++;
            else $occurences[$card->getValue()] = 1;
        }
        if(in_array(2, $occurences)){
            foreach($occurences as $key => $occurence){
                if($occurence === 2) $winningValue = $key;
            }
            return "One Pair of $winningValue";
        }
        return false;
    }
}