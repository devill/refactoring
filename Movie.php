<?php
/**
 * Created by JetBrains PhpStorm.
 * User: merklik
 * Date: 4/27/13
 * Time: 7:12 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Refactoring;

require_once("Price/Price.php");


class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;
    private $title;

    /** @var Price */
    private $price;

    function __construct($title, $priceCode)
    {
        $this->title = $title;
        $this->setPriceCode($priceCode);
    }

    public function setPriceCode($arg)
    {
        switch($arg)
        {
            case Movie::REGULAR:
                $this->price = new RegularPrice();
                break;
            case Movie::NEW_RELEASE:
                $this->price = new NewReleasePrice();
                break;
            case Movie::CHILDRENS:
                $this->price = new ChildrensPrice();
                break;
            default:
                throw new \Exception("Illegal Price Code");
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCharge($daysRented)
    {
        return $this->price->getCharge($daysRented);
    }

    public function getFrequentRenterPoints($daysRented)
    {
        return $this->price->getFrequentRenterPoints($daysRented);
    }
}