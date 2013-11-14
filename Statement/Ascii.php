<?php

namespace Refactoring;

require_once("Statement.php");

class AsciiStatement extends Statement
{
    /**
     * @param $statement
     * @return string
     */
    public function render($statement)
    {
        $result = "Rental Record for {$statement['name']}\n";

        foreach ($statement['rentals'] as $rental) {
            $result .= "\t{$rental['title']}\t{$rental['charge']}\n";
        }

        $result .= "Amount owed is {$statement['charge']}\n";
        $result .= "You earned {$statement['points']} frequent renter points";

        return $result;
    }
}