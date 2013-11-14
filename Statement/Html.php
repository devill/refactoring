<?php

namespace Refactoring;

require_once("Statement.php");

class HtmlStatement extends Statement
{
    /**
     * @param $statement
     * @return string
     */
    public function render($statement)
    {
        $result = "<HTML><BODY>Rental Record for {$statement['name']}<br/>";

        foreach ($statement['rentals'] as $rental) {
            $result .= "{$rental['title']}: {$rental['charge']}<br/>";
        }
        $result .= "Amount owed is {$statement['charge']}<br/>";
        $result .= "You earned {$statement['points']} frequent renter points</BODY></HTML>";

        return $result;
    }
}