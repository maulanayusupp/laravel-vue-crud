<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['name', 'email', 'logo'];

    /*
     * Relation to employees
     * Has to many
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
