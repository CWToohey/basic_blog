<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contacts;
use Illuminate\Support\Facades\URL;

class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact')
            ->with('first', true)
            ->with('last', true);
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
        $good = true;
        $fields = ['FullName', 'email', 'phone', 'address', 'message'];
        $message = [];

        foreach ($fields as $key) {
            if ($request->has($key)) {
                $message[$key] = $request->get($key);
            } else {
                $message[$key] = '';
                $good = false;
                break;
            }
        }

        if (filter_var($message['email'], FILTER_VALIDATE_EMAIL) === false) {
            $good = false;
            $message['email_err'] = "Please enter a valid email address.";
        }

        if ($good) {
            $contact = new contacts();
            foreach ($message as $key => $value) {
                $contact->$key = $value;
            }
            $contact->save();
            // send email.
        } else {

            return view('contact')
                ->with('posted', $message)
                ->with('first', true)
                ->with('last', true);
        }
        return view('contactThankyou')->with('first', true)->with('last', true);
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
