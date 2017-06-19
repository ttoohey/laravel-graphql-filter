<?php

namespace Gency\GraphQLFilter\Type;

use Gency\GraphQLFilter\GraphQLFilter;
use Gency\GraphQLFilter\GraphQLFilterException;

use ErrorException;
use ReflectionClass;
use Folklore\GraphQL\Support\InputType;

class FilterType extends InputType
{
    protected $model;
    protected $fieldFilterables = null;
    protected $fieldOverrides = [];
    
    public function attributes() {
        $modelName = $this->getModelName();
        $typeName = $this->getTypeName();
        return [
            'name' => $typeName,
            'description' => 'Filter parameters for listing ' . str_plural($modelName)
        ];
    }
    
    public function fields() {
        return $this->fieldsFromModel();
    }
    
    public function getModelName() {
        return (new ReflectionClass($this->getModel()))->getshortName();
    }
    
    public function getTypeName() {
        return $this->getModelNmae() . 'Filter';
    }
    
    public function getModel() {
        if (!isset($this->model)) {
            throw new GraphQLFilterException('model property must be set');
        }
        return $this->model;
    }
    
    protected function getFieldFilterables() {
        return $this->fieldFilterables;
    }
    
    protected function getFieldOverrides() {
        return $this->fieldOverrides;
    }
    
    protected function fieldsFromModel() {
        $model = $this->getModel();
        $fieldFilterables = $this->getFieldFilterables();
        $fieldOverrides = $this->getFieldOverrides();
        return GraphQLFilter::fieldsFromModel($model, $fieldFilterables, $fieldOverrides);
    }
}
