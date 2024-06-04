<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Helpers\AppHelper;
use App\Models\Employee;
use App\Models\Poste;
use App\Models\Retenue;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Indeminity;
use App\Models\Payroll;
use Illuminate\Http\Request;
use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PayslipController extends Controller
{
    public function index(Request $request){
        $search = $request->query('search');
        $month = empty($request->query('month')) ? '' : date('m-Y',strtotime($request->query('month')));
        $status = $request->query('status');

        $where = "";
        $where .= empty($search) ? "" : ($where == "" ? "WHERE CONCAT(hrm_employee.last_name,'',hrm_employee.first_name) like '%{$search}%'" : " AND CONCAT(hrm_employee.last_name,'',hrm_employee.first_name) like '%{$search}%'");
        $where .= empty($month) ? "" : ($where == "" ? "WHERE hrm_salary_payment.month_year = '{$month}'" : " AND hrm_salary_payment.month_year = '{$month}'");
        $where .= !isset($status)  ? "" : ($where == "" ? "WHERE hrm_salary_payment.statut = {$status}" : " AND hrm_salary_payment.statut = {$status}");

        $payslips = DB::select("
            select
                *
            from
                `hrm_salary_payment`
                left join `hrm_employee` on 
                `hrm_employee`.`employee_id` = `hrm_salary_payment`.`employee_id`
            $where
            order by
                `month_year` desc
        ");

        $payslips = AppHelper::paginateArray($payslips,20);

        return view('hrm.payslip.list',[
            'payslips' => $payslips,
            'search' => $search,
            'month' => $month,
            'status' => $status,
        ]);
    }

    public function payslip($id) {
        $payslips = DB::table('hrm_salary_payment')
                ->leftjoin('hrm_employee','hrm_employee.employee_id','=','hrm_salary_payment.employee_id')
                ->leftjoin('hrm_fonctions','hrm_fonctions.fonction_id','=','hrm_employee.fonction_id')
                ->leftjoin('hrm_branche','hrm_branche.id','=','hrm_employee.school_degree')
                ->leftjoin('hrm_department','hrm_department.department_id','=','hrm_fonctions.department_id')
                ->leftjoin('hrm_employee_payroll','hrm_employee_payroll.employee_id','=','hrm_salary_payment.employee_id')
                ->leftjoin('hrm_employee_bank','hrm_employee_bank.employee_id','=','hrm_employee.employee_id')
                ->select('hrm_employee.*','hrm_salary_payment.*',
                        'hrm_fonctions.title as fonction','hrm_department.title as department',
                        'hrm_employee_payroll.transport_allowance','hrm_branche.title as branch')
                ->where('salary_payment_id',$id)->first();

        $indeminities = DB::table('hrm_type_indeminite')->whereIn('type_indeminite_id',explode(',',$payslips->transport_allowance))->get();
        $indemnityData = [];
        foreach ($indeminities as $value) {
            $indemnityData[$value->type_indeminite_id] = round(($payslips->basic_salary * $value->percentage)/100);
        }

        $date = AppHelper::dateToFrench(date('Y-m-d',strtotime('01-'.$payslips->month_year)),"month");

        return view('hrm.payslip.payslip',[
            'payslips' => $payslips,
            'indeminities' => $indeminities,
            'indemnityData' => $indemnityData,
            'date' => $date
        ]);
    }

    public function payslip_report(Request $request) {
        $month = empty($request->query('month')) ? date('m-Y') :  date('m-Y',strtotime($request->query('month')));
        $payslips = DB::table('hrm_salary_payment')
                ->leftjoin('hrm_employee','hrm_employee.employee_id','=','hrm_salary_payment.employee_id')
                ->leftjoin('hrm_employee_payroll','hrm_employee_payroll.employee_id','=','hrm_salary_payment.employee_id')
                ->leftjoin('hrm_employee_bank','hrm_employee_bank.employee_id','=','hrm_employee.employee_id')
                ->where('month_year',$month)->get();

        // $indeminities = DB::table('hrm_type_indeminite')->whereIn('type_indeminite_id',explode(',',$payslips[0]->transport_allowance))->get();
        $indeminities = DB::table('hrm_type_indeminite')->get();
        $indemnityData = [];
        foreach ($payslips as $val) {
            $allowances = $val->transport_allowance;
            foreach ($indeminities as $value) {
                if(str_contains($allowances,$value->type_indeminite_id)){
                    $indemnityData[$val->employee_id][$value->type_indeminite_id] = round(($val->basic_salary * $value->percentage)/100);
                } else {
                    $indemnityData[$val->employee_id][$value->type_indeminite_id] = 0;
                }
            }
        }
        $date = AppHelper::dateToFrench(date('Y-m-d',strtotime('01-'.$month)),"month");

        return view('hrm.payslip.show',[
            'payslips' => $payslips,
            'indeminities' => $indeminities,
            'indemnityData' => $indemnityData,
            'date' => $date,
            'month' => $month,
        ]);
    }

    public function inss_report(Request $request) {
        $month = empty($request->query('month')) ? date('m-Y') :  date('m-Y',strtotime($request->query('month')));
        $payslips = DB::table('hrm_salary_payment')
                ->leftjoin('hrm_employee','hrm_employee.employee_id','=','hrm_salary_payment.employee_id')
                ->leftjoin('hrm_employee_payroll','hrm_employee_payroll.employee_id','=','hrm_salary_payment.employee_id')
                ->leftjoin('hrm_employee_bank','hrm_employee_bank.employee_id','=','hrm_employee.employee_id')
                ->where('month_year',$month)->get();


        $date = AppHelper::dateToFrench(date('Y-m-d',strtotime('01-'.$month)),"month");

        return view('hrm.payslip.inss',[
            'payslips' => $payslips,
            'date' => $date,
            'month' => $month,
        ]);
    }

    public function ipr_report(Request $request) {
        $month = empty($request->query('month')) ? date('m-Y') :  date('m-Y',strtotime($request->query('month')));
        $payslips = DB::table('hrm_salary_payment')
                ->leftjoin('hrm_employee','hrm_employee.employee_id','=','hrm_salary_payment.employee_id')
                ->leftjoin('hrm_employee_payroll','hrm_employee_payroll.employee_id','=','hrm_salary_payment.employee_id')
                ->leftjoin('hrm_employee_bank','hrm_employee_bank.employee_id','=','hrm_employee.employee_id')
                ->where('month_year',$month)->get();


        $date = AppHelper::dateToFrench(date('Y-m-d',strtotime('01-'.$month)),"month");

        return view('hrm.payslip.ipr',[
            'payslips' => $payslips,
            'date' => $date,
            'month' => $month,
        ]);
    }

    public function generate(Request $request){
        $validated = Validator::make($request->all(),[
            "month_year" => "required",
        ],[
            "month_year.required" => "Vous devez choisir un  mois pour continuer",
        ]);

        if(!$validated->fails()){
            $data = $validated->safe()->all();

            $month = date('m-Y',strtotime($data['month_year']));
    
            $check = DB::table('hrm_salary_payment')->where([
                ['month_year','=',$month],
                ['statut','!=',0],
            ])->first();
            
            if(empty($check)) {
                $deleted = DB::table('hrm_salary_payment')->where([
                    ['month_year','=',$month],
                    ['statut','=',0],
                ])->delete();
        
                $employees = Employee::active()->get();
                $this->generate_payslip($month,$employees);
            } else {
                $date = AppHelper::dateToFrench(date('Y-m-d',strtotime('01-'.$month)),"month");
        
                echo json_encode([
                    "success" => false,
                    "messages" => ["error" => "Les salaires pour le mois de $date ont déja été géneré et payé"]
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'messages' => $validated->errors()
            ]);
        }

    }

    public function regenerate(Request $request){
        $month = date('m-Y',strtotime("01-".$request->month));
        $payslipIds = $request->payslipIds;
        $employeeIds = $request->employeeIds;
        // dd($month);

        $check = DB::table('hrm_salary_payment')
                    ->whereIn('salary_payment_id',$payslipIds)
                    ->where('month_year',$month)
                    ->where('statut',0)->get();
        
        if(count($check) != 0) {
            $deleted = DB::table('hrm_salary_payment')
                    ->whereIn('salary_payment_id',$payslipIds)
                    ->where('month_year',$month)
                    ->where('statut',0)->delete();
    
            $employees = Employee::active()->whereIn('employee_id',$employeeIds)->get();
            $this->generate_payslip($month,$employees);
        } else {
            $date = AppHelper::dateToFrench(date('Y-m-d',strtotime('01-'.$month)),"month");
    
            echo json_encode([
                "success" => false,
                "messages" => ["error" => "Le salaire de l'employé pour le mois de $date a déja été géneré et payé"],
                "redirect" => redirect()->route('payslip.index')->with('error',"Le salaire de l'employé pour le mois de $date a déja été géneré et payé")
            ]);
        }

    }

    public function generate_payslip($month,$employees){
        
        $indeminities = collect(Indeminity::all());
        // $caisse_sociale = DB::table('hrm_settings')->where('name','caisse sociale')->first()->content;
        $caisse_sociale = 0;
        // dd($caisse_sociale);

        $check = DB::table('hrm_salary_payment')->where([
            ['month_year','=',$month],
            ['statut','!=',0],
        ])->first();

        $maxGrossSalary = 450000;
        $maxGrossSalaryRisq = 80000;
        $innssEmployee = 4;
        $innssEmployer = 6;
        $innssRisq = 3;

        $mfpEmployeePerc = 4;
        $mfpEmployerPerc = 6;

        $save_data = [];

        foreach ($employees as $key => $employee) {
            $basic_salary = $employee->salary->basic_salary;
            $allowances = explode(',',$employee->salary->transport_allowance);
            $pension_complementaire = $employee->salary->pension_complementaire;
            
            $retenues = Retenue::where([
                ['employee_id_in_retenue','=',$employee->employee_id],
                ['retenue_month','=',$month],
            ])->get();
            $totalRetenues= 0;
            if(!empty($retenues)){
                $saveRetenues = [];
                DB::table('hrm_salary_retenue')->where([
                    ['employee_id','=',$employee->employee_id],
                    ['retenue_month','=',$month],
                ])->delete();

                foreach ($retenues as $value) {
                    $totalRetenues += $value->retenue_amount;
                    array_push($saveRetenues,[
                        "retenue_type" => $value->retenue_id,
                        "employee_id" => $employee->employee_id,
                        "amount" => $value->retenue_amount,
                        "retenue_month" => $month,
                        "created_date" => date('Y-m-d H:i:s'),
                        "created_by" => auth()->id(),
                    ]);
                }

                DB::table('hrm_salary_retenue')->insert($saveRetenues);
            }
            $totalAllowances = 0;
            $totalAllowancesNotTaxable = 0;
            foreach ($allowances as $value) {
                $val = $indeminities->firstWhere('type_indeminite_id',$value);
                if($val->taxable == 0){
                    $totalAllowances += round(($basic_salary * $val->percentage)/100);
                } else {
                    $totalAllowancesNotTaxable += round(($basic_salary * $val->percentage)/100);
                }
            }

            $gross_salary = $basic_salary + $totalAllowances + $totalAllowancesNotTaxable;

            $mfpEmployee = round((($gross_salary - round(($basic_salary * 60)/100)) * $mfpEmployeePerc)/100);
            $mfpPatronal = round((($gross_salary - round(($basic_salary * 60)/100)) * $mfpEmployerPerc)/100);

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

            $net_salary = $gross_salary - $pension_salariale - $mfpEmployee - $IPR - $pension_complementaire - $caisse_sociale - $totalRetenues;

            array_push($save_data,[
                'employee_id' => $employee->employee_id,
                'basic_salary' => $basic_salary,
                'allowance'	=> $totalAllowances + $totalAllowancesNotTaxable,
                'inss' => $inss,
                'ire' =>	$IPR,
                'caisse_sociale' => $caisse_sociale,
                'pension_salariale' => $pension_salariale,
                'pension_patronale' => $pension_patronale,
                'risque_prof' => $risque_professionel,
                'tax_base' => $tax_base,
                'gross_salary' => $gross_salary,
                'mfp_patronal' => $mfpPatronal,
                'mfp_salariale' => $mfpEmployee,
                'pension_complementaire' => $pension_complementaire,
                'net_salary' => $net_salary,
                'month_year' => $month,
                'statut' => 0,
                'created_by' => auth()->id(),
                'created_date' => date('Y-m-d H:i:s'),
            ]);
        }

        $status = DB::table('hrm_salary_payment')->insert($save_data);

        if($status) {
            echo json_encode([
                "success" => true,
                "messages" => "Salaires généré avec succés!!",
                "redirect" => redirect()->route('payslip.index')->with('success','Salaires généré avec succés!!')
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "messages" => ["error" => "Une erreur s'est produite,Réessayez SVP!!"]
            ]);
        }
        

    } 

    public function changeStatusToPayed(Request $request){
        $ids = $request->payslipIds;

        $check = DB::table('hrm_salary_payment')
                    ->whereIn('salary_payment_id',$ids)
                    ->where('statut',0)->get();

        if(empty($check)){
            echo json_encode([
                "success" => true,
                "messages" => "les salaires sélectionnés ont déjà été payés",
                "redirect" => redirect()->route('payslip.index')->with('error','les salaires sélectionnés ont déjà été payés')
            ]);
        } else {
            $status = DB::table('hrm_salary_payment')
                        ->whereIn('salary_payment_id',$ids)
                        ->where('statut',0)->update([
                            "statut" => 1,
                            "payment_date" => date('Y-m-d H:i:s')
                        ]);
    
            
    
            if($status) {
                echo json_encode([
                    "success" => true,
                    "messages" => "Le paiement des salaires a été effectué avec succés",
                    "redirect" => redirect()->route('payslip.index')->with('success','Le paiement des salaires a été effectué avec succés')
                ]);
            } else {
                echo json_encode([
                    "success" => true,
                    "messages" => ['error' => "Une erreur s'est produite, réessayez s'il vous plaît"],
                    "redirect" => redirect()->route('payslip.index')->with('error',"Une erreur s'est produite, réessayez s'il vous plaît")
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {
        $ids = $request->payslipIds;

        $deleted = DB::table('hrm_salary_payment')
                    ->whereIn('salary_payment_id',$ids)
                    ->where('statut',0)->delete();

        if($deleted) {
            echo json_encode([
                "success" => true,
                "messages" => "Paiement des salaires supprimés",
                "redirect" => redirect()->route('payslip.index')->with('success',"Fiche de salaires supprimés!!")
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "messages" => ["error" => "une erreur est survenie réessayer"],
                "redirect" => redirect()->route('payslip.index')->with('error',"Une erreur s'est produite, réessayez s'il vous plaît")
            ]);
        }
    }

    
}
