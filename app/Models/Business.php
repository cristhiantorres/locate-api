<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
  protected $hidden = ['id'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function offices()
  {
    return $this->hasMany('App\Office');
  }

  public function addOffice(Office $office)
  {
    return $this->offices()->save($office);
  }
}