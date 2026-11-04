<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property int $member_id
 * @property int $client_id
 * @property string $document_type
 * @property int $transaction_file_id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class Document extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'member_id',
        'client_id',
        'document_type',
        'document_file',
        'name',
        'description'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'member_id' => 'integer',
        'client_id' => 'integer',
        'transaction_file_id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transactionFile()
    {
        return $this->belongsTo(TransactionFile::class);
    }

    /**
     * @return string|null
     */
    public function getFileUrlAttribute()
    {
        return $this->document_file ? asset('documents/' . $this->document_file) : null;
    }

    /**
     * @return string
     */
    public function getFileExtensionAttribute()
    {
        return strtolower(pathinfo((string) $this->document_file, PATHINFO_EXTENSION));
    }

    /**
     * Preview family of the file: image, pdf, word, excel, text or other
     *
     * @return string|null
     */
    public function getFileKindAttribute()
    {
        if (!$this->document_file) {
            return null;
        }

        $kinds = [
            'image' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
            'pdf' => ['pdf'],
            'word' => ['doc', 'docx'],
            'excel' => ['xls', 'xlsx', 'csv'],
            'text' => ['txt'],
        ];

        foreach ($kinds as $kind => $extensions) {
            if (in_array($this->file_extension, $extensions)) {
                return $kind;
            }
        }

        return 'other';
    }

    /**
     * @return string
     */
    public function getFileIconAttribute()
    {
        return [
            'image' => 'fa-file-image text-success',
            'pdf' => 'fa-file-pdf text-danger',
            'word' => 'fa-file-word text-primary',
            'excel' => 'fa-file-excel text-success',
            'text' => 'fa-file-alt text-secondary',
        ][$this->file_kind] ?? 'fa-file text-muted';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(Member::class, 'document_member');
    }
}
