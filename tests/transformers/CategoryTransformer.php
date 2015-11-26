<?php

namespace Themsaid\Transformers\Tests\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class CategoryTransformer extends AbstractTransformer
{
    public function transformModel(Model $item)
    {
        $output = [
            'name'       => $item->name,
            'dummy_item' => "I'm dummy",
        ];

        if ($val = @$this->options['add_me']) {
            $output['add_me'] = $val;
        }

        if ($item->relationLoaded('products')) {
            $output['products'] = ProductTransformer::transform($item->products);
        }

        return $output;
    }
}