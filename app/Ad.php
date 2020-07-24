<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
  protected $fillable = [
      'title', 'description', 'price', 'localisation',
  ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
