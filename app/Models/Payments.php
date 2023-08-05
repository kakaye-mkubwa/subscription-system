<?php

namespace App\Models;

use App\AppUtils\DefaultAppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends DefaultAppModel
{
    protected $fillable = [
        'invoice_id',
        'amount',
        'description',
        'date_paid',
        'paid_by',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            Invoice::class,
            'user_id', // Foreign key on invoices table...
            'id', // Foreign key on users table...
            'invoice_id', // Local key on payments table...
            'id' // Local key on invoices table...
        );
    }
}
