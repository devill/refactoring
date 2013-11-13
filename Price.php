<?php

namespace Refactoring;

abstract class Price
{
    abstract public function getPriceCode();

    public function getCharge($daysRented)
    {
        $result = 0;
        switch ($this->getPriceCode()) {
            case Movie::CHILDRENS:
                $result += 1.5;
                if ($daysRented > 3)
                    $result += ($daysRented - 3) * 1.5;
                break;

        }
        return $result;
    }

    public function getFrequentRenterPoints($daysRented)
    {
        if (($this->getPriceCode() == Movie::NEW_RELEASE) && $daysRented > 1)
            return 2;
        else
            return 1;
    }
}

class ChildrensPrice extends Price
{
    public function getPriceCode()
    {
        return Movie::CHILDRENS;
    }
}

class RegularPrice extends Price
{
    public function getPriceCode()
    {
        return Movie::REGULAR;
    }

    public function getCharge($daysRented)
    {
        $result = 2;
        if ($daysRented > 2)
            $result += ($daysRented - 2) * 1.5;
        return $result;
    }
}

class NewReleasePrice extends Price
{
    public function getPriceCode()
    {
        return Movie::NEW_RELEASE;
    }

    public function getCharge($daysRented)
    {
        return $daysRented * 3;
    }
}