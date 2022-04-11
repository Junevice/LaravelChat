<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Group::whereHas('users', function($query) {
            $query->where('user_id', Auth::guard('web')->user()->id);
        })->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->name==""){
            $group_name="Nouvelle conversation";
        }
        else{
            $group_name=$request->name;
        }

        $group = Group::create([
            'name'=>$group_name,
        ]);

        $users = $request->users;
        foreach($users as $user){
            $group->users()->attach($user['id']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $group->update($request->only([
            'name',
        ]));

        $users = $request->users;
        $usersync=[];
        foreach($users as $user){
            array_push($usersync, $user['id']);
        }
        $person->users()->sync($usersync);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return response()->noContent();
    }
}
