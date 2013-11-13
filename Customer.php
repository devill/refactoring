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
    private $_name;

    /** @var Rental[] */
    private $_rentals = array();

    function __construct($name)
    {
        $this->_name = $name;
    }

    public function addRental(Rental $arg)
    {
        $this->_rentals[] = $arg;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function statement()
    {
        $result = "Rental Record for {$this->getName()}\n";

        foreach ($this->_rentals as $rental) {
            //show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $rental->getCharge() . "\n";
        }

        //add footer lines
        $result .= "Amount owed is {$this->getTotalCharge()}\n";
        $result .= "You earned {$this->getTotalFrequentRenterPoints()} frequent renter points";

        return $result;
    }


    public function statementHTML()
    {
        $result = "<HTML><BODY>Rental Record for {$this->getName()}<br/>";

        foreach ($this->_rentals as $rental) {
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
        foreach ($this->_rentals as $rental) {
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
        foreach ($this->_rentals as $rental) {
            $totalAmount += $rental->getCharge();
        }
        return $totalAmount;
    }

}



        