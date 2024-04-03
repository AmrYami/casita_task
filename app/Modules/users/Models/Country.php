<?php

namespace Users\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Users\Models\Ar\TypeAr;
use Users\Models\En\TypeEn;

/**
 * Class InventoryActivities
 * @package App\Models
 * @version December 16, 2019, 2:25 pm UTC
 *
 * @property string name
 * @property string description
 */
class Country extends BaseModel  implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;
    use LogsActivity;


    public function __construct(array $attributes = [])
    {
        $this->init();
        parent::__construct($attributes);
    }
    public $table = 'countries';
    protected $with = [
    ];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'description',
        'name',
    ];

    public $translatable = [
        'description',
        'name',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

//    public function activities(){
//        $this->morphMany('App\Pet', 'related');
//    }
}
