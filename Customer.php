<?php
/**
 * Created by JetBrains PhpStorm.
 * User: merklik
 * Date: 4/27/13
 * Time: 10:50 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Refactoring;


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

    public function AsciiStatement()
    {
        $result = "Rental Record for {$this->getName()}\n";

        foreach ($this->rentals as $rental) {
            //show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $rental->getCharge() . "\n";
        }

        //add footer lines
        $result .= "Amount owed is {$this->getTotalCharge()}\n";
        $result .= "You earned {$this->getTotalFrequentRenterPoints()} frequent renter points";

        return $result;
    }


    public function HTMLStatement()
    {
        $result = "<HTML><BODY>Rental Record for {$this->getName()}<br/>";

        foreach ($this->rentals as $rental) {
            $result .= "{$rental->getMovie()->getTitle()}: {$rental->getCharge()}<br/>";
        }
        $result .= "Amount owed is {$this->getTotalCharge()}<br/>";
        $result .= "You earned {$this->getTotalFrequentRenterPoints()} frequent renter points</BODY></HTML>";

        return $result;
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



        