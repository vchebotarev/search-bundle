<?php

namespace Chebur\SearchBundle\Search;

use Symfony\Component\OptionsResolver\Options as ResolverOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Options implements OptionsInterface
{
    /**
     * @var array
     */
    protected $options = [
        'page'                => 1,
        'limit'               => null, //т.к. 0 тоже значение, то по умолчанию null
        'sort'                => '',
        'order'               => '',
        'limits'              => [],
        'sorts'               => [],
        'page_range_count'    => 0,
        'items_source'        => null,
        'items_options'       => [],
        'route'               => '',
        'route_params'        => [],
        'param_name_page'     => '',
        'param_name_limit'    => '',
        'param_name_sort'     => '',
        'param_name_order'    => '',
        'template_pagination' => '',
        'template_limitation' => '',
        'template_sorting'    => '',
    ];

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     */
    public function __construct()
    {
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions();
    }

    protected function configureOptions()
    {
        $this->optionsResolver->setDefined(array_keys($this->options));

        //Лимит на страницу
        $this->optionsResolver->setNormalizer('limit', function (ResolverOptions $options, $limit){
            $available = $options['limits'];
            if (empty($available)) {
                return (int)$limit;
            }
            if ($limit === null || !array_key_exists($limit, $available)) {
                $limit = array_keys($available)[0];
            }
            return $limit;
        });

        //Сортировка
        $this->optionsResolver->setNormalizer('sort', function (ResolverOptions $options, $sort){
            $available = $options['sorts'];
            if (empty($available)) {
                return $sort;
            }
            if (!array_key_exists($sort, $available)) {
                $sort = array_keys($available)[0];
            }
            return $sort;
        });

        //Порядок сортировки
        $this->optionsResolver->setNormalizer('order', function (ResolverOptions $options, $order){
            $available = $options['sorts'];
            if (empty($available)) {
                return $order;
            }
            $sort = $options['sort'];
            if (!array_key_exists($sort, $available)) {
                $availableOrders = array_values($available)[0];
            } else {
                $availableOrders = $available[$sort];
            }
            if (is_array($availableOrders)) {
                if (!array_key_exists($order, $availableOrders)) {
                    $order = array_keys($availableOrders)[0];
                }
            } else {
                $order = '';
            }
            return $order;
        });
    }

    /**
     * @return $this
     */
    public function resolveOptions()
    {
        $this->options = $this->optionsResolver->resolve($this->options);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPage(): int
    {
        return $this->options['page'];
    }

    /**
     * @inheritdoc
     */
    public function setPage(int $page = 1)
    {
        $this->options['page'] = $page;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLimit() : int
    {
        return $this->options['limit'];
    }

    /**
     * @inheritdoc
     */
    public function setLimit(int $limit = 0)
    {
        $this->options['limit'] = $limit;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSort() : string
    {
        return $this->options['sort'];
    }

    /**
     * @inheritdoc
     */
    public function setSort(string $sort)
    {
        $this->options['sort'] = $sort;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOrder() : string
    {
        return $this->options['order'];
    }

    /**
     * @inheritdoc
     */
    public function setOrder(string $order)
    {
        $this->options['order'] = $order;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPageRange() : int
    {
        return $this->options['page_range_count'];
    }

    /**
     * @inheritdoc
     */
    public function setPageRange(int $range)
    {
        $this->options['page_range_count'] = $range;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLimits() : array
    {
        return $this->options['limits'];
    }

    /**
     * @inheritdoc
     */
    public function setLimits(array $limits)
    {
        $this->options['limits'] = $limits;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSorts() : array
    {
        return $this->options['sorts'];
    }

    /**
     * @inheritdoc
     */
    public function setSorts(array $sorts)
    {
        $this->options['sorts'] = $sorts;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getItemsSource()
    {
        return $this->options['items_source'];
    }

    /**
     * @inheritdoc
     */
    public function setItemsSource($source)
    {
        $this->options['items_source'] = $source;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getItemsOptions()
    {
        return $this->options['items_options'];
    }

    /**
     * @inheritdoc
     */
    public function setItemsOptions($options)
    {
        $this->options['items_options'] = $options;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getParamNamePage() : string
    {
        return $this->options['param_name_page'];
    }

    /**
     * @inheritdoc
     */
    public function setParamNamePage(string $paramName)
    {
        $this->options['param_name_page'] = $paramName;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getParamNameLimit() : string
    {
        return $this->options['param_name_limit'];
    }

    /**
     * @inheritdoc
     */
    public function setParamNameLimit(string $paramName)
    {
        $this->options['param_name_limit'] = $paramName;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getParamNameSort() : string
    {
        return $this->options['param_name_sort'];
    }

    /**
     * @inheritdoc
     */
    public function setParamNameSort(string $paramName)
    {
        $this->options['param_name_sort'] = $paramName;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getParamNameOrder() : string
    {
        return $this->options['param_name_order'];
    }

    /**
     * @inheritdoc
     */
    public function setParamNameOrder(string $paramName)
    {
        $this->options['param_name_order'] = $paramName;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRoute()
    {
        return $this->options['route'];
    }

    /**
     * @inheritdoc
     */
    public function setRoute(string $route)
    {
        $this->options['route'] = $route;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRouteParams() : array
    {
        return $this->options['route_params'];
    }

    /**
     * @inheritdoc
     */
    public function setRouteParams(array $params)
    {
        $this->options['route_params'] = $params;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTemplatePagination() : string
    {
        return $this->options['template_pagination'];
    }

    /**
     * @inheritdoc
     */
    public function setTemplatePagination(string $template)
    {
        $this->options['template_pagination'] = $template;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTemplateLimitation() : string
    {
        return $this->options['template_limitation'];
    }

    /**
     * @inheritdoc
     */
    public function setTemplateLimitation(string $template)
    {
        $this->options['template_limitation'] = $template;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTemplateSorting() : string
    {
        return $this->options['template_sorting'];
    }

    /**
     * @inheritdoc
     */
    public function setTemplateSorting(string $template)
    {
        $this->options['template_sorting'] = $template;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOffset()
    {
        $offset = ($this->getPage() - 1) * $this->getLimit();
        if ($offset < 0) {
            return 0;
        }
        return $offset;
    }

    /**
     * @inheritdoc
     */
    public function toArray() : array
    {
        return $this->options;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return isset($this->options[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->options[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        $this->options[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        unset($this->options[$offset]);
    }

}
