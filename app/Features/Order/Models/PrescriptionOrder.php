<?php

namespace App\Features\Order\Models;

use App\Features\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PrescriptionOrder extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'client_id',
        'receiver_id',
        'order_type',
        'status'
    ];

    public static $statuses = [
        'rejected',
        'confirmed',
        'pending'
    ];

    public static $orderTypes = [
        'test',
        'xray'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('prescription')
            ->singleFile();
    }

    public function prescriptionMediacl()
    {
        return $this->hasMany(PrescriptionMediacl::class,'prescription_order_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class,'client_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }
}
