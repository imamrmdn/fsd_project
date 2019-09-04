<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
  protected $table = 'timeline';

  protected $fillable = [
    'Project_Id',
    'Modul',
    'Tanggal_awal',
    'Tanggal_akhir',
    'PIC',
    'Status'
  ];

  public $timestamps = false;

  public function ProjectDetail(){
    return $this->hasOne(Project::class, 'Id' , 'Project_Id');
  }
}
