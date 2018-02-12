<?php

namespace Chebur\SearchBundle\Search;

use Symfony\Component\HttpFoundation\Request;

interface BuilderInterface
{
    /**
     * @param Request|null $request
     * @return ContainerInterface
     */
    public function build(Request $request = null) : ContainerInterface;

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page = 1);

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit = 0);

    /**
     * @param string      $sort
     * @param string|null $order
     * @return $this
     */
    public function setSort(string $sort, string $order = null);

    /**
     * @param int $pageRange
     * @return $this
     */
    public function setPageRange(int $pageRange);

    /**
     * @param array $limits
     * @return $this
     */
    public function setLimits(array $limits);

    /**
     * @param array $sorts
     * @return $this
     */
    public function setSorts(array $sorts);

    /**
     * @param array|object $source
     * @param mixed        $options
     * @return $this
     */
    public function setItemsSource($source, $options = null);

    /**
     * @param string     $route
     * @param array|null $routeParams
     * @return $this
     */
    public function setRoute(string $route, array $routeParams = null);

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplatePagination(string $template);

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplateLimitation(string $template);

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplateSorting(string $template);

    /**
     * @param string $paramName
     * @return $this
     */
    public function setParamNamePage(string $paramName);

    /**
     * @param string $paramName
     * @return $this
     */
    public function setParamNameLimit(string $paramName);

    /**
     * @param string $paramName
     * @return $this
     */
    public function setParamNameSort(string $paramName);

    /**
     * @param string $paramName
     * @return $this
     */
    public function setParamNameOrder(string $paramName);

}
