<?php

namespace App\Http\Controllers;

use App\Mail\BackupEmail;
use App\Mail\TestEmail;
use App\Models\Entreprise;
use App\Models\Banque;
use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
class EntrepriseController extends Controller
{

    public function index()
    {
        //
        $entreprises = Entreprise::all();

        return view('entreprises.index', compact('entreprises'));
    }

    public function add_info(){
        $entreprise = Entreprise::currentEntreprise();
        $banques = $entreprise ? $entreprise->banques : collect();
        return view('entreprises.add_info', compact('entreprise', 'banques'));
    }

    public function store_info(\Illuminate\Http\Request $request){
        $request->validate([
            'tp_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $entreprise = Entreprise::currentEntreprise();
        $data = $request->except('_token', 'tp_logo');

        if ($request->hasFile('tp_logo')) {
            $imageName = time().'.'.$request->tp_logo->extension();
            $request->tp_logo->move(public_path('uploads/logos'), $imageName);
            $data['tp_logo'] = 'uploads/logos/'.$imageName;
        }

        if($entreprise){
            $entreprise->update($data);
        }

        return back()->with('success', 'Information updated successfully.');
    }

    public function store_banque(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'swift_code' => 'nullable|string|max:50',
            'iban' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $entreprise = Entreprise::currentEntreprise();

        if (!$entreprise) {
            return back()->with('error', 'Aucune entreprise trouvée.');
        }

        // Si c'est la première banque ou si is_default est coché, la définir par défaut
        $isDefault = $request->has('is_default') || $entreprise->banques->count() == 0;

        // Si cette banque est définie par défaut, désactiver les autres
        if ($isDefault) {
            Banque::where('entreprise_id', $entreprise->id)->update(['is_default' => false]);
        }

        Banque::create([
            'entreprise_id' => $entreprise->id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'account_number' => $request->account_number,
            'swift_code' => $request->swift_code,
            'iban' => $request->iban,
            'description' => $request->description,
            'is_default' => $isDefault,
        ]);

        return back()->with('success', 'Banque ajoutée avec succès.');
    }

    public function update_banque(Request $request, Banque $banque){
        $request->validate([
            'name' => 'required|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'swift_code' => 'nullable|string|max:50',
            'iban' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $entreprise = Entreprise::currentEntreprise();

        // Si cette banque est définie par défaut, désactiver les autres
        if ($request->has('is_default')) {
            Banque::where('entreprise_id', $entreprise->id)->update(['is_default' => false]);
        }

        $banque->update([
            'name' => $request->name,
            'account_number' => $request->account_number,
            'swift_code' => $request->swift_code,
            'iban' => $request->iban,
            'description' => $request->description,
            'is_default' => $request->has('is_default'),
        ]);

        return back()->with('success', 'Banque mise à jour avec succès.');
    }

    public function destroy_banque(Banque $banque){
        $banque->delete();
        return back()->with('success', 'Banque supprimée avec succès.');
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
