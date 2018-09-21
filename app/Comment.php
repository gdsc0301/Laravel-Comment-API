<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	/**
	* ComMeeting API
	*
	* - This is the Comment Model,
	* - You can customize the fillable and guarded
	* lists at your desire.
	*
	*/

    protected $fillable = [
      'author_id',
      'current_text',
      'edited',
      'history'];

    protected $guarded = [
      'updated_at',
      'created_at'];

		//Who's the author of this comment
    function author(){
      return $this->belongsTo('App\User');
    }
}
