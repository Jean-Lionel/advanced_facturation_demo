<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->paginate(20);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    public function getClient($id){
        $client = Client::find($id);

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
              "customer_TIN" => "sometimes|unique:clients,id",
              "telephone" => "nullable",
              "addresse" => "nullable"
        ]);
            // Check if Tin does not exist in database

        if($request->client_type === 'PERSONNE MORAL' && $request->customer_TIN ==""){
            session()->flash('obr_response',' NIF EST OBLIGATOIRE POUR LES PERSONNES MORALE ' );
            return back();
        }
        $customer_OBR = '';
        if($request->customer_TIN){
           $check =  Client::where("customer_TIN", $request->customer_TIN)->first();
           if($check){
               session()->flash('obr_response','Le Client existe deja  '. $request->customer_TIN . ' => '.  $check->name . ' CUSTOMER ID '. $check->id );
               return back();
           }
            try {
                $obr = new SendInvoiceToOBR();
                $response = $obr->checkTin($request->customer_TIN);
                if(!$response->success){
                    // If the TIN
                    session()->flash('obr_response', $request->customer_TIN . ' => '. $response->msg);
                    return back();
                }else{
                    session()->flash('obr_response',' NIF EST OBLIGATOIRE POUR LES PERSONNES MORALE ' );
                }

               // ['result']['taxpayer'][0]['tp_name']
                $customer_OBR = $response->result->taxpayer[0]->tp_name;

            }catch (\Exception $e){
                session()->flash($e->getMessage() .'obr_response', $request->customer_TIN . ' => pas de connection Internet le Nif ne peut pas etre verfier pour le moment ');
                return back();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //

        $request->validate([
            'first_name' => 'required',
        ]);

        $client->update($request->all());

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
    }
}
