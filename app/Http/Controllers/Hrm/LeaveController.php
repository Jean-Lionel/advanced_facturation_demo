<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Helpers\AppHelper;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\TypeLeave;
use Illuminate\Http\Request;
use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $date_debut = empty($request->query('date_debut')) ? '' : date('Y-m-d',strtotime($request->query('date_debut')));
        $date_fin = empty($request->query('date_fin')) ? '' : date('Y-m-d',strtotime($request->query('date_fin')));
        $status = $request->query('status');

        $where = "";
        $where .= empty($search) ? "" : ($where == "" ? "WHERE CONCAT(hrm_employee.last_name,'',hrm_employee.first_name) like '%{$search}%'" : " AND CONCAT(hrm_employee.last_name,'',hrm_employee.first_name) like '%{$search}%'");
        // $where .= empty($date_debut) ? "" : ($where == "" ? "WHERE hrm_salary_payment.month_year = '{$month}'" : " AND hrm_salary_payment.month_year = '{$month}'");
        $where .= !isset($status)  ? "" : ($where == "" ? "WHERE hrm_paid_leave.leave_status = {$status}" : " AND hrm_paid_leave.leave_status = {$status}");
        if (empty($date_debut) && empty($date_fin)) {
            $where .= "";
        } else if(!empty($date_debut) && empty($date_fin)) {
            $date_fin = date('Y-m-d');
            $where .= $where == "" ? "WHERE DATE(hrm_paid_leave.request_date) BETWEEN '".$date_debut."' AND '".$date_fin."' " : " AND DATE(hrm_paid_leave.request_date) BETWEEN '".$date_debut."' AND '".$date_fin."'" ;
        } else if(empty($date_debut) && !empty($date_fin)) {
            $date_debut = date('Y-m-d');
            $where .= $where == "" ? "WHERE DATE(hrm_paid_leave.request_date) BETWEEN '".$date_debut."' AND '".$date_fin."' " : " AND DATE(hrm_paid_leave.request_date) BETWEEN '".$date_debut."' AND '".$date_fin."'" ;
        } else {
            $where .= $where == "" ? "WHERE DATE(hrm_paid_leave.request_date) BETWEEN '".$date_debut."' AND '".$date_fin."' " : " AND DATE(hrm_paid_leave.request_date) BETWEEN '".$date_debut."' AND '".$date_fin."'" ;
        }
        
        $leaves = DB::select("
            select
            hrm_paid_leave.*,hrm_leave_category.category as category,
            CONCAT(hrm_employee.last_name,' ',hrm_employee.first_name) as full_name,
            users.name as creator
            from
                `hrm_paid_leave`
                left join `hrm_employee` on 
                `hrm_employee`.`employee_id` = `hrm_paid_leave`.`employee_id`
                left join `hrm_leave_category` on 
                `hrm_leave_category`.`leave_category_id` = `hrm_paid_leave`.`leave_category_id`
                left join `users` on 
                `users`.`id` = `hrm_paid_leave`.`created_by`
            $where
            order by
                `request_date` desc
        ");

        $employees = Employee::active()->select('employee_id','first_name','last_name')->get();
        $typeLeaves = TypeLeave::select('leave_category_id','category')->get();
        // dd($leaves);
        $leaves = AppHelper::paginateArray($leaves,20);

        return view('hrm.leave.index', [
            'leaves' => $leaves,
            'employees' => $employees,
            'typeLeaves' => $typeLeaves,
            'search' => $search,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'status' => $status,
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
            "period" => "required",
            "start_date" => "required",
        ],[
            "required" => "Le champ :attribute est requis",
            "start_date.required" => "La date de début est requis",
        ]);
        

        if(!$validated->fails()){
            $data = $validated->safe()->all();

            if($request->period == 'day') {

                $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
                $data['end_date'] = date('Y-m-d', strtotime($request->start_date));
                $data['period'] = 1;
            
            } else if($request->period == 'many_days') {
                $days = 0;
                $start = new DateTime($request->start_date);
                $end = new DateTime($request->end_date);

                // otherwise the  end date is excluded (bug?)
                $end->modify('+1 day');

                $intval = $end->diff($start);

                //total days
                $days = $intval->days;

                // create an iterateable period of date (P1D equates to 1 day)
                $periods = new DatePeriod($start, new DateInterval('P1D'), $end);

                // best stored as array, so you can add more than one
                foreach ($periods as $dt) {
                    $curr = $dt->format('D');

                    // substract if Saturday or Sunday
                    if ($curr == 'Sun' || $curr == 'Sat') {
                        $days--;
                    }
                }
                // if($days > $request->pending){
                //     echo json_encode([
                //         'success' => false,
                //         'messages' => ["error" => "Le total des jours ($days) excede le nombre de jours de congé disponible pour l'employé!!"]
                //     ]);exit;
                // }
                $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
                $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
                // $data['period'] = round(abs(strtotime($request->end_date) - strtotime($request->start_date)) / 86400);
                $data['period'] = $days;
            
            }else if($request->period == 'hours') {
                $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
                $data['end_date'] = date('Y-m-d', strtotime($request->start_date));
                $data['period'] = floatval('0.'.$request->duration);
            
            }

            $leave = Leave::create([
                'employee_id' => $data['employee'],
                'leave_category_id' => $data['category'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'period' => $data['period'],
                'request_date' => date('Y-m-d'),
                "created_by" => auth()->id(),
                'leave_status' => 0
            ]);

            if($leave) {
                // $routes = route('leave.index')->with('success', "Congé enregistré avec succés");
                echo json_encode([
                    "success" => true,
                    "messages" => "Congé enregistré avec succés",
                    "redirect" => redirect("leave.index")->with('success', 'Congé enregistré avec succés')
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
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        $leave = DB::table('hrm_paid_leave')
                ->leftjoin('hrm_employee','hrm_employee.employee_id','=','hrm_paid_leave.employee_id')
                ->leftjoin('hrm_fonctions','hrm_fonctions.fonction_id','=','hrm_employee.fonction_id')
                ->leftjoin('hrm_department','hrm_department.department_id','=','hrm_fonctions.department_id')
                ->leftjoin('hrm_leave_category','hrm_leave_category.leave_category_id','=','hrm_paid_leave.leave_category_id')
                ->select('hrm_employee.last_name','hrm_employee.first_name',
                        'hrm_employee.full_address','hrm_paid_leave.*',
                        'hrm_fonctions.title as fonction','hrm_department.title as department',
                        'hrm_leave_category.category as category')
                ->where('paid_leave_id',$leave->paid_leave_id)->first();
        
        return view('hrm.leave.view', [
            "leave" => $leave,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {

        if ($request->action == "update") {
            $validated = Validator::make($request->all(),[
                "employee" => "required",
                "category" => "required",
                "period" => "required",
                "start_date" => "required",
            ],[
                "required" => "Le champ :attribute est requis",
                "start_date.required" => "La date de début est requis",
            ]);
    
            if(!$validated->fails()){
                $data = $validated->safe()->all();
    
                if($request->period == 'day') {
    
                    $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
                    $data['end_date'] = date('Y-m-d', strtotime($request->start_date));
                    $data['period'] = 1;
                
                } else if($request->period == 'many_days') {
                    $days = 0;
                    $start = new DateTime($request->start_date);
                    $end = new DateTime($request->end_date);

                    // otherwise the  end date is excluded (bug?)
                    $end->modify('+1 day');

                    $intval = $end->diff($start);

                    //total days
                    $days = $intval->days;

                    // create an iterateable period of date (P1D equates to 1 day)
                    $periods = new DatePeriod($start, new DateInterval('P1D'), $end);

                    // best stored as array, so you can add more than one
                    foreach ($periods as $dt) {
                        $curr = $dt->format('D');

                        // substract if Saturday or Sunday
                        if ($curr == 'Sun' || $curr == 'Sat') {
                            $days--;
                        }
                    }
                    // if($days > $request->pendingUp){
                    //     echo json_encode([
                    //         'success' => false,
                    //         'messages' => ["error" => "Le total des jours ($days) excede le nombre de jours de congé disponible pour l'employé!!"]
                    //     ]);exit;
                    // }
                    $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
                    $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
                    $data['period'] = $days;
                
                }else if($request->period == 'hours') {
                    $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
                    $data['end_date'] = date('Y-m-d', strtotime($request->start_date));
                    $data['period'] = floatval('0.'.$request->duration);
                
                }
    
                $status = $leave->update([
                    'employee_id' => $data['employee'],
                    'leave_category_id' => $data['category'],
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date'],
                    'period' => $data['period'],
                    'leave_status' => 0
                ]);
    
                if($status) {
                    echo json_encode([
                        "success" => true,
                        "messages" => "Congé Modifié avec succés",
                        "redirect" => redirect("leave.index")->with('success', 'Congé Modifié avec succés')
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
            $result = $this->confirmLeave($leave);

            if($result) {
                
                return redirect()->route('leave.index')->with('success', "Congé confirmé avec succées");
            } else {
                return redirect()->route('leave.index')->with('error', "Une erreur est survenue réessayer svp!!");
                
            }
        } else if($request->action == "reject"){
            $result = $this->rejectLeave($leave);

            if($result) {
                echo json_encode([
                    "success" => true,
                    "messages" => "Congé rejeté avec succées",
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
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        
        return redirect()->route('leave.index')->with('success', "Le congé a été supprimé avec succès");
    }


    private function confirmLeave($leave){
        return $leave->update([
            'leave_status' => 1,
			'confirmation_or_reject_date' => date('Y-m-d H:i:s'),
			'confirmed_by' => auth()->id()
        ]);
    }

    private function rejectLeave($leave){
        return $leave->update([
            'leave_status' => 2,
			'confirmation_or_reject_date' => date('Y-m-d H:i:s'),
			'rejected_by' => auth()->id()
        ]);
    }

    public function checkPendingDays($employee_id) {
        $employee = Employe::where('employee_id',$employee_id)->first();
        $years = date('Y') != date("Y",strtotime($employee->joining_date)) ?
        date('Y') - date("Y",strtotime($employee->joining_date)) : 1;
        $total_add = 0;
		$plus = 0;
		$occurence = 0;
		for ($i = 0; $i < $years; $i++) {
			if ($i < 4) {
				$total_add += 20;
				$occurence = 20;
			} else {
				$plus = intval($i / 4);
				$total_add += 20 + $plus;
				$occurence = 20 + $plus;
			}
		}
        $data = DB::select('select * from hrm_paid_leave where 
                            employee_id = ? and leave_status = ? and 
                            DATE_FORMAT(request_date,"%Y") = ?', [$employee_id,1,date('Y')]); 
        $taken = 0;
        foreach ($data as $key => $value) {
            $taken = $taken + intval($value->period);
        }

        $pending = $occurence - $taken;
        
        if($pending < 0) {
            echo json_encode([
                "days" => 0
            ]);
        } else {
            echo json_encode([
                "days" => $pending
            ]);
        }
    }
}
