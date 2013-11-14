<?php

require_once('Customer.php');
require_once('Rental.php');
require_once('Movie.php');


class CustomerTest extends PHPUnit_Framework_TestCase
{
    /** @var \Refactoring\Customer */
    public $customer;

    public function setUp()
    {
        $this->customer = new \Refactoring\Customer("Joe");
    }

    /**
     * @test
     */
    public function statment_OneRental_Childrens()
    {
        //Arrange
        $this->addRental("Rambo 1", \Refactoring\Movie::CHILDRENS, 1);

        // Act
        $s = $this->customer->getStatementData();

        // Assert
        $expected = array(
            'name' => "Joe",
            'charge' => 1.5,
            'points' => 1,
            'rentals' => array(
                array
                (
                    'title' => "Rambo 1",
                    'charge' => 1.5,
                )

            )
        );

        $this->assertEquals($expected, $s);
    }

    /**
     * @test
     */
    public function statment_TwoRentalsOneDay_NewRelease()
    {
        // Arrange
        $this->addRental("Rambo 1", \Refactoring\Movie::CHILDRENS, 1);
        $this->addRental("Rambo 2", \Refactoring\Movie::NEW_RELEASE, 1);

        // Act
        $s = $this->customer->getStatementData();

        // Assert
        $expected = array(
            'name' => "Joe",
            'charge' => 4.5,
            'points' => 2,
            'rentals' => array(
                array
                (
                    'title' => "Rambo 1",
                    'charge' => 1.5,
                ),
                array
                (
                    'title' => "Rambo 2",
                    'charge' => 3,
                )

            )
        );
        $this->assertEquals($expected, $s);
    }


    /**
     * @test
     */
    public function statment_TwoRentals_NewRelease()
    {
        // Arrange
        $this->addRental("Rambo 1", \Refactoring\Movie::CHILDRENS, 1);
        $this->addRental("Rambo 2", \Refactoring\Movie::NEW_RELEASE, 2);

        // Act
        $s = $this->customer->getStatementData();

        // Assert
        $expected = array(
            'name' => "Joe",
            'charge' => 7.5,
            'points' => 3,
            'rentals' => array(
                array
                (
                    'title' => "Rambo 1",
                    'charge' => 1.5,
                ),
                array
                (
                    'title' => "Rambo 2",
                    'charge' => 6,
                )

            )
        );

        $this->assertEquals($expected, $s);
    }


    /**
     * @test
     */
    public function statment_ThreeRentals_NewRelease()
    {
        // Arrange
        $this->addRental("Rambo 1", \Refactoring\Movie::CHILDRENS, 1);
        $this->addRental("Rambo 2", \Refactoring\Movie::NEW_RELEASE, 2);
        $this->addRental("Rambo 3", \Refactoring\Movie::REGULAR, 1);

        // Act
        $s = $this->customer->getStatementData();

        //Assert
        $expected = array(
            'name' => "Joe",
            'charge' => 9.5,
            'points' => 4,
            'rentals' => array(
                array
                (
                    'title' => "Rambo 1",
                    'charge' => 1.5,
                ),
                array
                (
                    'title' => "Rambo 2",
                    'charge' => 6,
                ),
                array
                (
                    'title' => "Rambo 3",
                    'charge' => 2,
                )
            )
        );

        $this->assertEquals($expected, $s);
    }

    /**
     * @param $title
     * @param $priceCode
     * @param $days
     */
    public function addRental($title, $priceCode, $days)
    {
        $this->customer->addRental(new \Refactoring\Rental(new \Refactoring\Movie($title, $priceCode), $days));
    }


}