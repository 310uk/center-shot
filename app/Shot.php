<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Shot extends Model {
    
	protected $fillable = ['play_id', 'result', 'memo'];


	//rerations
    public function plays()
    {
        return $this->belongsTo('Play');
    }

}
