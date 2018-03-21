<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pics;
use App\posts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = posts::orderBy('id', 'desc')->take(2)->get();
        if ($post != null) {
            $post = $post->toArray();
            if (count($post) > 1) $first = false; else $first = true;
            $post = $post[0];

        } else {
            $post = ['id' => -1, 'title' => '', 'content' => ''];
            $first = true;
        }

        $picsPath = $this->getPic($post);

        return view('homepage')
            ->with('subtitle', $post['title'])->with('content', $post['content'])
            ->with('pics', $picsPath)->with('id', $post['id'])->with('last', true)->with('first', $first);
    }

    public function nextPrev(Request $request)
    {
        if ($request->has('id')) {
            $last = $first = false;

            $nxt = '>';
            $prv = '<';
            if ($request->has('next')) {
                $prv = '<=';
            } elseif($request->has('prev')) {
                $nxt = '>=';
            }

            $newPost[0] = posts::where('id', $prv, $request->get('id'))->orderBy('id', 'desc')->take(2)->get()->toArray();
            if (count($newPost[0]) < 2) $first = true;

            $newPost[1] = posts::where('id', $nxt, $request->get('id'))->orderBy('id', 'asc')->take(2)->get()->toArray();
            if (count($newPost[1]) < 2) $last = true;

            if ($request->has('next')) {
                $post = $newPost[1][0];
                if(count($newPost[0][0]) < 1) $first = true; else $first = false;
                $picsPath = $this->getPic($post);
            } elseif ($request->has('prev') && count($newPost[0])) {
                $post = $newPost[0][0];
                if(count($newPost[1][0]) < 1) $last = true; else $last = false;
                $picsPath = $this->getPic($post);
            } elseif (count($newPost[0]) == 0) {
                $newPost[0] = posts::where('id', '=', $request->get('id'))->orderBy('id', 'asc')->take(1)->get()->toArray();
                $post = $newPost[0][0];
                $picsPath = $this->getPic($post);
            } else {
                $picsPath = '';
                $post = ['id' => 0, 'content' => '', 'title' => ''];
            }

        } else return $this->index();

        return view('homepage')
            ->with('subtitle', $post['title'])->with('content', $post['content'])
            ->with('pics', $picsPath)->with('id', $post['id'])
            ->with('last', $last)->with('first', $first);
    }

    public function getPic(&$post)
    {
        $pic = [];
        if (isset($post['pics'])) {
            $path = pics::find($post['pics']);
            if ($path) $pic[] = $path->path;
        }
        return $pic;
    }

    public function getArchives(Request $request)
    {
        $count = 3;
        if ($request->has('lastId')) {
            $lastSearched = $request->get('lastId');
        } else {
            $lastSearched = 0;
        }
        $largestId = posts::orderBy('id', 'desc')->first();
        if ($largestId != null) $largestId = $largestId->toArray();

        if ($request->has('dir') && $request->get('dir') == "R" && $largestId['id'] <= $lastSearched) {
            $lastSearched = $largestId['id'] - $count;
        }

        $posts = posts::where('id', '>', $lastSearched)->take($count)->get();
        if ($posts != null) $posts = $posts->toArray(); else $posts = [];

        $lastSearched = end($posts)['id'];

        return view('archived')
            ->with('posts', $posts)->with('lastId', $lastSearched)
            ->with('largest', $largestId['id'])->with('archiveCount', $count);

    }

}
