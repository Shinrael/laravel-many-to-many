<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Functions\Helper;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati del modulo
        $validatedData = $request->validate([
            'title' => 'required|min:2|max:100',
            'body' => 'min:2',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'array',
            'technologies.*' => 'exists:technologies,id',
        ],
        [
           'title.required' => 'Devi inserire il nome della Tecnologia',
           'title.min' => 'Deve avere almeno :min caratteri',
           'title.max' => 'Deve avere al massimo :max caratteri',
           'body.min' => 'Deve avere almeno :min caratteri',
           'type_id.exists' => 'La tipologia selezionata non è valida',
            'technologies.array' => 'Le tecnologie devono essere un array',
            'technologies.*.exists' => 'Una delle tecnologie selezionate non è valida',
        ]);


        $exist = Project::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.projects.index')->with('error', 'Nome Tecnologia già esistente');
        } else{
            $new = new Project();
            $new->slug = Helper::generateSlug($new->title, Project::class);
            $new->fill($validatedData);
            $new->save();

            if(array_key_exists('technologies', $validatedData)){
                $new->technologies()->attach($validatedData['technologies']);
            }

            return redirect()->route('admin.projects.index')->with('success', 'Nome Progetto creato correttamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project','types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $val_data = $request->validate([
            'title' => 'required|min:2|max:100',
            'body' => 'min:2',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'array',
            'technologies.*' => 'exists:technologies,id',
        ],
        [
           'title.required' => 'Devi inserire il nome della Tecnologia',
           'title.min' => 'Deve avere almeno :min caratteri',
           'title.max' => 'Deve avere al massimo :max caratteri',
           'body.min' => 'Deve avere almeno :min caratteri',
           'type_id.exists' => 'La tipologia selezionata non è valida',
           'technologies.array' => 'Le tecnologie devono essere un array',
           'technologies.*.exists' => 'Una delle tecnologie selezionate non è valida',
        ]);

            $exist = Project::where('title', $request->title)->first();

            $val_data['slug'] = Helper::generateSlug($request->title, Project::class);
            $project->update($val_data);

            if (array_key_exists('technologies', $val_data)) {
                $project->technologies()->sync($val_data['technologies']);
            }

            return redirect()->route('admin.projects.show', $project)->with('success', 'Nome Progetto modificato correttamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato correttamente');
    }
}
