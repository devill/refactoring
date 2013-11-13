<?php
/**
 * Created by JetBrains PhpStorm.
 * User: merklik
 * Date: 4/27/13
 * Time: 10:50 AM
 * To change this template use File | Settings | File Templates.
 */

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
            'totalCharge' => $this->getTotalCharge(),
            'totalFrequentRenterPoints' => $this->getTotalFrequentRenterPoints(),
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

    public function AsciiStatement()
    {
        $statement = new AsciiStatement();
        return $statement->render($this->getStatementData());
    }


    public function HTMLStatement()
    {
        $statement = new HtmlStatement();
        return $statement->render($this->getStatementData());
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



        