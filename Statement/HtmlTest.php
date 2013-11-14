<?php

require_once("Html.php");
require_once("../Customer.php");
require_once("../Movie.php");
require_once("../Rental.php");

class HtmlTest extends PHPUnit_Framework_TestCase
{
    private $customer;

    /**
     * @test
     * @dataProvider render_Provider
     */
    public function render_Perfect_Perfect($data, $expected)
    {
        $statement = new \Refactoring\HtmlStatement();
        $this->assertEquals($expected, $statement->render($data));
    }

    public function render_Provider()
    {
        return array(
            'No rentals' => array(
                array('name' => 'Joe', 'charge' => 0, 'points' => 0, 'rentals' => array()),
                "<HTML><BODY>Rental Record for Joe<br/>Amount owed is 0<br/>You earned 0 frequent renter points</BODY></HTML>"
            ),
            'Single rental' => array(
                array('name' => 'Bob', 'charge' => 10.5, 'points' => 3, 'rentals' => array(
                    array('title' => "Rambo 1", 'charge' => 10.5),
                )),
                "<HTML><BODY>Rental Record for Bob<br/>Rambo 1: 10.5<br/>Amount owed is 10.5<br/>You earned 3 frequent renter points</BODY></HTML>"
            ),
            'Multiple rental' => array(
                array('name' => 'Dan', 'charge' => 16, 'points' => 3, 'rentals' => array(
                    array('title' => "Rambo 1", 'charge' => 10),
                    array('title' => "Rambo 2", 'charge' => 6),
                )),
                "<HTML><BODY>Rental Record for Dan<br/>Rambo 1: 10<br/>Rambo 2: 6<br/>Amount owed is 16<br/>You earned 3 frequent renter points</BODY></HTML>"
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
        $statement = new \Refactoring\HtmlStatement();

        $this->addRental("Rambo 1", \Refactoring\Movie::CHILDRENS, 1);
        $this->addRental("Rambo 2", \Refactoring\Movie::NEW_RELEASE, 2);
        $this->addRental("Rambo 3", \Refactoring\Movie::REGULAR, 1);

        // Act
        $result = $statement->render($this->customer->getStatementData());

        //Assert
        $expected = "<HTML><BODY>Rental Record for Joe<br/>Rambo 1: 1.5<br/>Rambo 2: 6<br/>Rambo 3: 2<br/>Amount owed is 9.5<br/>You earned 4 frequent renter points</BODY></HTML>";
        $this->assertEquals($expected, $result);
    }

    public function addRental($title, $priceCode, $days)
    {
        $this->customer->addRental(new \Refactoring\Rental(new \Refactoring\Movie($title, $priceCode), $days));
    }
}