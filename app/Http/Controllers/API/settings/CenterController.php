<?php

namespace App\Http\Controllers\API\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BulkingCenter;
use GrahamCampbell\ResultType\Success;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return bulking centers in terms of latest center created
        return BulkingCenter::orderBy('centerCreated','DESC')->get();
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
        //save center created
        // $newCenter = new BulkingCenter();
        // $newCenter -> name = $request -> center["name"];
        // $newCenter -> address = $request -> center["address"]; 
        // $newCenter -> collectionagent = $request -> center["collectionagent"];
        // $newCenter -> save();
        // return $newCenter;

        $newCenter = BulkingCenter::create([
            'name' => $request->name,
            'address' => $request->address,
            'collectionagent' => $request->collectionagent
        ]);
        return ('created');
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
        //edit new center created
            //edit inputs
        $existingcenter = BulkingCenter::find($request->id);

        $existingcenter->update([
            'name' => $request->name,
            'address' => $request->address,
            'collectionagent' => $request->collectionagent,
        ]);
      
        return "success";
    }
    public function getCenters()
    {
        $all = BulkingCenter::all()->count();
        return response()->json(compact('all'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingcenter = BulkingCenter::find( $id );

        //delete center
        if($existingcenter){
            $existingcenter -> delete();
            return "Center succesfully deleted.";
        }
        return "Center not found";
    }
}
