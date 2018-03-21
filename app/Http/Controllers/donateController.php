<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donators;

class donateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('donate1')->with('data', [])
            ->with('first', true)->with('last', true)
            ->with('method', 'put')->with('extension', '/1');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo __METHOD__ . " under construction.<br>";
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return int
     */
    public function store(Request $request)
    {
        $inputs = ['amount' => '', 'fullName' => '', 'email' => '', 'address'=>'', 'occupation' => '', 'employer' => ''];
        $data = new Donators();

        foreach ($inputs as $key => $val) {
            if ($request->has($key)) {
                $data->$key= $request->get($key);
            }
        }
        if($data->amount != '') {
            $data->decimalAmt = (float)$data->amount;
        }

        $data->save();
        echo 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo __METHOD__ . " under construction.<br>";
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
        // echo __METHOD__ . " under construction.<br>";
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
        $inputs = ['amount' => 'numeric', 'fullName' => 'isString', 'email' => 'isEmail', 'address'=>'isString', 'occupation' => 'isString', 'employer' => 'isString'];
        $json = new \stdClass();
        $errorsFound = false;
        $posted = [];
        foreach ($inputs as $key => $val) {
            if ($request->has($key)) {
                $err = $this->$val($request->get($key));
                $json->$key = $request->get($key);
                $posted[$key] = $request->get($key);
                $posted[$key."_err"] = $err;
                if($err != '') $errorsFound = true;
            } else {
                $posted[$key."_err"] = 'Please check this value.';
                $errorsFound = true;
            }
        }
        if($errorsFound || $posted['amount'] <= 0) return view('donate1')->with('data', [])
            ->with('first', true)->with('last', true)
            ->with('method', 'put')->with('extension', '/1')->with('posted', $posted);

        $json->_token = csrf_token();

        return view('donate2')->with('data', $json)->with('first', true)->with('last', true)->with('method', 'post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo __METHOD__ . " under construction.<br>";
        //
    }

    public function isEmail($value) {
        if(filter_var($value, FILTER_VALIDATE_EMAIL) === false) return "Please enter a valid email address.";
        return '';
    }

    public function isString($value) {
        if(strlen($value) == 0) return "Please check this field.";
        return '';
    }
    public function numeric($value) {
        if(is_numeric($value)) return '';
        return "Please enter a dollar value.";
    }
}
