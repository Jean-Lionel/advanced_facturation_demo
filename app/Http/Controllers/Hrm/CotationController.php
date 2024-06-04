<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Cotation;
use App\Models\Payroll;
use App\Models\Indeminity;
use App\Models\TypeCotation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cotations = Cotation::all();
        $employees = Employee::active()->select('employee_id','first_name','last_name')->get();
        $typeCotations = TypeCotation::select('type_cotation_id','title')->get();

        return view('hrm.cotation.list', [
            'cotations' => $cotations,
            'employees' => $employees,
            'typeCotations' => $typeCotations,
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
            "category" => "required",
        ],[
            "required" => "Le champ :attribute est requis",
        ]);

        if(!$validated->fails()){
            $data = $validated->safe()->all();

            $cotation = Cotation::create([
                'employee_id' => $data['employee'],
                'type_cotation' => $data['category'],
                'note_cotation' => $request->note,
                'created_date' => date('Y-m-d H:i:s'),
                "created_by" => auth()->id(),
                'cotation_status' => 0
            ]);

            if($cotation) {
                echo json_encode([
                    "success" => true,
                    "messages" => "Cotation de l'employé enregistré avec succés"
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
     * @param  \App\Models\Cotation  $cotation
     * @return \Illuminate\Http\Response
     */
    public function show(Cotation $cotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cotation  $cotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotation $cotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cotation  $cotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotation $cotation)
    {
        if ($request->action == "update") {
            $validated = Validator::make($request->all(),[
                "employee" => "required",
                "category" => "required",
            ],[
                "required" => "Le champ :attribute est requis",
            ]);
    
            if(!$validated->fails()){
                $data = $validated->safe()->all();
    
                $status = $cotation->update([
                    'employee_id' => $data['employee'],
                    'type_cotation' => $data['category'],
                    'note_cotation' => $request->note,
                ]);
    
                if($status) {
                    echo json_encode([
                        "success" => true,
                        "messages" => "Cotation de l'employé modifié avec succés"
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
        } else if($request->action == "confirm") {
            $result = $this->confirmCotation($cotation);

            if($result) {
                echo json_encode([
                    "success" => true,
                    "messages" => "cotation de l'employé confirmé avec succées",
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "messages" => "Une erreur est survenue réessayer svp!!",
                ]);
            }
        } else if($request->action == "reject"){
            $result = $this->rejectCotation($cotation);

            if($result) {
                echo json_encode([
                    "success" => true,
                    "messages" => "cotation de l'employé avec succées",
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "messages" => "Une erreur est survenue réessayer svp!!",
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cotation  $cotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotation $cotation)
    {
        $cotation->delete();

        echo json_encode([
            "success" => true,
            "messages" => "La cotation a été supprimé avec succès"
        ]);
    }

    private function confirmCotation($cotation){
        $result = $this->calculateNewSalaryInfo($cotation);
 
        if($result) {
            return $cotation->update([
                'cotation_status' => 1,
                'confirmation_or_reject_date' => date('Y-m-d H:i:s'),
                'confirmed_by' => auth()->id()
            ]);
        } else {
            return false;
        }
        // todo
        // calculate new basic salary
    }

    private function rejectCotation($cotation){
        return $leave->update([
            'cotation_status' => 2,
			'confirmation_or_reject_date' => date('Y-m-d H:i:s'),
			'rejected_by' => auth()->id()
        ]);
    }

    private function calculateNewSalaryInfo($cotation) {
        $indeminities = collect(Indeminity::all());
        $maxGrossSalary = 450000;
        $maxGrossSalaryRisq = 80000;
        $innssEmployee = 4;
        $innssEmployer = 6;
        $innssRisq = 3;

        $mfpEmployeePerc = 4;
        $mfpEmployerPerc = 6;
        $salary = $cotation->employee->salary;
        $cotation_perc = $cotation->type->percentage;
        $new_basic_salary = $salary->basic_salary + (($salary->basic_salary * $cotation_perc)/100);
        $allowances = explode(',',$salary->transport_allowance);
        $pension_complementaire = $salary->pension_complementaire;
        $totalAllowances = 0;
        foreach ($allowances as $value) {
            $val = $indeminities->firstWhere('type_indeminite_id',$value);
            $totalAllowances += round(($new_basic_salary * $val->percentage)/100);
        }

        $gross_salary = $new_basic_salary + $totalAllowances;

        $mfpEmployee = round((($gross_salary - round(($new_basic_salary * 60)/100)) * $mfpEmployeePerc)/100);
        $mfpPatronal = round((($gross_salary - round(($new_basic_salary * 60)/100)) * $mfpEmployerPerc)/100);

        $mfp = $mfpEmployee + $mfpPatronal;

        $pension_salariale = 0;
        $pension_patronale = 0;
        $risque_professionel = 0;

        if($gross_salary <= $maxGrossSalary) {
            $pension_salariale = round(($gross_salary  * $innssEmployee)/100);
            $pension_patronale = round(($gross_salary  * $innssEmployer)/100);
        } else {
            $pension_salariale = round(($maxGrossSalary  * $innssEmployee)/100);
            $pension_patronale = round(($maxGrossSalary  * $innssEmployer)/100);
        }

        if($gross_salary <= $maxGrossSalaryRisq) {
            $risque_professionel = round(($gross_salary  * $innssRisq)/100);
        } else {
            $risque_professionel = round(($maxGrossSalaryRisq  * $innssRisq)/100);
        }

        $inss = $pension_salariale + $pension_patronale + $risque_professionel;

        $tax_base = $gross_salary - $pension_salariale - $mfpEmployee - $totalAllowances;

        $IPR = 0;

        $caisse_sociale = 5000;

        if($tax_base >= 0 && $tax_base <= 150000) {
            $IPR = 0;
        } else if($tax_base >= 150000 && $tax_base <= 300000){
            $IPR = round(($tax_base - 150000) * 20 / 100);
        } else if($tax_base > 300000){
            $IPR = round((($tax_base - 300000 ) * 30 / 100) + 30000);
        }

        if($IPR < 0){
            $IPR =0;
        }

        $net_salary = $gross_salary - $pension_salariale - $mfpEmployee - $IPR - $pension_complementaire;

        $save_data = [
            "basic_salary" => $new_basic_salary,
            "brut_salary" => $gross_salary,
            "net_salary" => $net_salary,
        ];
        $salary = Payroll::where('employee_id',$cotation->employee_id)
                    ->update($save_data);

        return $salary;
    }
}
