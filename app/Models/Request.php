<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Request extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vehicle_id',
        'approvers_id',
        'driver_name',
        'fuel_estimation',
        'start_date',
        'end_date',
        'request_status',
    ];

    public function vehicle() : BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function requestApprover() : HasOne
    {
        return $this->hasOne(RequestApprover::class);
    }
}
