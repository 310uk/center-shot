<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model {

	protected $fillable = ['user_id', 'mode'];

	//rerations
    public function users()
    {
        return $this->belongsTo('User');
    }
	
	
    public function shots()
    {
        return $this->hasMany('Shot');
    }

    public function pauses()
    {
        return $this->hasMany('Pause');
    }


}
