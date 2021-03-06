<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Fjord\Crud\Models\FormRelation;

$factory->define(FormRelation::class, function (Faker $faker, $args) {
    if (!array_key_exists('name', $args)) {
        throw new InvalidArgumentException('Missing parameter "name".');
    }
    if (!array_key_exists('from', $args)) {
        throw new InvalidArgumentException('Missing parameter "from".');
    }
    if (!array_key_exists('to', $args)) {
        throw new InvalidArgumentException('Missing parameter "to".');
    }

    //$field_id = $args['name'];
    //   unset($args['name']);

    return [
        'field_id' => $args['name'],
        'from_model_id' => $args['from']->id,
        'from_model_type' => get_class($args['from']),
        'to_model_id' => $args['to']->id,
        'to_model_type' => get_class($args['to']),
    ];
});

$factory->afterMaking(FormRelation::class, function (FormRelation $relation) {
    $attributes = $relation->getAttributes();
    unset($attributes['name']);
    unset($attributes['from']);
    unset($attributes['to']);
    $relation->setRawAttributes($attributes);
});
