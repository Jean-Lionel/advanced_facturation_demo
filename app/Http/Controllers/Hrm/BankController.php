<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();

        $banks = collect($banks)->sortBy('bank_name');
        // dd($banks[0]->user);

        return view('hrm.param.bank', compact('banks'));
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
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required'
        ], [
            'required' => 'Le champs du nom de la banque ne doit pas etre vide'
        ]);

        if (!$validator->fails()) {
            $data = $validator->safe()->only(['bank_name']);

            $status = Bank::create([
                "bank_name" => $data["bank_name"],
                "bank_code" => $request->bank_code,
                "created_by" => auth()->id()
            ]);

            if ($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'nouvelle banque ajouter!!',
                    'redirect' => redirect()->route('bank.index')->with('success', 'Banque ajouté avec succé')
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'messages' => 'Une erreur est survenue réessayer svp!!'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'messages' => $validator->errors()->get('bank_name')[0]
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required'
        ], [
            'required' => 'Le champs du nom de la banque ne doit pas etre vide'
        ]);

        if (!$validator->fails()) {
            $data = $validator->safe()->only(['bank_name']);

            $status = $bank->update([
                "bank_name" => $data["bank_name"],
                "bank_code" => $request->bank_code,
            ]);

            if ($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'banque modifié!!',
                    'redirect' => redirect()->route('bank.index')->with('success', 'Banque modifié avec succé')
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'messages' => 'Une erreur est survenue réessayer svp!!'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'messages' => $validator->errors()->get('bank_name')[0]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();

        echo json_encode([
            'success' => true,
            'messages' => 'Banque supprimé avec succé'
        ]);

        return redirect()->route('bank.index')->with('success', 'Banque supprimé avec succé');
    }
}
