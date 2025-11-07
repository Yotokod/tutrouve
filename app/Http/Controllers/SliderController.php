<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Slider;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $sliders = Slider::all();
    return view('backend.slider.index', compact('sliders'));
}


    /**
     * Show the form for creating a new resource.
     */
 public function create()
{
    return view('backend.slider.create');
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'link' => 'nullable|url',
        'titre' => 'nullable|string',
        'description' => 'nullable|string',
    ]);

  $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
    $request->file('image')->move(public_path('sliders'), $imageName);

    // Créer un nouveau slider
    Slider::create([
        'image' => $imageName,
        'link' => $request->link,
        'titre' => $request->titre,
        'description' => $request->description
    ]);

    return redirect()->route('sliders.index')->with('success', 'Slider créé avec succès.');
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
   public function edit(Slider $slider)
{
    return view('backend.slider.edit', compact('slider'));
}


    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, Slider $slider)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'link' => 'nullable|url',
        'titre' => 'nullable|string',
        'description' => 'nullable|string'
    ]);

     if ($request->hasFile('image')) {
        // Supprimer l'ancienne image s'il y en a une
        if (file_exists(public_path($slider->image))) {
            unlink(public_path($slider->image));
        }

        // Enregistrer la nouvelle image
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('sliders'), $imageName);
        $slider->update(['image' => 'sliders/' . $imageName]);
    }

    // Mettre à jour le lien
    $slider->update([
        'link' => $request->link,
        'titre' => $request->titre,
        'description' => $request->description
    ]);

    return redirect()->route('sliders.index')->with('success', 'Slider mis à jour avec succès.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $slider = Slider::find($id);

        if (!$slider) {
            return response()->json([
                'message' => 'Slider introuvable.',
            ], 404);
        }

        // Supprimer le slider
        $slider->delete();
 return redirect()->route('sliders.index')->with('success', 'Slider supprimé avec succès.');
    }
}
