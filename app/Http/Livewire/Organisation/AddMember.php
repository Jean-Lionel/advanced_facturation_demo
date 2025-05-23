<?php

namespace App\Http\Livewire\Organisation;

use App\Models\OrganisationMember;
use App\Models\Member;
use Livewire\Component;

class AddMember extends Component
{
    public $organisation;
    public $selectedMember;
    public $members;
    public $organisationMembers;

    protected $rules = [
        'selectedMember' => 'required|exists:members,id',
    ];

    public function mount($organisation)
    {
        $this->organisation = $organisation;
        $this->loadMembers();
    }

    public function loadMembers()
    {
        // Charger tous les membres qui ne sont pas déjà dans l'organisation
        $this->members = Member::whereNotIn('id', function($query) {
            $query->select('member_id')
                ->from('organisation_members')
                ->where('organisation_id', $this->organisation->id);
        })->get();

        // Charger les membres déjà dans l'organisation
        $this->organisationMembers = $this->organisation->members;
    }

    public function addMember()
    {

        $this->validate();


        OrganisationMember::create([
            'member_id' => $this->organisation->id,
            'organisation_id' => $this->selectedMember
        ]);


      //  OrganisationMember::assignMembers();

        $this->reset('selectedMember');
        $this->loadMembers();

      //  $this->dispatch('success', message: 'Membre ajouté avec succès');
    }

    public function removeMember($memberId)
    {
        OrganisationMember::removeMembers($this->organisation->id, $memberId);
        $this->loadMembers();

        $this->dispatch('success', message: 'Membre supprimé avec succès');
    }

    public function render()
    {
        return view('livewire.organisation.add-member');
    }
}
