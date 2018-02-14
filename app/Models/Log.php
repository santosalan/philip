<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'system_id', 'action', 'url', 'table_name', 'username', 'json_data', 'confirmed',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'system',
    ];

    /**
     * Campos do tipo Date da tabela
     *
     * @var array
     */
    protected $dates = [
        
    ];

    /**
     * System
     *
     * @return App\Models\System
     */
    public function system()
    {
        return $this->belongsTo('App\Models\System', 'system_id', 'id');
    }
    
    
    
    
}
