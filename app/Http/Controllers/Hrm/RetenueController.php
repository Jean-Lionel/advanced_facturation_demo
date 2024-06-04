<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Retenue;
use App\Models\Employee;
use App\Models\TypeRetenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RetenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retenues = Retenue::all();
        $employees = Employee::active()->select('employee_id','first_name','last_name')->get();
        $typeRetenues = TypeRetenue::select('id_retenue_type','name_retenue_type')->get();

        return view('hrm.deduction.index', [
            'retenues' => $retenues,
            'employees' => $employees,
            'typeRetenues' => $typeRetenues,
        ]);
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
        $validated = Validator::make($request->all(),[
            "employee" => "required",
            "retenue" => "required",
            "montant" => "required"
        ],[
            "required" => "Le champ :attribute est requis",
            "retenue.required" => "Le champ Déduction est requis"
        ]);

        if(!$validated->fails()){
            $data = $validated->safe()->all();

            $retenue = Retenue::create([
                "retenue_id" => $data["retenue"],
                "employee_id_in_retenue" => $data["employee"],
                "retenue_amount" => $data["montant"],
                "retenue_month" => !empty($request->month) ? date('m-Y',strtotime($request->month)) : date('m-Y'),
                "created_by" => auth()->id(),
                "created_at" => date('Y-m-d H:i:s')
            ]);

            if($retenue) {
                echo json_encode([
                    "success" => true,
                    "messages" => "Déduction enregistré avec succés",
                    "redirect" => redirect("retenue.index")->with('success', 'Déduction enregistré avec succés')
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
                'messages' => $validated->errors()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Retenue  $retenue
     * @return \Illuminate\Http\Response
     */
    public function show(Retenue $retenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retenue  $retenue
     * @return \Illuminate\Http\Response
     */
    public function edit(Retenue $retenue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Retenue  $retenue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retenue $retenue)
    {
        $validated = Validator::make($request->all(),[
            "employee" => "required",
            "retenue" => "required",
            "montant" => "required"
        ],[
            "required" => "Le champ :attribute est requis",
            "retenue.required" => "Le champ Déduction est requis"
        ]);

        if(!$validated->fails()){
            $data = $validated->safe()->all();

            $status = $retenue->update([
                "retenue_id" => $data["retenue"],
                "employee_id_in_retenue" => $data["employee"],
                "retenue_amount" => $data["montant"],
                "retenue_month" => !empty($request->month) ? date('m-Y',strtotime($request->month)) : date('m-Y'),
            ]);

            if($status) {
                echo json_encode([
                    "success" => true,
                    "messages" => "Déduction Modifié avec succés",
                    "redirect" => redirect('retenue.index')->with('success', 'Déduction Modifié avec succés')
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
                'messages' => $validated->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retenue  $retenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retenue $retenue)
    {
        $retenue->delete();

        return redirect()->route('retenue.index')->with('success', 'La déduction a été supprimé avec succès');
    }
}
