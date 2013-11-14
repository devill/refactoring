<?php

namespace Refactoring;

require_once("Statement/Ascii.php");
require_once("Statement/Html.php");


class Customer
{
    private $name;

    /** @var Rental[] */
    private $rentals = array();

    function __construct($name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $arg)
    {
        $this->rentals[] = $arg;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStatementData()
    {
        return array(
            'name' => $this->getName(),
            'charge' => $this->getTotalCharge(),
            'points' => $this->getTotalFrequentRenterPoints(),
            'rentals' => $this->getRentalsData()
        );
    }

    private function getRentalsData()
    {
        return array_map(function(Rental $rental) {
            return array(
                'title' => $rental->getMovie()->getTitle(),
                'charge' => $rental->getCharge()
            );
        }, $this->rentals);
    }

    /**
     * @return int
     */
    private function getTotalFrequentRenterPoints()
    {
        $frequentRenterPoints = 0;
        foreach ($this->rentals as $rental) {
            $frequentRenterPoints += $rental->getFrequentRenterPoints();
        }
        return $frequentRenterPoints;
    }

    /**
     * @return int
     */
    public function getTotalCharge()
    {
        $totalAmount = 0;
        foreach ($this->rentals as $rental) {
            $totalAmount += $rental->getCharge();
        }
        return $totalAmount;
    }


}



        