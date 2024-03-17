<?php

namespace App\Http\Controllers;

use App\Mail\BackupEmail;
use App\Mail\TestEmail;
use App\Models\Entreprise;
use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use Illuminate\Support\Facades\Mail;
class EntrepriseController extends Controller
{

    public function index()
    {
        //
        $entreprises = Entreprise::where('is_actif', '1')->first()->get();

        return view('entreprises.index', compact('entreprises'));
    }

    public function backup_database(){

        $database = env('DB_DATABASE','');
        $username = env('DB_USERNAME','root');
        $password = env('DB_PASSWORD','');
        $host = env('DB_HOST','127.0.0.1');

        // Path to store the backup file
        $backupFile = 'backup/backup_'.date('Y_m_d_H').'.sql';   ;
        // Command to create the backup
        $command = "mysqldump --host={$host} --user={$username} --password={$password} {$database} > {$backupFile}";
        // Execute the command
        exec($command, $output, $returnValue);
        // Check if the backup was successful
        if ($returnValue === 0) {
            echo "Backup successful!";
        } else {
            echo "Backup failed!";
        }
        if(isInternetConnection() && CAN_BUCKUP_FILE == true) {
            Mail::to(MAIL_FROM_USER)
            ->send(new BackupEmail($backupFile));
        }

        if ($returnValue === 0) {
            // Set appropriate headers for the download
            return response()->download($backupFile)->deleteFileAfterSend(true);
        } else {
            return "Backup failed!";
        }

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
    * @param  \App\Http\Requests\StoreEntrepriseRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(StoreEntrepriseRequest $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Entreprise  $entreprise
    * @return \Illuminate\Http\Response
    */
    public function show(Entreprise $entreprise)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Entreprise  $entreprise
    * @return \Illuminate\Http\Response
    */
    public function edit(Entreprise $entreprise)
    {

        return view('entreprises.edit', compact('entreprise'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \App\Http\Requests\UpdateEntrepriseRequest  $request
    * @param  \App\Models\Entreprise  $entreprise
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateEntrepriseRequest $request, Entreprise $entreprise)
    {
        $entreprise->update($request->all());
        return redirect()->route("entreprises.index");
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Entreprise  $entreprise
    * @return \Illuminate\Http\Response
    */
    public function destroy(Entreprise $entreprise)
    {
        //
    }
}
