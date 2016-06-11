<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  // whitelist property to be able to be edited en mass
  public $fillable = ['name'];

  public function descriptions()
  {
    return $this->hasMany(Description::class);
  }
}
