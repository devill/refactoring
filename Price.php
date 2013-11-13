<?php

namespace Refactoring;

abstract class Price
{
    abstract public function getPriceCode();
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
}

class NewReleasePrice extends Price
{
    public function getPriceCode()
    {
        return Movie::NEW_RELEASE;
    }
}