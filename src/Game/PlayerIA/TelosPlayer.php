<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class TelosPlayers
 * @package Hackathon\PlayerIA
 * @author  TIMOTHÉ MALANDAIN
 * J'ai essayer d'analyser les coup les plus frequent de mes adversaires.
 * Si mon adversaire joue un coup plus que les autres et que ce coup est superieur
 * et que l'ecart entre ce coup et le 2eme plus haut est inferieur a 20% je joue le contre de ce coup.
 * sinon je joue le même coup.
 * Donc en resumé si il y a une très forte propabilité qu'un coup soit jouer je joue le contre,
 * c'est mitiger entre le coup le plus fréquent et le 2eme coup le plus fréquent, je joue l'égualité (le coup le plus fréquent)
 */
class TelosPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        $choices = $this->result->getStatsFor($this->opponentSide);

        $paperScore = $choices['paper'];
        $rockScore = $choices['rock'];
        $scissorsScore = $choices['scissors'];

        $choice = $this->result->getLastChoiceFor($this->opponentSide);
        if ($paperScore > max($rockScore, $scissorsScore))
        {
            $percent = $paperScore * 80 * 0.01;
            if (max($rockScore, $scissorsScore) < $percent)
                return parent::scissorsChoice();
            else {
                if ($rockScore > $scissorsScore){
                    return parent::paperChoice();
                }
                if ($scissorsScore > $rockScore){
                    return parent::paperChoice();
                }
            }
        }
        $percent = $rockScore * 80 * 0.01;
        if ($rockScore > max($paperScore, $scissorsScore))
        {
            if (max($paperScore, $scissorsScore) < $percent)
                return parent::paperChoice();
            else{
                if ($paperScore > $scissorsScore){
                    return parent::rockChoice();
                }
                if ($paperScore < $scissorsScore){
                    return parent::rockChoice();
                }
            }
        }
        $percent = $scissorsScore * 80 * 0.01;
        if ($scissorsScore > max($paperScore, $rockScore))
        {
            if (max($paperScore, $scissorsScore) < $percent)
                return parent::rockChoice();
            else {
                return parent::scissorsChoice();
            }
        }
/*
        if($choice == 'rock'){
            return parent::paperChoice();
        }
        if($choice == 'paper'){
            return parent::rockChoice();
        }
        if($choice == 'scissors'){
            return parent::paperChoice();
        }

*/


        return parent::rockChoice();

    }
};
