<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\testlist;
use App\Deliverables;
use DB;

class DeliverablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Deliverables = DB::table('deliverables')->orderBy('order', 'asc')->get();

        $DeliverablesTodo = $Deliverables->filter(function($Deliverables, $key) {
            return $Deliverables->stage == 1;
        })->values();

        $DeliverablesDoing = $Deliverables->filter(function($Deliverables, $key) {
            return $Deliverables->stage == 2;
        })->values();
        
        $DeliverablesDone = $Deliverables->filter(function($Deliverables, $key) {
            return $Deliverables->stage == 3;
        })->values();

        return view('welcome')->with([  'Deliverables' => $Deliverables, 
                                        'DeliverablesTodo' => $DeliverablesTodo, 
                                        'DeliverablesDoing' => $DeliverablesDoing,
                                        'DeliverablesDone' => $DeliverablesDone
                                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $Deliverable = new Deliverables;
        $Deliverable->title = $request->deliverables['title'];
        $Deliverable->order = $request->deliverables['order'];
        $Deliverable->stage = $request->deliverables['stage'];
        return response('Update Successful.', 200);
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $DeliverablesBE = Deliverables::all();
        foreach($DeliverablesBE as $itemBE) {
            $id = $itemBE->id;
            foreach($request->deliverables as $itemFE) {
                if($itemFE['id'] == $id) {
                    $itemBE->update(['order' => $itemFE['order']]);
                }
            }
        }

        return response('Update Successful.', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deliverables $Deliverables
     * @return \Illuminate\Http\Response
     */
    public function visibility(Request $request, Deliverables $Deliverables)
    {    
        $Deliverables->stage = $request->stage;
        $Deliverables->save();
        return response('Update Successful.', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
