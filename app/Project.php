<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $table = 'list_project';

  protected $fillable = [
    'Nama_Project',
    'Status_Project',
    'Client_Id',
    'Upload_By'
  ];

  public $timestamps = false;

  public function clientDetail(){
    return $this->hasOne(client::class, 'Id', 'Client_Id');
  }

  // public function getUser(){
  //   return $this->hasOne(User::class, 'Id', 'Upload_By');
  // }
}
