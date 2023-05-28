<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'account_type_id', 'branche_id','account_number','balance','status'
    ];

    public function accountType()
    {
        return $this->belongsTo(AccountTypes::class); //belongsTo
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branche_id', 'id'); //belongsTo
    }
}
