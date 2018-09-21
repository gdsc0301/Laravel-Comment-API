<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  public function users()
  {
    //Which user this role belongs to
    return $this->belongsToMany(User::class);
  }
}
