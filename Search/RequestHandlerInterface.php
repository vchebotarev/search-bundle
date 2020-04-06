<?php

namespace Chebur\SearchBundle\Search;

use Symfony\Component\HttpFoundation\Request;

interface RequestHandlerInterface
{
    public function handleRequest(OptionsInterface $options, Request $request = null);
}
