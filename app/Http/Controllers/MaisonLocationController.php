<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaisonLocationStoreRequest;
use App\Http\Requests\MaisonLocationUpdateRequest;
use App\Models\MaisonLocation;
use Illuminate\Http\Request;

class MaisonLocationController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $maisonLocations = MaisonLocation::with(['clients'])
                                    ->whereHas('clients', function($query) use ($search) {
                                        if($search){
                                            $query->where('name', 'LIKE', "%{$search}%");
                                            
                                        }
                                    })
                                    ->orWhere(function($query) use ($search) {
                                        if($search){
                                            $query->where('name', 'LIKE', "%{$search}%");
                                            
                                        }
                                    })
                                    ->withCount('clients')
                                    ->latest()->paginate(10);

        return view('maisonLocation.index', compact('maisonLocations' , 'search'));
    }

    public function create(Request $request)
    {
        return view('maisonLocation.create');
    }

    public function store(MaisonLocationStoreRequest $request)
    {
        $maisonLocation = MaisonLocation::create($request->validated());
        $request->session()->flash('maisonLocation.id', $maisonLocation->id);

        return$this->index($request);
    }

    public function show(Request $request, MaisonLocation $maisonLocation)
    {
        return view('maisonLocation.show', compact('maisonLocation'));
    }


    public function edit(Request $request, MaisonLocation $maisonLocation)
    {

        return view('maisonLocation.edit', compact('maisonLocation'));
    }

    /**
     * @param \App\Http\Requests\MaisonLocationUpdateRequest $request
     * @param \App\Models\MaisonLocation $maisonLocation
     * @return \Illuminate\Http\Response
     */
    public function update(MaisonLocationUpdateRequest $request, MaisonLocation $maisonLocation)
    {
        dd($maisonLocation);
        $maisonLocation->update($request->validated());

        $request->session()->flash('maisonLocation.id', $maisonLocation->id);

        return redirect()->route('maisonLocation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MaisonLocation $maisonLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MaisonLocation $maisonLocation)
    {
        $maisonLocation->delete();

        return redirect()->route('maisonLocation.index');
    }
}
