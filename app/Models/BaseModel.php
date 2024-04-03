<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class BaseModel extends Model
{
    protected $connection = 'mysql';

    use LogsActivity;
    use HasTranslations;

    protected static $logName;


//    all models going to use this base have to use this function
    public function init()
    {
        self::$logName = get_called_class();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
