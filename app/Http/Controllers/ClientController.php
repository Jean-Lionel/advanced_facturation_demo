<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientHistory;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class ClientController extends Controller
{
    public function index()
    {
        $model = new Client();
        $clients =  $model->getPaginateData();
        $nombre_total_clients = Client::all()->count();
        return view('clients.index', compact('clients', 'nombre_total_clients'));
    }

    public function commissionnaires(){
        $model = new Client();
        $additionalCondition = [['column' => 'is_commissionaire', 'operator' => '<>', 'value' => null],];
        $clients =  $model->getPaginateData($additionalCondition);
        return view('clients.commisionnaire_list', compact('clients'));
    }

    public function load_commission(){
        return Client::whereNotNull('is_commissionaire')->get();
    }

    public function make_commissionnaire($id){
        $customer = Client::find($id);
        $compte = Compte::where('client_id' , $customer->id)->first();
        $customer->is_commissionaire = now();
        $customer->save();

        if(!$compte){
            Compte::create([
                'name' => str_pad($customer->id, 4, '0', STR_PAD_LEFT),
                'montant' => 0,
                'is_active' => true,
                'client_id' => $customer->id
            ]);
        }
        return back();
    }
    public function abonne($id){
        $customer = Client::find($id);
        $compte = Compte::where('client_id' , $customer->id)->first();
        if(!$compte){
            Compte::create([
                'name' => str_pad($customer->id, 4, '0', STR_PAD_LEFT),
                'montant' => 0,
                'is_active' => true,
                'client_id' => $customer->id
            ]);
        }
        return back();
    }

    public function create()
    {
        return view('clients.create');
    }



    public function getClient($id){

        if($id == 'ALL'){
            return Client::all();
        }
        $client = Client::find($id);

        if(!$client){
            $columns = Schema::getColumnListing( 'clients');
            $query = Client::query();
            $client =  $query->where(function ($q) use ($columns, $id) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $id . '%');
                }
            })->first();
        }

        return response()->json( [
            'client' => $client
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            "client_type" => "required",
            "vat_customer_payer" => "required",
            "name" => "required",
            "customer_TIN" => "nullable|unique:clients,customer_TIN",
            "telephone" => "nullable|unique:clients", // |unique:clients,telephone
            "addresse" => "nullable"
        ]);
        // Check if Tin does not exist in database

        if($request->client_type === 'PERSONNE MORAL' && $request->customer_TIN ==""){
            return redirect('clients/create')->with('message', 'NIF EST OBLIGATOIRE POUR LES PERSONNES MORALE ');
        }
        $customer_OBR = '';
        if($request->customer_TIN){
            $check =  Client::where("customer_TIN", $request->customer_TIN)->first();
            if($check){
                $errorMessage = 'Le Client existe deja  '. $request->customer_TIN . ' => '.  $check->name . ' CUSTOMER ID '. $check->id;
                return redirect('clients/create')->with('message',  $errorMessage);
            }
            try {
                $obr = new SendInvoiceToOBR();
                $response = $obr->checkTin($request->customer_TIN);
                if(!$response->success){
                    return redirect('clients/create')->with('message',  $request->customer_TIN . ' => '. $response->msg);
                }
                // }else{
                    //     return redirect('clients/create')->with('message',  ' NIF EST OBLIGATOIRE POUR LES PERSONNES MORALE ');
                    // }
                    // ['result']['taxpayer'][0]['tp_name']
                    $customer_OBR = $response->result->taxpayer[0]->tp_name;
                }catch (\Exception $e){

                    // dd($e);

                    return redirect('clients/create')->with('message',  $request->customer_TIN . ' => pas de connection Internet le Nif ne peut pas etre verfier pour le moment ');
                }
            }
            $data =  $request->all();
            if($customer_OBR){
                $data = array_merge($data, [
                    'name' => $customer_OBR
                ]);
            }
            Client::create( $data );
            return $this->index();
        }
        /**
        * Display the specified resource.
        *
        * @param  \App\Models\Client  $client
        * @return \Illuminate\Http\Response
        */
        public function show(Client $client)
        {
            //
        }

        public function edit(Client $client)
        {
            return view('clients.edit', compact('client'));
        }

        public function update(Request $request, Client $client)
        {
            $request->validate([
                "client_type" => "required",
                "vat_customer_payer" => "required",
                "name" => "required",
                "customer_TIN" => "nullable",
                "telephone" => "nullable",
                "addresse" => "nullable"
            ]);
            $client->update($request->all());
            return $this->index();
        }

        public function destroy(Client $client)
        {
            try {
                //code...
                DB::beginTransaction();
                    ClientHistory::create([
                        'client_id' => $client->id,
                        'user_id' => auth()->user()->id,
                        'content' => $client->toJson(),
                    ]);
                    // Delete with soft delete
                    $client->forceDelete();
                DB::commit();
            } catch (\Throwable $th) {
                //throw $th;
               session()->flash('error', 'Suppression impossible');
            }
            return back();
        }
    }
