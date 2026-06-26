<?php

namespace App\Http\Livewire\Location;

use App\Models\ClientMaison;
use App\Models\MaisonLocationCommentaire;
use Livewire\Component;

class Commentaires extends Component
{
    public $maison;
    public $date;
    public $nom = '';
    public $telephone = '';
    public $client_id = '';
    public $commentaire = '';

    public function mount($maison_id)
    {
        $this->maison = $maison_id;
        $this->date = now()->format('Y-m-d');
        $this->prefillFromCurrentClient();
    }

    public function render()
    {
        $commentaires = MaisonLocationCommentaire::with('user')
            ->where('maisonlocation_id', $this->maison)
            ->latest('date')
            ->latest()
            ->get();

        $clients = ClientMaison::with('client')
            ->whereHas('client')
            ->where('maisonlocation_id', $this->maison)
            ->get();

        return view('livewire.location.commentaires', [
            'commentaires' => $commentaires,
            'clients' => $clients,
        ]);
    }

    public function updatedClientId()
    {
        if (!$this->client_id) {
            return;
        }

        $clientMaison = ClientMaison::with('client')
            ->where('maisonlocation_id', $this->maison)
            ->where('client_id', $this->client_id)
            ->first();

        if ($clientMaison?->client) {
            $this->nom = $clientMaison->client->name ?? '';
            $this->telephone = $clientMaison->client->telephone ?? '';
        }
    }

    public function addCommentaire()
    {
        $this->validate([
            'date' => ['required', 'date'],
            'nom' => ['required', 'string', 'min:1'],
            'telephone' => ['nullable', 'string'],
            'commentaire' => ['required', 'string', 'min:1'],
        ], [
            'date.required' => 'La date est obligatoire.',
            'nom.required' => 'Le nom de la personne en possession est obligatoire.',
            'commentaire.required' => 'Le commentaire est obligatoire.',
        ]);

        MaisonLocationCommentaire::create([
            'user_id' => auth()->id(),
            'maisonlocation_id' => $this->maison,
            'date' => $this->date,
            'nom' => trim($this->nom),
            'telephone' => trim($this->telephone),
            'commentaire' => trim($this->commentaire),
        ]);

        $this->commentaire = '';
        $this->date = now()->format('Y-m-d');
        $this->resetValidation();
        $this->prefillFromCurrentClient();
    }

    public function deleteCommentaire($commentaireId)
    {
        $commentaire = MaisonLocationCommentaire::where('id', $commentaireId)
            ->where('maisonlocation_id', $this->maison)
            ->first();

        if ($commentaire) {
            $commentaire->delete();
        }
    }

    private function prefillFromCurrentClient(): void
    {
        $clientMaison = ClientMaison::with('client')
            ->whereHas('client')
            ->where('maisonlocation_id', $this->maison)
            ->first();

        if (!$clientMaison?->client) {
            $this->client_id = '';
            return;
        }

        $this->client_id = $clientMaison->client_id;
        $this->nom = $clientMaison->client->name ?? '';
        $this->telephone = $clientMaison->client->telephone ?? '';
    }
}