<?php

namespace App\Http\Filters;

class RedditImagesFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'search',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function search($value)
    {
        if ($value) {
            return $this->builder->where('title', 'like', "%$value%");
        }

        return $this->builder;
    }
}
