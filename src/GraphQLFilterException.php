<?php

namespace Gency\GraphQLFilter;

class GraphQLFilterException extends \Exception
{
    public function __construct($message) {
        parent::__construct($message);
    }
}
