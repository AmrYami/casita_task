<?php

namespace Saham\SharedLibs\Models;

use Saham\SharedLibs\Mongodb\Eloquent\Model;

class Activity extends Model
{
    protected $table      = 'activity_log';
    protected $fillable   = ['log_name', 'description', 'subject_type', 'event', 'subject_id', 'causer_type', 'causer_id', 'properties', 'batch_uuid'];
}
