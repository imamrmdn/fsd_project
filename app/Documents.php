<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
  protected $table = 'documents';

  protected $fillable = [
    'Project_Id',
    'Nama_Dokumen',
    'Upload_By',
    'Document_Url'
  ];

  public function ProjectDetail(){
    return $this->hasOne(Project::class, 'Id' , 'Project_Id');
  }
}
