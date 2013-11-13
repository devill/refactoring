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
        $rentals = $this->_rentals;

        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($rentals as $rental) {
            //show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $rental->getCharge() . "\n";
        }

        $frequentRenterPoints = $this->getTotalFrequentRenterPoints();

        $totalAmount = $this->getTotalCharge();

        //add footer lines
        $result .= "Amount owed is " . $totalAmount . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points";


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



        