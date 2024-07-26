<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestApprover extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_approvers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'approver1_id',
        'approver2_id',
        'approver1_status',
        'approver2_status',
    ];

    public function request() : BelongsTo {
        return $this->belongsTo(Request::class);
    }

    public function approver1() : BelongsTo {
        return $this->belongsTo(User::class, 'approver1_id');
    }

    public function approver2() : BelongsTo {
        return $this->belongsTo(User::class, 'approver2_id');
    }
}
