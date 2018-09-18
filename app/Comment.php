<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'author_id',
      'current_text',
      'edited',
      'history'];

    protected $guarded = [
      'updated_at',
      'created_at'];

    function author(){
      return $this->belongsTo('App\User');
    }
}
