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

    static function store($id, $data)
    {
        return Task::create([
            'tele_user_id' => $id,
            'task' => $data
        ]);
    }

    static function remove($id, $data)
    {
        $pattern = '/^[0-9]+$/';
        if (preg_match($pattern, $pattern)) {
            $task = Task::find((int)$data - 1);
            if ($task) {
                $task->delete();
                return true;
            }
        }

        return false;
    }
    public function teleUser(): BelongsTo
    {
        return $this->belongsTo(TeleUser::class);
    }
}
