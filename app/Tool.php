<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model {
    
	protected $fillable = [
		'type',
		'maker_butt',
		'name_butt',
		'maker_shaft',
		'name_shaft',
		'maker_tip',
		'name_tip',
		'other',
	];

	//rerations
    public function users()
    {
        return $this->belongsTo('User');
    }

}
