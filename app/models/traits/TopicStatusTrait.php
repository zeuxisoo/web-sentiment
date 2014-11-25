<?php
trait TopicStatusTrait {

    public static function bootTopicStatusTrait() {
        static::addGlobalScope(new TopicStatusScope);
    }

    public function getStatusColumn() {
        return defined('static::STATUS_COLUMN') ? static::STATUS_COLUMN : 'status';
    }

    public function getQualifiedStatusColumn() {
        return $this->getTable().'.'.$this->getStatusColumn();
    }

    public static function withProtected() {
        return with(new static)->newQueryWithoutScope(new TopicStatusScope);
    }

    public static function onlyProtected() {
        $instance = new static;
        $column   = $instance->getQualifiedStatusColumn();

        return with(new static)->newQueryWithoutScope(new TopicStatusScope)->where($column, '=', Topic::STATUS_PROTECTED);
    }

}
