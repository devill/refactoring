<?php
/**
 * Created by JetBrains PhpStorm.
 * User: merklik
 * Date: 4/27/13
 * Time: 11:12 AM
 * To change this template use File | Settings | File Templates.
 */
//namespace Refactoring;


require_once('Customer.php');
require_once('Rental.php');
require_once('Movie.php');


class TestCustomer extends PHPUnit_Framework_TestCase
{
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
        $s = $this->customer->statement();

        // Assert
        $expected = "Rental Record for Joe\n\tRambo 1	1.5\nAmount owed is 1.5\nYou earned 1 frequent renter points";
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
        $s = $this->customer->statement();

        // Assert
        $expected = "Rental Record for Joe\n\tRambo 1	1.5\n\tRambo 2	3\nAmount owed is 4.5\nYou earned 2 frequent renter points";
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
        $s = $this->customer->statement();

        // Assert
        $expected = "Rental Record for Joe\n\tRambo 1	1.5\n\tRambo 2	6\nAmount owed is 7.5\nYou earned 3 frequent renter points";
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
        $s = $this->customer->statement();

        //Assert
        $expected = "Rental Record for Joe\n\tRambo 1	1.5\n\tRambo 2	6\n\tRambo 3	2\nAmount owed is 9.5\nYou earned 4 frequent renter points";
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