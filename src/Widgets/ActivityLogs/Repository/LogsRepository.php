<?php

namespace Antares\Logger\Widgets\ActivityLogs\Repository;

use Antares\Logger\Widgets\ActivityLogs\Filter\ActivityTypeFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Antares\Logger\Model\LogTypes;
use Antares\Logger\Model\Logs;

class LogsRepository
{

    /**
     * LogTypes instance
     *
     * @var LogTypes 
     */
    protected $types;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * Owners array.
     *
     * @var array
     */
    protected $owners = [];

    /**
     * Construct
     * 
     * @param LogTypes $types
     */
    public function __construct(LogTypes $types)
    {
        $this->types = $types;
    }

    /**
     * Logs types getter
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getLogTypes()
    {
        return $this->types->all();
    }

    /**
     * Prepare base query
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    protected function query()
    {
        $query = Logs::query()->withoutGlobalScopes()
            ->select(['tbl_logs.*'])
            ->leftJoin('tbl_log_types', 'tbl_logs.type_id', 'tbl_log_types.id')
            ->leftJoin('tbl_logs_translations', 'tbl_logs.id', 'tbl_logs_translations.log_id')
            ->leftJoin('tbl_users', function(JoinClause $join) {
                $join
                ->on('tbl_logs.user_id', '=', 'tbl_users.id')
                ->orWhere('tbl_logs.author_id', 'tbl_users.id');
            })
            ->where([
                'tbl_logs_translations.lang_id' => lang_id(),
                'tbl_logs.brand_id'             => brand_id(),
                'tbl_log_types.active'          => 1
            ])
            ->orderBy('tbl_logs.created_at', 'desc');

        if(count($this->owners)) {
            $query->where(function(Builder $q) {
                foreach($this->owners as $type => $ids) {
                    $q->orWhere(function(Builder $q) use($type, $ids) {
                        $q->where('owner_type', $type)->whereIn('owner_id', $ids);
                    });
                }
            });
        }

        return $query;
    }

    /**
     * Scope query when current user is admin
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return void
     */
    protected function scopeAdmins($query)
    {
        $admin = user()->hasRoles('super-administrator') or user()->hasRoles('administrator');
        if (!$admin) {
            return;
        }
        $roles  = user()->roles;
        $childs = [];
        foreach ($roles as $role) {
            $childs = array_merge($childs, $role->getChilds(), [$role->id]);
        }
        $query->leftJoin('tbl_user_role', 'tbl_logs.user_id', 'tbl_user_role.user_id');
        $query->where(function($query) use($childs) {
            $query->whereIn('tbl_user_role.role_id', array_values($childs))->orWhere('tbl_logs.user_id', null);
        });
    }

    /**
     * Scope query when current user is client
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return void
     */
    protected function scopeResellers($query)
    {
        $uid = user()->id;
        $query->whereRaw('(tbl_users.creator_id=' . $uid . ' or tbl_users.id=' . $uid . ')');
    }

    /**
     * Scope query when current user is client
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return void
     */
    protected function scopeClients($query)
    {
        $client = (user()->hasRoles('member') or user()->hasRoles('client'));
        if (!$client) {
            return;
        }

        $uid = user()->id;
        $query->whereRaw('(tbl_logs.user_id=' . $uid . ' or tbl_logs.author_id=' . $uid . ')');
    }

    /**
     * Scope query with filter attributes
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return void
     */
    protected function scopeFilter($query)
    {

        $key    = uri() . '.' . ActivityTypeFilter::class;
        $values = request()->session()->get($key);
        $typeIds = [];

        if(is_array($values) && array_get($values, 'column') === 'type') {
            $typeIds = array_values($values['value']);
        }

        if($this->type) {
            $type = LogTypes::query()->where('active', 1)->where('name', $this->type)->first();

            if($type) {
                $typeIds[] = $type->id;
            }
        }

        if ( count($typeIds) ) {
            $query->whereIn('tbl_logs.type_id', $typeIds);
        }
    }

    /**
     * Scope query with search attributes
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @param String $search
     * @return void
     */
    protected function scopeSearch($query, $search)
    {
        if (is_null($search) or strlen($search) <= 0) {
            return;
        }
        $searchUp   = mb_strtoupper($search);
        $searchDown = mb_strtolower($search);
        $query->whereRaw("(tbl_logs_translations.raw like  \"%{$searchUp}%\" OR tbl_logs_translations.raw like  \"%{$searchDown}%\")");
    }

    /**
     * Filters eloquent results
     *
     * @param null $search
     * @return \Illuminate\Database\Query\Builder
     */
    public function filter($search = null)
    {
        $query = $this->query();
        if (($uid   = user_from_route()) !== false) {

            $query->where('tbl_logs.user_id', $uid);
        } else {
            $this->scopeAdmins($query);
            $this->scopeResellers($query);
            $this->scopeClients($query);
        }

        $this->scopeFilter($query);
        $this->scopeSearch($query, $search);

        return $query;
    }

    /**
     * Set required type.
     *
     * @param string $type
     * @return $this
     */
    public function setType(string $type) {
        $this->type = $type;

        return $this;
    }

    /**
     * @param array $owners
     * @return $this
     */
    public function setOwners(array $owners) {
        $this->owners = $owners;

        return $this;
    }

}
