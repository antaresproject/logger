<?php

namespace Antares\Logger\Widgets\ActivityLogs\Processor;

use Antares\Logger\Widgets\ActivityLogs\Filter\ActivityTypeFilter;
use Antares\Logger\Widgets\ActivityLogs\Repository\LogsRepository;
use Antares\Datatables\Adapter\FilterAdapter;

class ParamsProcessor
{

    /**
     * Base url for pagination
     *
     * @var String 
     */
    protected $baseUrl = '';

    /**
     * FilterAdapter instance
     *
     * @var FilterAdapter
     */
    protected $filters;

    /**
     * LogsRepository instance
     *
     * @var LogsRepository
     */
    protected $repository;

    /**
     * User identifier
     *
     * @var mixed
     */
    protected $uid;

    /**
     * Default url params
     *
     * @var array
     */
    protected $urlParams = ['page' => 1, 'per_page' => 10, 'search' => ''];

    /**
     * Construct
     * 
     * @param FilterAdapter $filters
     * @param LogsRepository $repository
     */
    public function __construct(FilterAdapter $filters, LogsRepository $repository)
    {
        $this->filters    = $filters->add(ActivityTypeFilter::class);
        $this->repository = $repository;
        $this->baseUrl    = '/' . area() . '/activity-logs/index';
        $this->uid        = user_from_route(null);
    }

    /**
     * Filter setter
     * 
     * @param FilterAdapter $filters
     * @return $this
     */
    public function setFilter(FilterAdapter $filters)
    {
        $this->filters = $filters->add(ActivityTypeFilter::class);
        return $this;
    }

    /**
     * User identifier setter
     * 
     * @param mixed $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * Gets widget params
     * 
     * @param String $search
     * @return array
     */
    public function get($search = null)
    {
        $logs = $this->paginate($this->repository->filter($search));
        return [
            'select_url' => $this->baseUrl(['search' => $search]),
            'search_url' => $this->baseUrl(['search' => $search]),
            'url'        => $this->baseUrl(),
            'search'     => $search,
            'types'      => $this->repository->getLogTypes(),
            'logs'       => $logs,
            'pagination' => $logs->links('antares/logger::admin.widgets.partials._pagination', ['perpages' => $this->perPage()]),
            'filters'    => $this->filters->getFilters('antares/logger::admin.widgets.log_filter')
        ];
    }

    /**
     * Gets perPage urls
     * 
     * @return array
     */
    protected function perPage()
    {
        $urls = [];
        foreach ([10, 20, 30, 50] as $perPage) {
            $params = $this->urlParams();
            array_set($params, 'per_page', $perPage);
            array_set($urls, $perPage, $this->baseUrl($params, true));
        }
        return $urls;
    }

    /**
     * Paginates query results
     * 
     * @param \Illuminate\Database\Query\Builder $logs
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginate($logs)
    {
        $paginator = $logs->paginate(request()->get('per_page', 10));
        if (($uid       = user_from_route($this->uid)) !== false) {
            $paginator->setPath($this->baseUrl . '/' . $uid . '/');
        } else {
            $paginator->setPath($this->baseUrl);
        }
        $paginator->appends('search', input('search'));
        $paginator->appends('per_page', input('per_page'));

        return $paginator;
    }

    /**
     * Creates url params collection
     * 
     * @param array $params
     * @return String
     */
    protected function urlParams($params = [])
    {
        $only   = array_merge($this->urlParams, $params);
        $return = [];
        foreach ($only as $name => $default) {
            array_set($return, $name, input($name, $default));
        }
        return $return;
    }

    /**
     * Base url getter
     * 
     * @param array $params
     * @param boolean $skipUrlParams
     * @return String
     */
    protected function baseUrl($params = [], $skipUrlParams = false)
    {

        $url    = $this->baseUrl;
        if (!is_null($userId = $this->uid)) {
            $url = $url . '/' . $userId;
        }
        $parameters = $skipUrlParams ? $params : $this->urlParams($params);
        return $url . '?' . http_build_query($parameters, '', '&');
    }

}
