<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'first_name', 'last_name', 'email', 'phone'];

    /*
     * Relation to company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
