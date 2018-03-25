<?php

namespace App\Http\Controllers;

use App\posts;
use Illuminate\Http\Request;

class searchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notFound = '';
        if ($request->has('searchFor')) {
            $posts = posts::where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->get('searchFor') . '%')
                    ->orWhere('content', 'like', '%' . $request->get('searchFor') . '%');
            })
                ->where('isPost', '=', '1')
                ->orderBy('id', 'desc')->get();
            if ($posts != null && count($posts) > 0) {
                $posts = $posts->toArray();
                return view('archived')
                    ->with('posts', $posts)->with('lastId', 0)
                    ->with('largest', $posts[0]['id'])->with('archiveCount', count($posts));
            }
            $notFound = $request->get('searchFor');
        }

        $homeController = new HomeController();
        return $homeController->getArchives($request, $notFound);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
