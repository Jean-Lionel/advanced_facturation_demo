<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property double $montant
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class OrderInteret extends Model
{
    use HasFactory, SoftDeletes;


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
        'order_id' => 'integer',
        'user_id' => 'integer',
        'montant' => 'double',
    ];

    protected $appends = ['commisionnaireId', 'clientId'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCommisionnaireIdAttribute(){
        $r = json_decode($this->description);
        return $r->commissionaire_id ?? "" ;
    }
    public function getClientIdAttribute(){
        $r = json_decode($this->description);
        return $r->client_id ?? "" ;
    }

    public function commisionnaire(){
        return Client::where('id', $this->commisionnaireId)->first();
    }
    public function client(){
        return Client::where('id', $this->clientId)->first();
    }

    public function getInteretAttribute(){
       // montant
       $r = json_decode($this->description);
        return $r->partage ?? [] ;
    }


}
