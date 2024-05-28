<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Functions\Helper;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
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
        $exist = Technology::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.technologies.index')->with('error', 'Nome Tecnologia già esistente');
        } else{
            $new = new Technology();
            $new->title = $request->title;
            $new->slug = Helper::generateSlug($new->title, Technology::class);
            $new->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Nome Tecnologia creata correttamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $val_data = $request->validate([
            'title' => 'required|min:2|max:100'
        ],
        [
           'title.required' => 'Devi inserire il nome della Tecnologia',
           'title.min' => 'Deve avere almeno :min caratteri',
           'title.max' => 'Deve avere al massimo :max caratteri',
        ]);

        $exist = Technology::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.technologies.index')->with('error', 'Nome Tecnologia già esistente');
        } else{
            $val_data['slug'] = Helper::generateSlug($request->title, Technology::class);
            $technology->update($val_data);

            return redirect()->route('admin.technologies.index')->with('success', 'Nome Tecnologia modificata correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Nome Tecnologia eliminata correttamente');
    }
}
