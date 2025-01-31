<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Item extends Model implements Searchable
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('itemDetail', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
