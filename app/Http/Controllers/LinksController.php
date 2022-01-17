<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return Inertia::render('Links/Index', [
            'links' => $user->links()->paginate(9),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Links/Create');
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
            'name' => ['nullable'],
            'url' => ['required'],
            'description' => ['nullable'],
            // 'thumbnail' => ['nullable', 'image'],
        ]);

        $request->user()->links()->create([
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description,
            // 'thumbnail_path' => Request::file('thumbnail') ? Request::file('thumbnail')->store('links') : null,
        ]);

        return redirect()->route('links.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int Link $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return Inertia::render('Links/Edit', [
            'link' => [
                'id' => $link->id,
                'name' => $link->name,
                'url' => $link->url,
                'description' => $link->description,
                // 'thumbnail' => $link->thumbnail_path ? URL::route('image', ['path' => $user->thumbnail_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int Link $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        $data = $request->validate([
            'name' => ['nullable'],
            'url' => ['required'],
            'description' => ['nullable'],
            // 'thumbnail' => ['nullable', 'image'],
        ]);

        $request->user()->links()->update($data);
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int Link $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('links.index');
    }
}
