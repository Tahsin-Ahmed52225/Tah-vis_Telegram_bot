<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeleUser extends Model
{
    use HasFactory;

    protected $table = 'tele_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'client_id',
    ];



    static public function store(array $request) :object
    {
        return TeleUser::create([
            'first_name' => $request["first_name"] ?? '',
            'last_name' => $request["last_name"] ?? '',
            'client_id' => $request["id"],
            'mobile_no' => isset($request["contact"]) ? $request["contact"]['phone_number'] : null,
        ]);
    }
    static public function findTeleUserByClientId(string $clientID) :object|null
    {
        $user = TeleUser::where('client_id', $clientID)->first();
        return $user;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
