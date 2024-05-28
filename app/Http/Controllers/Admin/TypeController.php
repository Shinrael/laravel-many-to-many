<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Functions\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    public function typeProjects(){
        $types = Type::all();
        return view('admin.types.type-projects', compact('types'));
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
        $exist = Type::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.types.index')->with('error', 'Nome Tipo già esistente');
        } else{
            $new = new Type();
            $new->title = $request->title;
            $new->slug = Helper::generateSlug($new->title, Type::class);
            $new->save();

            return redirect()->route('admin.types.index')->with('success', 'Nome Tipo creato correttamente');
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
    public function update(Request $request, Type $type)
    {
        $val_data = $request->validate([
            'title' => 'required|min:2|max:100'
        ],
        [
           'title.required' => 'Devi inserire il nome del Tipo',
           'title.min' => 'Deve avere almeno :min caratteri',
           'title.max' => 'Deve avere al massimo :max caratteri',
        ]);

        $exist = Type::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.types.index')->with('error', 'Nome Tipo già esistente');
        } else{
            $val_data['slug'] = Helper::generateSlug($request->title, Type::class);
            $type->update($val_data);

            return redirect()->route('admin.types.index')->with('success', 'Nome Tipo modificato correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Tipo eliminato correttamente');
    }
}
