<?php
/**
 * Created by JetBrains PhpStorm.
 * User: merklik
 * Date: 4/27/13
 * Time: 7:12 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Refactoring;


class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;
    private $title;
    private $priceCode;

    function __construct($title, $priceCode)
    {
        $this->title = $title;
        $this->priceCode = $priceCode;
    }

    public function getPriceCode()
    {
        return $this->priceCode;
    }

    public function setPriceCode($arg)
    {
        $this->priceCode = $arg;
    }

    public function getTitle()
    {
        return $this->title;
    }

}