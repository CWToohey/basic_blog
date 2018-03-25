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
        $post = posts::where('isPost','=','1')->orderBy('id', 'desc')->take(2)->get();
        if ($post != null) {
            $post = $post->toArray();
            if (count($post) > 1) $first = false; else $first = true;
            if (count($post) > 0) $post = $post[0]; else $post = ['id' => -1, 'title' => '', 'content' => ''];


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
            if(!($request->has('prev') || $request->has('next'))) {
                $prv = '<=';
                $nxt = '>=';
            } elseif ($request->has('next')) {
                $prv = '<=';
            } elseif ($request->has('prev')) {
                $nxt = '>=';
            }

            $newPost[0] = posts::where('isPost','=','1')->where('id', $prv, $request->get('id'))->orderBy('id', 'desc')->take(2)->get()->toArray();
            if (count($newPost[0]) < 2) $first = true;

            $newPost[1] = posts::where('isPost','=','1')->where('id', $nxt, $request->get('id'))->orderBy('id', 'asc')->take(2)->get()->toArray();

            if (count($newPost[1]) < 2) $last = true;

            if(!($request->has('prev') || $request->has('next'))) {
                $post = posts::where('id','=', $request->get('id'))->first();
                if($post) {
                    $picsPath = $this->getPic($post);
                    if(!$post['isPost']) {
                        $first = true;
                        $last = true;
                    }
                    return view('homepage')
                        ->with('subtitle', $post['title'])->with('content', $post['content'])
                        ->with('pics', $picsPath)->with('id', $post['id'])
                        ->with('last', $last)->with('first', $first);
                }
            }


            if ($request->has('next')) {
                $post = $newPost[1][0];
                if (count($newPost[0]) < 1) $first = true; else $first = false;
                $picsPath = $this->getPic($post);
            } elseif ($request->has('prev') && count($newPost[0])) {
                $post = $newPost[0][0];
                if (count($newPost[1]) < 1) $last = true; else $last = false;
                $picsPath = $this->getPic($post);
            } elseif (!($request->has('next') || $request->has('prev'))) {
                $newPost[0] = posts::where('isPost','=','1')->where('id', '=', $request->get('id'))->orderBy('id', 'asc')->take(1)->get()->toArray();
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

    public function getArchives(Request $request, $notFound = '')
    {
        $count = 50;
        if ($request->has('lastId')) {
            $lastSearched = $request->get('lastId');
        } else {
            $lastSearched = 0;
        }
        $largestId = posts::where('isPost','=','1')->orderBy('id', 'desc')->first();
        if ($largestId != null) $largestId = $largestId->toArray();

        if ($request->has('dir') && $request->get('dir') == "R" && $largestId['id'] <= $lastSearched) {
            $lastSearched = $largestId['id'] - $count;
        }

        $posts = posts::where('isPost','=','1')->where('id', '>', $lastSearched)->orderBy('id','desc')->take($count)->get();
        if ($posts != null) $posts = $posts->toArray(); else $posts = [];

        $lastSearched = end($posts)['id'];

        $archived = posts::where('isPost','=','0')->orderBy('id','desc')->take(1)->get();
        if($archived != null) $archived = $archived->toArray();

        $posts = array_merge($archived, $posts);

        return view('archived')
            ->with('posts', $posts)->with('lastId', $lastSearched)
            ->with('largest', $largestId['id'])->with('archiveCount', $count)->with('notFound', $notFound);

    }

    public function getBio()
    {
        $post = posts::where('isPost','=','0')
            ->leftJoin('pics', 'pics.id', '=', 'posts.pics')
            ->orderBy('posts.id', 'desc')->first()->toArray();
//        var_dump($post);

        return view('homepage')
            ->with('subtitle', $post['title'])->with('content', $post['content'])
            ->with('pics', [$post['path']])->with('id', $post['id'])
            ->with('last', true)->with('first', true);

//        'id' => int 8
//  'title' => string 'With a picture' (length=14)
//  'isPost' => int 0
//  'content' => string 'Newer bio' (length=9)
//  'pics' => int 8
//  'created_at' => string '2018-03-23 17:44:30' (length=19)
//  'updated_at' => string '2018-03-23 17:44:30' (length=19)
//  'deleted_at' => null
//  'path' => string 'images/2018_03_23/images.jpeg' (length=29)


    }

}
