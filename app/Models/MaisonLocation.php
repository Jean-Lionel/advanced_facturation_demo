<?php

namespace App\Models;

use App\Models\Traits\SearchOnModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property double $montant
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class MaisonLocation extends Model
{
    use HasFactory, SoftDeletes, SearchOnModel;

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
        'user_id' => 'integer',
        'montant' => 'double',
    ];

    protected $appends = ['priceTTC', 'tax'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clients(){
        return $this->belongsToMany(Client::class, 'client_maisons', 'maisonlocation_id');
    }

    public function getPriceTTCAttribute(){
        return prixVenteTvac($this->montant, (($this->tax ?? 0) / 100));
    }

    public function getTaxAttribute(){
        return $this->getPriceTTCAttribute() - $this->montant;
    }

    public function getClientNameAttribute(){
        return implode(" && ", $this->clients->map->name->toArray() ?? []) ;
    }
    public function getAdresseAttribute(){
        return implode(" && ", $this->clients->map->addresse
        ->toArray() ?? [] ) ;
    }

    public function getClientIdAttribute(){
        return $this->clients->map->id->first() ?? 0;
    }
    public function getCustomer_TINAttribute(){
        return $this->clients->map->customer_TIN->first() ?? 0;
    }
    public function getVatCustomerPayerAttribute(){
        return $this->clients->map->vat_customer_payer->first() ?? 0;
    }
    public function payments()
    {
        return $this->hasMany(PaymentLocationMensuel::class, 'client_maison_id');
    }
    public function clientMaisons()
    {
        return $this->hasMany(ClientMaison::class);
    }
}
