<?php
use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class TopicStatusScope implements ScopeInterface {

    protected $extensions = ['WithProtected'];

    public function apply(Builder $builder) {
        $column = $builder->getModel()->getQualifiedStatusColumn();

        $builder->where($column, '=', Topic::STATUS_PUBLIC);

        $this->addWithProtected($builder);
        $this->addOnlyProtected($builder);
    }

    public function remove(Builder $builder) {
        $query       = $builder->getQuery();
        $column      = $builder->getModel()->getQualifiedStatusColumn();
        $binding_key = 0;

        foreach ($query->wheres as $key => $where) {
            if ($this->isStatusConstraint($where, $column) === true) {
                $this->removeWhere($query, $key);
                $this->removeBinding($query, $binding_key);
            }
        }
    }

    protected function removeWhere(QueryBuilder $query, $key) {
        unset($query->wheres[$key]);
        $query->wheres = array_values($query->wheres);
    }

    protected function removeBinding(QueryBuilder $query, $key) {
        $bindings = $query->getRawBindings()['where'];

        unset($bindings[$key]);

        $query->setBindings($bindings);
    }

    protected function isStatusConstraint($where, $column) {
        return strtolower($where['type']) === "basic" && $where['column'] == $column && $where['value'] === Topic::STATUS_PUBLIC;
    }

    // Support model query like `method->withProtected()->get()`
    protected function addWithProtected(Builder $builder) {
        $builder->macro('withProtected', function(Builder $builder) {
            $this->remove($builder);

            return $builder;
        });
    }

    protected function addOnlyProtected(Builder $builder) {
        $builder->macro('onlyProtected', function(Builder $builder) {
            $this->remove($builder);

            $builder->where($builder->getModel()->getQualifiedStatusColumn(), '=', Topic::STATUS_PROTECTED);

            return $builder;
        });
    }

}
