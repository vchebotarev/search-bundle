<?php

namespace Chebur\SearchBundle\Search;

interface OptionsInterface extends \ArrayAccess
{
    /**
     * @return int
     */
    public function getPage() : int;

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page = 1);

    /**
     * @return int
     */
    public function getLimit() : int;

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit = 0);

    /**
     * @return string
     */
    public function getSort() : string;

    /**
     * @param string $sort
     * @return $this
     */
    public function setSort(string $sort);

    /**
     * @return string
     */
    public function getOrder() : string;

    /**
     * @param string $order
     * @return $this
     */
    public function setOrder(string $order);

    /**
     * @return int
     */
    public function getPageRange() : int;

    /**
     * @param int $range
     * @return $this
     */
    public function setPageRange(int $range);

    /**
     * @return array
     */
    public function getLimits() : array;

    /**
     * @param array $limits
     * @return $this
     */
    public function setLimits(array $limits);

    /**
     * @return array
     */
    public function getSorts() : array;

    /**
     * @param array $sorts
     * @return $this
     */
    public function setSorts(array $sorts);

    /**
     * @return array|object
     */
    public function getItemsSource();

    /**
     * @param array|object $source
     * @return $this
     */
    public function setItemsSource($source);

    /**
     * @return array|object
     */
    public function getItemsOptions();

    /**
     * @param array|object $options
     * @return $this
     */
    public function setItemsOptions($options);

    /**
     * @return string
     */
    public function getParamNamePage() : string;

    /**
     * @param string $paramName
     * @return $this
     */
    public function setParamNamePage(string $paramName);

    /**
     * @return string
     */
    public function getParamNameLimit() : string;

    /**
     * @param string $paramName
     * @return $this
     */
    public function setParamNameLimit(string $paramName);

    /**
     * @return string
     */
    public function getParamNameSort() : string;

    /**
     * @param string $paramName
     * @return $this
     */
    public function setParamNameSort(string $paramName);

    /**
     * @return string
     */
    public function getParamNameOrder() : string;

    /**
     * @param string $paramName
     * @return $this
     */
    public function setParamNameOrder(string $paramName);

    /**
     * @return string
     */
    public function getRoute();

    /**
     * @param string $route
     * @return $this
     */
    public function setRoute(string $route);

    /**
     * @return array
     */
    public function getRouteParams() : array;

    /**
     * @param array $params
     * @return $this
     */
    public function setRouteParams(array $params);

    /**
     * @return string
     */
    public function getTemplatePagination() : string;

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplatePagination(string $template);

    /**
     * @return string
     */
    public function getTemplateLimitation() : string;

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplateLimitation(string $template);

    /**
     * @return string
     */
    public function getTemplateSorting() : string;

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplateSorting(string $template);

    /**
     * @return $this
     */
    public function resolveOptions();

    /**
     * @return int
     */
    public function getOffset();

    /**
     * @return array
     */
    public function toArray() : array;

}
