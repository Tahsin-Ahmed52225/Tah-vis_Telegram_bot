<?php

namespace App\Models;

use App\Models\TeleUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'tele_user_id',
    ];

    protected $cast = [
        'complete' => 'boolean',
    ];

    /**
     * Store Task in database
     */
    static function store(String $id, String $data): Task
    {
        return Task::create([
            'tele_user_id' => $id,
            'task' => $data
        ]);
    }

    /**
     * Relation with TeleUser
     *
     */
    public function teleUser(): BelongsTo
    {
        return $this->belongsTo(TeleUser::class);
    }
}
