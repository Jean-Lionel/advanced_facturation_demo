<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $organisation_id
 * @property int $member_id
 */
class OrganisationMember extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'organisation_id' => 'integer',
        'member_id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Affecte un ou plusieurs membres à une organisation
     *
     * @param int|array $organisationId L'ID de l'organisation
     * @param int|array $memberId L'ID ou tableau d'IDs des membres à affecter
     * @return bool
     */
    public static function assignMembers($organisationId, $memberId)
    {
        // Si member_id est un tableau, on les affecte tous
        if (is_array($memberId)) {
            foreach ($memberId as $id) {
                OrganisationMember::updateOrCreate([
                    'organisation_id' => $organisationId,
                    'member_id' => $id
                ]);
            }
            return true;
        }

        // Si member_id est un seul ID
        return OrganisationMember::updateOrCreate([
            'organisation_id' => $organisationId,
            'member_id' => $memberId
        ]);
    }
}
