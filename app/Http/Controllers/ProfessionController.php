<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = 'Professions';
        $mode = 'view';

        $professions = Profession::paginate(5);

        return view('admin.profession.index', compact('title', 'professions', 'mode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required'
        ]);

        $profession = new Profession();
        $profession->title = $request->title;
        $profession->save();

        return redirect()->route('profession.index')->with('message', 'Profession Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profession $profession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profession $profession)
    {
        //
        $title = 'Edit Profession';
        $mode = 'edit';
        $professions = Profession::paginate(5);
        return view('admin.profession.index', compact('title', 'profession', 'professions', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profession $profession)
    {
        //
        $request->validate([
            'title' => 'required'
        ]);

        $profession->title = $request->title;
        $profession->save();
        return redirect()->route('profession.index')->with('message', 'Profession Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profession $profession)
    {
        //
        $profession->delete();
        return redirect()->route('profession.index')->with('message', 'Profession Deleted Successfully');
    }
}
