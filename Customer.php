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

    public function getStatementData()
    {
        return array(
            'name' => $this->getName(),
            'totalCharge' => $this->getTotalCharge(),
            'totalFrequentRenterPoints' => $this->getTotalFrequentRenterPoints(),
            'rentals' => $this->getRentalsData()
        );
    }

    private function getRentalsData()
    {
        return array_map(function($rental) {
            return array(
                'title' => $rental->getMovie()->getTitle(),
                'charge' => $rental->getCharge()
            );
        }, $this->rentals);
    }

    public function AsciiStatement()
    {
        $statement = $this->getStatementData();

        $result = "Rental Record for {$statement['name']}\n";

        foreach ($statement['rentals'] as $rental) {
            $result .= "\t{$rental['title']}\t{$rental['charge']}\n";
        }

        $result .= "Amount owed is {$statement['totalCharge']}\n";
        $result .= "You earned {$statement['totalFrequentRenterPoints']} frequent renter points";

        return $result;
    }


    public function HTMLStatement()
    {
        $statement = $this->getStatementData();

        $result = "<HTML><BODY>Rental Record for {$statement['name']}<br/>";

        foreach($statement['rentals'] as $rental) {
            $result .= "{$rental['title']}: {$rental['charge']}<br/>";
        }
        $result .= "Amount owed is {$statement['totalCharge']}<br/>";
        $result .= "You earned {$statement['totalFrequentRenterPoints']} frequent renter points</BODY></HTML>";

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



        