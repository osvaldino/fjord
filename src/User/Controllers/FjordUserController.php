<?php

namespace Fjord\User\Controllers;

use Illuminate\Http\Request;
use Fjord\Support\IndexTable;
use Fjord\User\Models\FjordUser;
use Fjord\User\Requests\FjordUserReadRequest;
use Fjord\User\Requests\FjordUserDeleteRequest;

class FjordUserController
{
    /**
     * Create new FjordUserController instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->config = fjord()->config('user.user_index');
    }

    /**
     * Show user index.
     *
     * @param FjordUserReadRequest $request
     * @return void
     */
    public function showIndex(FjordUserReadRequest $request)
    {
        $config = $this->config->get(
            'sortBy',
            'sortByDefault',
            'perPage',
            'index',
            'filter'
        );

        return view('fjord::app')->withComponent('fj-users')
            ->withTitle('Users')
            ->withProps([
                'config' => $config,
            ]);
    }

    /**
     * Delete multiple users.
     *
     * @param Request $request
     * @return void
     */
    public function deleteAll(FjordUserDeleteRequest $request)
    {
        IndexTable::deleteSelected(FjordUser::class, $request);

        return response([
            'message' => __f('fj.deleted_all', [
                'count' => count($request->ids)
            ])
        ]);
    }

    /**
     * Fetch index.
     *
     * @param Request $request
     * @return array
     */
    public function fetchIndex(FjordUserReadRequest $request)
    {
        return IndexTable::query($this->config->index_query)
            ->request($request)
            ->search($this->config->search)
            ->get();
    }
}
