<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'systems';

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
        'title', 'token_request', 'token_encrypt', 'url',
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
        
    ];

    /**
     * Campos do tipo Date da tabela
     *
     * @var array
     */
    protected $dates = [
        
    ];

    
    
    /**
     * Log
     *
     * @return App\Models\Log
     */
    public function logs()
    {
        return $this->hasMany('App\Models\Log', 'id', 'log_id');
    }
    /**
     * User
     *
     * @return App\Models\User
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'system_user', 'system_id', 'user_id');
    }
    
}
