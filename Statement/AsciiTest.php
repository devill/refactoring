<?php

require_once("Ascii.php");
require_once("../Customer.php");
require_once("../Movie.php");
require_once("../Rental.php");

class AsciiTest extends PHPUnit_Framework_TestCase
{
    /** @var  \Refactoring\Customer */
    private $customer;

    /**
     * @test
     * @dataProvider render_Provider
     */
    public function render_Perfect_Perfect($data, $expected)
    {
        $statement = new \Refactoring\AsciiStatement();
        $this->assertEquals($expected, $statement->render($data));
    }

    public function render_Provider()
    {
        return array(
            'No rentals' => array(
                array('name' => 'Joe', 'charge' => 0, 'points' => 0, 'rentals' => array()),
                "Rental Record for Joe\nAmount owed is 0\nYou earned 0 frequent renter points"
            ),
            'Single rental' => array(
                array('name' => 'Bob', 'charge' => 10.5, 'points' => 3, 'rentals' => array(
                    array('title' => "Rambo 1", 'charge' => 10.5),
                )),
                "Rental Record for Bob\n\tRambo 1\t10.5\nAmount owed is 10.5\nYou earned 3 frequent renter points"
            ),
            'Multiple rental' => array(
                array('name' => 'Dan', 'charge' => 16, 'points' => 3, 'rentals' => array(
                    array('title' => "Rambo 1", 'charge' => 10),
                    array('title' => "Rambo 2", 'charge' => 6),
                )),
                "Rental Record for Dan\n\tRambo 1\t10\n\tRambo 2\t6\nAmount owed is 16\nYou earned 3 frequent renter points"
            ),
        );
    }

    /**
     * @test
     */
    public function render_Integration_Perfect()
    {
        // Arrange
        $this->customer = new \Refactoring\Customer("Joe");
        $statement = new \Refactoring\AsciiStatement();

        $this->addRental("Rambo 1", \Refactoring\Movie::CHILDRENS, 1);
        $this->addRental("Rambo 2", \Refactoring\Movie::NEW_RELEASE, 2);
        $this->addRental("Rambo 3", \Refactoring\Movie::REGULAR, 1);

        // Act
        $result = $statement->render($this->customer->getStatementData());

        //Assert
        $expected = "Rental Record for Joe\n\tRambo 1	1.5\n\tRambo 2	6\n\tRambo 3	2\nAmount owed is 9.5\nYou earned 4 frequent renter points";
        $this->assertEquals($expected, $result);
    }

    public function addRental($title, $priceCode, $days)
    {
        $this->customer->addRental(new \Refactoring\Rental(new \Refactoring\Movie($title, $priceCode), $days));
    }
}