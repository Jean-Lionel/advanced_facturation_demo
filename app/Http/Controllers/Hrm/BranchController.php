<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();

        $branches = collect($branches)->sortBy('title');

        return view('hrm.param.branch',compact('branches'));
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
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'qualification' => 'required',
        ],[
            'required' => 'Le champ :attribute est requis pour continuer'
        ]);


        if(!$validator->fails()){
            $data = $validator->safe()->all();

            $status = Branch::create([
                "title" => $data['title'],
                "qualification" => $data['qualification'],
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => auth()->id()
             ]);
    
            if($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'nouvelle branche ajouter!!'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'messages' => ["error" => 'Une erreur est survenue réessayer svp!!']
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'messages' => $validator->errors()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'qualification' => 'required',
        ],[
            'required' => 'Le champ :attribute est requis pour continuer'
        ]);

        if(!$validator->fails()){
            $data = $validator->safe()->all();

            $status = $branch->update([
                "title" => $data['title'],
                "qualification" => $data['qualification'],
            ]);
    
            if($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'Branche modifier!!'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'messages' => ["error" => 'Une erreur est survenue réessayer svp!!']
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'messages' => $validator->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        echo json_encode([
            'success' => true,
            'messages' => 'Branche supprimer'
        ]);
    }
}
