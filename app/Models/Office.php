<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
  protected $hidden = ['id'];

  public function business()
  {
    return $this->belongsTo('App\Business');
  }
}