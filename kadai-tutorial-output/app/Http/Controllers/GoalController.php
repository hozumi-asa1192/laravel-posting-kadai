<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // AuthファサードAuth::user()で現在ログイン中のユーザーをgetできる(user()はメソッド)
        $goals= Auth::user()->goals;
        $tags = Auth::user()->tags;

        // goals.index←これは、フォルダ名.ファイル名
        return view('goals.index',compact('goals','tags'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
        ]);

        $goal = new Goal();
        $goal->title = $request->input('title');
        // ログイン中のユーザーIDをuser_idに代入する
        $goal->user_id = Auth::id();
        $goal->save();

        return redirect()->route('goals.index');
    }

    

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
       $request->validate([
        'title' => 'required',
       ]);

       $goal->title = $request->input('title');
       $goal->user_id = Auth::id();
       $goal->save();

       return redirect()->route('goals.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();

        return redirect()->route('goals.index');
    }
}
