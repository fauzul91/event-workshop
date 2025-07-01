<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'customer_bank_name', 'customer_bank_account', 'customer_bank_number', 'booking_trx_id', 'proof', 'quantity', 'total_amount', 'is_paid', 'workshop_id'
    ];
    public static function generateUniqueTrxId()
    {
        $prefix = 'AKTIVBWA';
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }
    public function participants()
    {
        return $this->hasMany(WorkshopParticipant::class);
    }
    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }
}
