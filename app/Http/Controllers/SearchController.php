<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('inventory\search');
    }

    /**
     * search records in database and display  results
     * @param  Request $request [description]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search( Request $request)
    {

        $searchterm = $request->input('query');

        $searchResults = (new Search())
            ->registerModel(\App\Item::class, 'name')
            ->perform($searchterm);

        return view('inventory/search', compact('searchResults', 'searchterm'));
    }
}
