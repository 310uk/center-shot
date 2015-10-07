<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pause extends Model {

	protected $fillable = ['play_id'];

	//rerations
    public function plays()
    {
        return $this->belongsTo('Play');
    }

}
