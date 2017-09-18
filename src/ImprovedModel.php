<?php

namespace WeblaborMX\LaravelCrudHelper;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

trait ImprovedModel
{

    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::updating(function($table)  {
            $table->updated_by = \Auth::id();
        });

        static::creating(function($table)  {
            $table->created_by = \Auth::id();
            $table->updated_by = \Auth::id();
        });

    }

    /**
     * Scopes
     */

    public function scopeLast($query)
    {
        return $query->orderBy('id','DESC')->first();
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    /**
     * Relationships
     */

    public function creator_user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updater_user()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    /**
     * Attributes
     */

    public function getPrimaryUrlAttribute()
    {
        $primary = $this->getKeyName();
        return $this->$primary;
    }

    public function getTitleAttribute()
    {
        $primary = $this->title_field;
        if(!isset($primary))
            $primary = 'id';
        return $this->$primary;
    }

}
