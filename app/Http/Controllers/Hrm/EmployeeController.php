<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Helpers\AppHelper;
use App\Models\Employee;
use App\Models\Poste;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Indeminity;
use App\Models\Payroll;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $poste = $request->query('poste');

        $where = "";
        $where .= empty($search) ? "" : " AND LOWER(CONCAT(hrm_employee.last_name,'',hrm_employee.first_name)) like '%{$search}%'";
        $where .= empty($poste) ? "" : " AND hrm_employee.fonction_id = {$poste}";

        $employees = DB::select("
            select
            hrm_employee.*,hrm_fonctions.title as poste,hrm_department.title as department
            from
                `hrm_employee` left join hrm_fonctions ON 
                `hrm_fonctions`.`fonction_id` = `hrm_employee`.`fonction_id`
                left join hrm_department ON hrm_department.department_id = `hrm_fonctions`.`department_id` left join hrm_branche ON hrm_branche.id =  hrm_employee.school_degree
                left join hrm_employee_payroll ON hrm_employee_payroll.employee_id = hrm_employee.employee_id where hrm_employee.status = 1 
            $where
            order by
                `last_name` asc
        ");
        // dd($employees);
        $employees = AppHelper::paginateArray($employees, 20);
        $allpostes = Poste::select("fonction_id", "title")->get();

        return view('hrm.employee.index', [
            "employees" => $employees,
            "search" => $search,
            "allpostes" => $allpostes,
            "poste" => $poste,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postes = Poste::select("fonction_id", "title")->get();
        $branchs = Branch::select("id", "title")->get();
        $banks = Bank::select("bank_id", "bank_name")->get();
        $indeminities = Indeminity::select("type_indeminite_id", "title", "percentage", "taxable")->get();
        // $provinces = DB::select("SELECT distinct region from burundizipcodes");
        // $communes = DB::select("SELECT distinct district from burundizipcodes where region='" . $province . "'");

        return view('hrm.employee.create', [
            'postes' => $postes,
            'branchs' => $branchs,
            'banks' => $banks,
            'indeminities' => $indeminities
            // 'provinces' => $provinces
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();
        

        $employee = Employee::create([
            "first_name" => $data["first_name"],
            "last_name" => $data["last_name"],
            "date_of_birth" => date('Y-m-d', strtotime($data["date_of_birth"])),
            "joining_date" => date('Y-m-d', strtotime($data["joining_date"])),
            "cni_number" => $data["cni_number"],
            "fonction_id" => $data["fonction_id"],
            "full_address" => $request->full_address,
            "phone" => $request->phone,
            "father_name" => $request->father_name,
            "mother_name" => $request->mother_name,
            "code_inss" => $request->code_inss,
            "leaving_date" => date('Y-m-d', strtotime($request->leaving_date)),
            "gender" => $data["gender"],
            "created_date" => date('Y-m-d'),
            "created_by" => auth()->id()
        ]);

        if ($employee) {
            $bank = DB::table('hrm_employee_bank')->insert([
                "bank_id" => $request->bank_id,
                "employee_id" => $employee->employee_id,
                "account_number" => $request->account_number,
                "created_date" => date('Y-m-d'),
                "created_by" => auth()->id()
            ]);

            $salary = Payroll::create([
                "employee_id" => $employee->employee_id,
                "basic_salary" => $data['basic_salary'],
                "net_salary" => $request->net_salary,
                "brut_salary" => $request->brut_salary,
                "transport_allowance" => implode(',', $request->indeminity),
                "additional_pension" => $request->additional_pension,
                "created_date" => date('Y-m-d'),
                "created_by" => auth()->id()
            ]);
        }

        return redirect()->route('employee.index')->with('success', "Un nouveau employée ajouté avec succés");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $indeminities = Indeminity::select("type_indeminite_id", "title", "percentage", "taxable")->get();
        $bank_emp = DB::table('hrm_employee_bank')
            ->leftJoin('hrm_bank', 'hrm_employee_bank.bank_id', '=', 'hrm_bank.bank_id')
            ->where('employee_id', $employee->employee_id)->first();


        return view('hrm.employee.view', [
            'employee' => $employee,
            'indeminities' => $indeminities,
            'bank_emp' => $bank_emp,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $postes = Poste::select("fonction_id", "title")->get();
        $banks = Bank::select("bank_id", "bank_name")->get();
        $branchs = Branch::select("id", "title")->get();
        $indeminities = Indeminity::select("type_indeminite_id", "title", "percentage", "taxable")->get();

        $salary = Payroll::where('employee_id', $employee->employee_id)->first();
        $bank_emp = DB::table('hrm_employee_bank')->where('employee_id', $employee->employee_id)->first();
        

        return view('hrm.employee.edit', [
            'postes' => $postes,
            'branchs' => $branchs,
            'employee' => $employee,
            'banks' => $banks,
            'indeminities' => $indeminities,
            'salary' => $salary,
            'bank_emp' => $bank_emp
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();

        $status = $employee->update([
            "first_name" => $data["first_name"],
            "last_name" => $data["last_name"],
            "date_of_birth" => date('Y-m-d', strtotime($data["date_of_birth"])),
            "joining_date" => date('Y-m-d', strtotime($data["joining_date"])),
            "cni_number" => $data["cni_number"],
            "fonction_id" => $data["fonction_id"],
            "full_address" => $request->full_address,
            "phone" => $request->phone,
            "father_name" => $request->father_name,
            "mother_name" => $request->mother_name,
            "code_inss" => $request->code_inss,
            "leaving_date" => date('Y-m-d', strtotime($request->leaving_date)),
            "gender" => $data["gender"],
            "modified_date" => date('Y-m-d'),
            "modified_by" => auth()->id()
        ]);

        if ($status) {
            $bank = DB::table('hrm_employee_bank')
                ->where('employee_id', $employee->employee_id)
                ->update([
                    "bank_id" => $request->bank_id,
                    "employee_id" => $employee->employee_id,
                    "account_number" => $request->account_number,
                    "account_money" => $request->account_money
                ]);

            $salary = Payroll::where('employee_id', $employee->employee_id)
                ->update([
                    "employee_id" => $employee->employee_id,
                    "basic_salary" => $data['basic_salary'],
                    "brut_salary" => $request->brut_salary,
                    "additional_pension" => $request->additional_pension,
                    "net_salary" => $request->net_salary,
                    "transport_allowance" => implode(',', $request->indeminity)
                ]);
        }

        return redirect()->route('employee.index')->with('success', "Employé modifié avec succés!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->update([
            "status" => 0,
            "deleted_status" => 1,
            "deleted_date" => date('Y-m-d'),
            "deleted_by" => auth()->id()
        ]);

        return redirect()->route('employee.index')->with('success', "L'employé a été supprimé avec succès");
    }
}
