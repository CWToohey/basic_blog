<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Auth;
use App\pics;
use App\posts;

class adminController extends Controller
{
    protected $fileFormats;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->fileFormats = ['jpeg', 'jpg', 'pdf', 'png'];
    }

    public function index()
    {
        return view('home')->with('method', 'post')->with('posted', [])->with('extension', '');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo __METHOD__ . "<br";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('title') && $request->has('textContent') && $request->get('title') != '' && $request->get('textContent') != '') {

            $picsId = 0;
            $picsPath = $this->getPicsPath($request, $picsId);
            $posts = new posts();
            $posts->title = $request->get('title');
            $posts->content = $request->get('textContent');
            if($request->has('isBio')) $posts->isPost = ($request->get('isBio')+1)%2;
            $posts->pics = $picsId;
            $posts->save();

            return view('homepage')->with('subtitle', $posts->title)
                ->with('content', $posts->content)->with('pics', $picsPath)->with('id', $posts->id)
                ->with('last', true)->with('first', false);
        }

        $posted = ['title'=>$request->get('title'), 'content'=>$request->get('textContent'), 'isBio'=>$request->get('isBio')];
        return view('home')->with('method', 'post')->with('posted', $posted)->with('extension', '')->with('missing','Please enter both title and text.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $checkPost = '<=';
        } else $checkPost = '=';

        $post = posts::where('posts.id', '=', $id)->where('isPost',$checkPost,'1')->leftJoin('pics', function ($join) {
            $join->on('pics.id', '=', 'posts.pics');
        })->get()->toArray();
        if (count($post) == 0) return redirect(URL::to('/'));

        return view('home')->with('method', 'PUT')->with('posted', $post[0])->with('extension', '/' . $id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo __CLASS__ . " " . __METHOD__ . " ID: " . $id . "<br>";
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
        $posts = posts::where('id', '=', $id)->first();
        $posts->title = $request->title;
        $posts->content = $request->textContent;
        if($request->has('isBio')) $posts->isPost = ($request->get('isBio')+1)%2;
        $pics = $posts->pics;
        $picsPath = $this->getPicsPath($request, $pics);
        if(count($picsPath)) {
            $posts->pics = $pics;
        }
        $posts->save();
        return redirect(URL('changePost?id=' . $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        echo __CLASS__ . " " . __METHOD__ . " " . $id . "<br>";
        $post = posts::find($id);
        if($post) {
            $pic = pics::find($post->pics);
            if($pic) $pic->delete();
            $post->delete();
        }
        return redirect(URL('/'));
    }


    private function getPicsPath(Request &$request, &$id)
    {
        $picsPath = [];
        if ($request->hasFile('anImage')) {
            $path = 'images/' . date('Y_m_d');
            $fileName = $request->file('anImage')->getClientOriginalName();
            $extension = strtolower($request->anImage->getClientOriginalExtension());

            if (in_array($extension, $this->fileFormats)) {
                $request->file('anImage')->storeAs($path, $fileName, 'public_uploads');
                if ($id == 0) {
                    $pics = new pics();
                    $pics->path = $path . "/" . $fileName;
                    $pics->save();
                    $id = $pics->id;
                } else {
                    $pics = pics::where('id', '=', $id)->first();
                    $pics->path = $path . "/" . $fileName;
                    $pics->save();
                }
                $picsPath = [$pics->path];
            }
        }
        return $picsPath;
    }
}
