<?php

namespace Dlogon\TranslationManager\Http\Controllers;

use Dlogon\TailwindAlerts\Facades\TailwindAlerts;
use Illuminate\Http\Request;
use Dlogon\TranslationManager\Models\Group;
use Illuminate\Support\Facades\Session;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return \view("translation-manager::groups", \compact("groups"));
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
        $groupName = $request->name;
        $groupType = Group::DEFAULT_TYPE;

        $dbPrefix = config("translation-manager.db_prefix", "translations");

        $validated = $request->validate([
            'name' => "required|unique:{$dbPrefix}_groups,name",
        ]);

        if(!$validated)
        {
            TailwindAlerts::addSessionMessage("Group already added", TailwindAlerts::ERROR);
        }

        Group::create([
            "name" => $groupName,
            "type" => $groupType
        ]);

        TailwindAlerts::addSessionMessage("Group Added successfuly", TailwindAlerts::SUCCESS);
        return \redirect()->back();
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
    public function update(Request $request, $id)
    {
        //
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
