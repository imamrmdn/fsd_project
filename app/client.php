<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
  protected $table = 'client';

  protected $fillable = [
    'Nama_Client',
    'Nama_Perusahaan',
    'Alamat_Perusahaan',
    'Logo',
    'Logo_Url'
  ];
}
