<?php

namespace Bmatovu\Uuid\tests\Models;

use Bmatovu\Uuid\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Model;

class Dummy extends Model
{
    use HasUuidKey;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $events = [
        'creating' => DummyCreatingEvent::class,
    ];
}
