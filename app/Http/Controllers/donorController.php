<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donators;
use Mail;

class donorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('getDates')->with('first', true)->with('last', true);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo __METHOD__ . "<br>";
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
        $posts = [
            'starting' => $request->get('starting'),
            'ending' => $request->get('ending')
        ];
        $starting = date("Y-m-d 00:00:00", strtotime($posts['starting']));
        $ending = date("Y-m-d 23:59:59", strtotime($posts['ending']));

        $donations = donators::select('decimalAmt', 'fullName', 'email', 'address', 'occupation', 'employer', 'created_at')->where('created_at', '<=', $ending)->where('created_at', '>=', $starting)->get();
        if ($donations) {
            $donations = $donations->toArray();
            // Send donations.
            foreach ($donations as $key => $val) {
                $donations[$key]['dollarAmt'] = "$ " . money_format('%i', $val['decimalAmt']);
            }

            $subject = 'Donations from '.$starting.' to '.$ending;
//            Mail::send('sendDonors', ['donors' => $donations], function ($message) use ($subject, $donations) {
//                $message->from('noreply@noreply.net', '');
//                $message->subject($subject);
//            });

        }

//        return view('sendDonors')->with('donors', $donations);

        return view('getDates')
            ->with('first', true)
            ->with('last', true)
            ->with('test', $donations)
            ->with('posted', $posts)
            ->with('donors', count($donations));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo __METHOD__ . "<br>";
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
        echo __METHOD__ . "<br>";
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
        echo __METHOD__ . "<br>";
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
        echo __METHOD__ . "<br>";
        //
    }
}
