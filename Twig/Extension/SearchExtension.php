<?php

namespace Chebur\SearchBundle\Twig\Extension;

use Chebur\SearchBundle\Search\Pagination;
use Chebur\SearchBundle\Search\ContainerInterface;
use Twig_Environment;
use Twig_Extension;

class SearchExtension extends Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('chebur_search_pagination', [$this, 'pagination'], ['is_safe' => ['html'], 'needs_environment' => true]),
            new \Twig_SimpleFunction('chebur_search_sorting',    [$this, 'sorting'],    ['is_safe' => ['html'], 'needs_environment' => true]),
            new \Twig_SimpleFunction('chebur_search_limitation', [$this, 'limitation'], ['is_safe' => ['html'], 'needs_environment' => true]),
        ];
    }

    public function pagination(Twig_Environment $env, ContainerInterface $searchContainer, array $options = []): string
    {
        $searchOptions = $searchContainer->getOptions();
        $template      = isset($options['template']) ? $options['template'] : $searchOptions->getTemplatePagination();

        $renderParameters = [
            'page'             => $searchOptions->getPage(),
            'limit'            => $searchOptions->getLimit(),
            'sort'             => $searchOptions->getSort(),
            'order'            => $searchOptions->getOrder(),
            'limits'           => $searchOptions->getLimits(),
            'sorts'            => $searchOptions->getSorts(),
            'page_range_count' => $searchOptions->getPageRange(),
            'items_options'    => $searchOptions->getItemsOptions(),
            'route'            => $searchOptions->getRoute(),
            'route_params'     => $searchOptions->getRouteParams(),
            'param_name_page'  => $searchOptions->getParamNamePage(),
            'param_name_limit' => $searchOptions->getParamNameLimit(),
            'param_name_sort'  => $searchOptions->getParamNameSort(),
            'param_name_order' => $searchOptions->getParamNameOrder(),
        ];
        $tc = $searchContainer->getTotalCount();
        $tc = is_array($tc) ? array_sum($tc) : $tc;
        $renderParameters['total_count'] = $tc;

        $renderParameters = array_merge($renderParameters, $options);

        if ($renderParameters['limit'] == 0 || $renderParameters['total_count'] == 0) {
            $pageCount = 0;
            $pageRange = [];
        } else {
            //todo Наверно надо в опции это запихнуть закрыв для изменения многие параметры
            $pagination = new Pagination($renderParameters['total_count'], $renderParameters['limit'], $renderParameters['page']);
            $pageCount = $pagination->getPageCount();
            $pageRange = $pagination->getPageRange($renderParameters['page_range_count']);
        }
        $renderParameters['page_count'] = $pageCount;
        $renderParameters['page_range'] = $pageRange;

        return $env->render($template, $renderParameters);
    }

    public function limitation(Twig_Environment $env, ContainerInterface $searchContainer, array $options = []): string
    {
        $searchOptions = $searchContainer->getOptions();
        $template      = isset($options['template']) ? $options['template'] : $searchOptions->getTemplateLimitation();

        $renderParameters = [
            'page'             => $searchOptions->getPage(),
            'limit'            => $searchOptions->getLimit(),
            'sort'             => $searchOptions->getSort(),
            'order'            => $searchOptions->getOrder(),
            'limits'           => $searchOptions->getLimits(),
            'sorts'            => $searchOptions->getSorts(),
            'page_range_count' => $searchOptions->getPageRange(),
            'items_options'    => $searchOptions->getItemsOptions(),
            'route'            => $searchOptions->getRoute(),
            'route_params'     => $searchOptions->getRouteParams(),
            'param_name_page'  => $searchOptions->getParamNamePage(),
            'param_name_limit' => $searchOptions->getParamNameLimit(),
            'param_name_sort'  => $searchOptions->getParamNameSort(),
            'param_name_order' => $searchOptions->getParamNameOrder(),
        ];
        $tc = $searchContainer->getTotalCount();
        $tc = is_array($tc) ? array_sum($tc) : $tc;
        $renderParameters['total_count'] = $tc;

        $renderParameters = array_merge($renderParameters, $options);

        return $env->render($template, $renderParameters);
    }

    public function sorting(Twig_Environment $env, ContainerInterface $searchContainer, array $options = []): string
    {
        $searchOptions = $searchContainer->getOptions();
        $template      = isset($options['template']) ? $options['template'] : $searchOptions->getTemplateSorting();

        $renderParameters = [
            'page'             => $searchOptions->getPage(),
            'limit'            => $searchOptions->getLimit(),
            'sort'             => $searchOptions->getSort(),
            'order'            => $searchOptions->getOrder(),
            'limits'           => $searchOptions->getLimits(),
            'sorts'            => $searchOptions->getSorts(),
            'page_range_count' => $searchOptions->getPageRange(),
            'items_options'    => $searchOptions->getItemsOptions(),
            'route'            => $searchOptions->getRoute(),
            'route_params'     => $searchOptions->getRouteParams(),
            'param_name_page'  => $searchOptions->getParamNamePage(),
            'param_name_limit' => $searchOptions->getParamNameLimit(),
            'param_name_sort'  => $searchOptions->getParamNameSort(),
            'param_name_order' => $searchOptions->getParamNameOrder(),
        ];
        $tc = $searchContainer->getTotalCount();
        $tc = is_array($tc) ? array_sum($tc) : $tc;
        $renderParameters['total_count'] = $tc;

        $renderParameters = array_merge($renderParameters, $options);

        return $env->render($template, $renderParameters);
    }
}
