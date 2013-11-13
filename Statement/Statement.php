<?php

namespace Refactoring;

abstract class Statement
{
    abstract public function render($customerData);
}