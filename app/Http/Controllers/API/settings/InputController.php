<?php

namespace App\Http\Controllers\API\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Input;

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //return inputs in terms of latest created
       return Input::orderBy('inputCreated','DESC')->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->inputs)
        {
            Input::updateOrCreate([
                'inputs'=>$request->inputs
            ]);
            return ('success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //edit inputs
        $existinginput = Input::find($request->id);
        
        $existinginput->update([
                'inputs' => $request->inputs,
            ]);
            return $existinginput;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existinginput = Input::find ( $id );
        //delete input
        if($existinginput){
            $existinginput -> delete();
            return "Input successfully deleted.";
        }
        return "Input not found";
    }
}
