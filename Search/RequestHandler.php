<?php

namespace Chebur\SearchBundle\Search;

use Symfony\Component\HttpFoundation\Request;

class RequestHandler implements RequestHandlerInterface
{
    public function handleRequest(OptionsInterface $options, Request $request = null)
    {
        if (!$request) {
            return;
        }

        $this->processPage($options, $request);
        $this->processLimit($options, $request);
        $this->processSort($options, $request);
        $this->processOrder($options, $request);
        $this->processRoute($options, $request);
        $this->processRouteParams($options, $request);
    }

    protected function processPage(OptionsInterface $options, Request $request)
    {
        $value = $this->processParam($options->getParamNamePage(), $request);
        if ($value === null) {
            return;
        }
        if (!filter_var($value, FILTER_VALIDATE_INT) || $value < 1) {
            return;
        }
        $options->setPage($value);
    }

    protected function processLimit(OptionsInterface $options, Request $request)
    {
        $value = $this->processParam($options->getParamNameLimit(), $request);
        if ($value === null) {
            return;
        }
        if (!filter_var($value, FILTER_VALIDATE_INT) || $value < 1) {
            return;
        }
        $options->setLimit($value);
    }

    protected function processSort(OptionsInterface $options, Request $request)
    {
        $value = $this->processParam($options->getParamNameSort(), $request);
        if ($value === null) {
            return;
        }
        if (!is_string($value)) {
            return;
        }
        $options->setSort($value);
    }

    protected function processOrder(OptionsInterface $options, Request $request)
    {
        $value = $this->processParam($options->getParamNameOrder(), $request);
        if ($value === null) {
            return;
        }
        if (!is_string($value)) {
            return;
        }
        $options->setOrder($value);
    }

    protected function processRoute(OptionsInterface $options, Request $request)
    {
        if (!$options->getRoute()) {
            $options->setRoute($request->attributes->get('_route'));
        }
    }

    protected function processRouteParams(OptionsInterface $options, Request $request)
    {
        if (empty($options->getRouteParams())) {
            $options->setRouteParams(array_merge($request->attributes->get('_route_params'), $request->query->all()));
        }
    }

    /**
     * @return mixed|null
     */
    protected function processParam(string $paramName, Request $request)
    {
        if (!$paramName) {
            return null;
        }
        if (isset($request->attributes->get('_route_params')[$paramName])) {
            return $request->attributes->get('_route_params')[$paramName];
        } elseif ($request->request->has($paramName)) {
            return $request->request->get($paramName);
        } elseif ($request->query->has($paramName)) {
            return $request->query->get($paramName);
        }
        return null;
    }
}
