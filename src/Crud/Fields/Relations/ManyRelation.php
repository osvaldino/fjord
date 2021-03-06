<?php

namespace Fjord\Crud\Fields\Relations;

use Fjord\Crud\ManyRelationField;

class ManyRelation extends ManyRelationField
{
    use Concerns\ManagesRelation;

    /**
     * Properties passed to Vue component.
     *
     * @var array
     */
    protected $props = [
        'type' => 'manyRelation'
    ];

    /**
     * Required attributes.
     *
     * @var array
     */
    protected $required = [
        'title',
        'model',
        'preview'
    ];

    /**
     * Available Field attributes.
     *
     * @var array
     */
    protected $available = [
        'title',
        'model',
        'hint',
        'form',
        'query',
        'preview',
        'confirm',
        'sortable',
        'filter',
        'relatedCols',
        'small',
        'perPage',
        'searchable',
        'tags',
        'tagVariant',
        'showTableHead'
    ];

    /**
     * Default Field attributes.
     *
     * @var array
     */
    protected $defaults = [
        'confirm' => false,
        'sortable' => true,
        'orderColumn' => 'order_column',
        'relatedCols' => 12,
        'small' => false,
        'perPage' => 10,
        'searchable' => false,
        'tags' => false,
        'tagVariant' => 'secondary',
        'showTableHead' => false
    ];

    /**
     * Get relation for model.
     *
     * @param mixed $model
     * @param boolean $query
     * @return mixed
     */
    protected function getRelation($model)
    {
        if (method_exists($model, $this->id)) {
            return parent::getRelation($model);
        }

        return $this->modifyQuery(
            $model->manyRelation($this->related, $this->id)
        );
    }

    /**
     * Set related model.
     *
     * @param string $mode
     * @return void
     */
    public function model(string $model)
    {
        $this->related = $model;

        $this->loadRelatedConfig($model);
        $this->setRelation();

        $this->attributes['model'] = $model;

        if (!$this->query) {
            $this->query = $model::query();
        }

        return $this;
    }
}
