<?php 
/**
 * Compare the totalReaction's review
 *
 * @param Review $a, Review $b
 * @return (-1;1))
 */
function cmpTotalReaction($a, $b){
    if($a->totalReaction() < $b->totalReaction( )){
        return 1;
    }else{
        return -1;
    }
}

/**
 * Compare the totalReaction's review
 *
 * @param Review $a, Review $b
 * @return (-1;1)
 */
function cmpCreationDate($a, $b){
    if($a->creationDate() < $b->creationDate( )){
        return 1;
    }else{
        return -1;
    }
}