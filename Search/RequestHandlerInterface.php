<?php

namespace Chebur\SearchBundle\Search;

use Symfony\Component\HttpFoundation\Request;

interface RequestHandlerInterface
{
    /**
     * @param OptionsInterface $options
     * @param Request|null     $request
     */
    public function handleRequest(OptionsInterface $options, Request $request = null);

}
