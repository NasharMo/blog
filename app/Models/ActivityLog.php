<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'entity_type',
        'entity_id',
        'action_type',
        'changed_fields',
        'performer_ip',
    ];

    public function subject()
    {
        return $this->morphTo(__FUNCTION__, 'entity_type', 'entity_id');
    }
}
