<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Excel;
use Validator;
use App\Project;
use App\Timeline;
use App\Documents;
use App\client;
use App\User;
use App\Role;

class ProjectController extends Controller
{
    //--------Project--------
    public function Project()
    {
      $no = 1;
      $listclient = client::get();
      $listproject = Project::with('clientDetail')->get();
      return view("project.projects", compact('listproject', 'listclient', 'detail_project', 'no'));
    }

    public function AddProject(Request $request)
    {
      $valid = Validator::make($request->all(),[
        'Nama_Project' => 'required|string',
        'Status_Project' => 'required|integer',
        'Client_Id' => 'required|string'
      ]);

      if(!$valid->fails()){
        $add = Project::create([
          'Nama_Project' => $_REQUEST['Nama_Project'],
          'Status_Project' => $_REQUEST['Status_Project'],
          'Client_Id' => $_REQUEST['Client_Id'],
          'Upload_By' => Auth::user()->name,
        ]);
        if($add){
          $request->session()->flash('message.level', 'success');
          $request->session()->flash('message.content', '1 Data ditambah!');
          return redirect()->to('/project/list');
        }else{
          $request->session()->flash('message.level', 'danger');
          $request->session()->flash('message.content', '0 Data ditambah!');
          return redirect()->to('/project/list');
        }
      }else{
        return $valid->errors();
      }
    }

    public function DeleteProject($Id, Request $request)
    {
      $detail_project = Project::where('Id', $Id)->delete();
      $listtimeline = Timeline::where('Project_Id', $Id)->delete();
      $listdoc = Documents::where('Project_Id', $Id)->delete();

      if($detail_project || $listtimeline || $listdoc){
        return redirect()->to('/project/list');
      }else{
        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', '0 Data Terhapus!');
        return redirect()->to('/project/list');
      }
    }

    //--------View Timeline Documents Setting--------
    public function ActionView($Id)
    {
      $no = 1;
      $nod = 1;
      $listproject = Project::get();
      $listclient = client::get();
      $role = Role::find($Id);
      $detail_project = Project::find($Id);
      $timeline = Timeline::find($Id);
      $listtimeline = Timeline::where('Project_Id', $Id)->get();
      $listdoc = Documents::where('Project_Id', $Id)->get();
      // $client = client::where('Id', $Id)->get();
      if (empty($detail_project)) return redirect()->to('/project/list');

      return view("project.view", compact(
        'nod', 'no', 'listtimeline' , 'listproject' , 'detail_project' ,
        'listdoc' , 'listclient' , 'timeline' , 'listclient'
      ));
    }

    //--------Timeline--------
    public function AddTimeline($Id, Request $request)
    {
      $detail_project = Project::find($Id);
      if (empty($detail_project)) return redirect()->to('/project/list');

      $valid = Validator::make($request->all(),[
        'Modul' => 'required|string|',
        'Tanggal_awal' => 'required|date',
        'Tanggal_akhir' => 'required|date',
        'PIC' => 'required|string',
        'Status' => 'required|integer'
      ]);

      if(!$valid->fails()){
        $add = Timeline::create([
          'Project_Id' => $detail_project->Id,
          'Modul' => $_REQUEST['Modul'],
          'Tanggal_awal' => $_REQUEST['Tanggal_awal'],
          'Tanggal_akhir' => $_REQUEST['Tanggal_akhir'],
          'PIC' => $_REQUEST['PIC'],
          'Status' => $_REQUEST['Status']
        ]);

        if($add){
          return redirect()->to('/action/view/' . $detail_project->Id);
        }else{
          return "errors";
        }
      }else{
        return $valid->errors();
      }
    }

    public function viewEditTimeline($Id, $Project_Id, Request $request)
    {
      // dd($Id);
      $detail_project = Project::find($Project_Id)->first();
      //dd($detail_project);
      $edittml = Timeline::where('Project_Id', $Id)->get();
      $listtimeline = Timeline::find($Id);
      return view("project.edittimeline", compact( 'listtimeline', 'edittml', 'detail_project'));
    }

    public function editTimeline($Id, $Project_Id, Request $request)
    {
      $detail_project = Project::find($Project_Id);
      if (empty($detail_project)) return redirect()->to('/project/list');

      $listtimeline = Timeline::find($Id);
      $valid = Validator::make($request->all(), [
        'Status' => 'required|integer'
      ]);

      if(!$valid->fails()){
        $status = DB::table('timeline')->where('Id', $Id)->update(array(
          'Status' => $request->input('Status')));

        if($status>0){
          $request->session()->flash('message.level', 'success');
          $request->session()->flash('message.content', '1 Data Terupdate!');
          return redirect()->to('/action/view/' .$detail_project->Id);
        }else{
          $request->session()->flash('message.level', 'danger');
          $request->session()->flash('message.content', '0 Data Terupdate!');
          return redirect()->to('/action/view/' .$detail_project->Id);
          // return "gagal edit data";
        }
      }else{
        return $valid->errors();
      }
    }

    //--------ExportTimelineTo Excel
    public function exportExcel( $type, $Project_Id)
    {

      $data = Timeline::where('Project_Id', $Project_Id)->get();
       return Excel::create('Timeline', function($excel) use ($data) {
           $excel->sheet('mySheet', function($sheet) use ($data)
           {
               $sheet->fromArray($data);
           });
       })->download($type);
    }

    //--------Documents--------
    public function AddDocuments($Id, Request $request)
    {
      $detail_project = Project::find($Id);
      if (empty($detail_project)) return redirect()->to('/project/list');

      $valid = Validator::make($request->all(),[
        'Document_Url' => 'required|file',
      ]);

      if(!$valid->fails()){
        $uploaddoc = $request->file('Document_Url');

        $add = Documents::create([
          'Project_Id' => $detail_project->Id,
          'Nama_Dokumen' => $uploaddoc->getClientOriginalName(),
          'Upload_By' => Auth::user()->name,
          'Document_Url' => $uploaddoc->store('public/files')
        ]);

        if($add){
          return redirect()->to('/action/view/' . $detail_project->Id);
        }else{
          return "errors";
        }
      }else{
        return $valid->errors();
      }
    }

    public function DeleteDocuments($Id, $Project_Id)
    {
      $delete = DB::delete("DELETE FROM documents WHERE id = ?" ,[$Id]);

      if($delete>0){
        return redirect()->to('/action/view/' . $Project_Id);
      }else{
        return "errors";
      }
    }

    //--------Setting--------
    public function SettingProject($Id, Request $request)
    {
      $detail_project = Project::find($Id);
      $valid = Validator::make($request->all(),[
        'Nama_Client' => 'required|integer',
        'Status_Project' => 'required|integer'
      ]);

      if(!$valid->fails()){
        $status = DB::table('list_project')->where('Id', $Id)->update(array(
          'Status_Project' => $request->input('Status_Project'),
          'Client_Id' => $request->input('Nama_Client')));

        if($status){
          $request->session()->flash('message.level', 'success');
          $request->session()->flash('message.content', '1 Project Berhasil Terupdate!');
          return redirect()->to('/project/list');
        }else{
          return "errors";
        }
      }else{
        return $valid->errors();
      }
    }

    //--------Client Management--------
    public function Client()
    {
      $no = 1;
      $listclient = client::get();
      return view("administrator.client", compact('listclient', 'no'));
    }

    public function AddClient(Request $request)
    {
        $valid = Validator::make($request->all(),[
        'Nama_Client' => 'required|string',
        'Nama_Perusahaan' => 'required|string',
        'Alamat_Perusahaan' => 'required|string',
        'Logo_Url' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      ]);

      if(!$valid->fails()){
        $uploadlogo = $request->file('Logo_Url');
        $uploadlogo->storeAs('public/files',$uploadlogo->getClientOriginalName());

        $add = Client::create([
          'Nama_Client' => $_REQUEST['Nama_Client'],
          'Nama_Perusahaan' => $_REQUEST['Nama_Perusahaan'],
          'Alamat_Perusahaan' => $_REQUEST['Alamat_Perusahaan'],
          'Logo' => $uploadlogo->getClientOriginalName(),
          'Logo_Url' => 'viewImage/files/'.$uploadlogo->getClientOriginalName()
        ]);
        if($add){
          return redirect()->to('/client/list');
        }else{
          return "errors";
        }
      }else{
        return $valid->errors();
      }
    }

    //--------User Management--------
    public function User()
    {
      $no = 1;
      $listrole = Role::get();
      $listuser = User::get();
      return view("administrator.user", compact('listuser', 'listrole', 'no'));
    }

    public function AddUser(Request $request)
    {
      $valid = Validator::make($request->all(),[
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'Position_Id' => 'required|string',
        'phone' => 'required|string|max:13',
        'address' => 'required|string',
      ]);

      if(!$valid->fails()){
        $add = User::create([
          'name' => $_REQUEST['name'],
          'email' => $_REQUEST['email'],
          'password' => bcrypt($_REQUEST['password']),
          'Position_Id' => $_REQUEST['Position_Id'],
          'phone' => $_REQUEST['phone'],
          'address' => $_REQUEST['address'],
        ]);
        if($add){
          $request->session()->flash('message.level', 'success');
          $request->session()->flash('message.content',
                                     '1 Data Berhasil Di Tambahkan!');
          return redirect()->to('/user/list');
        }else{
          $request->session()->flash('message.level', 'danger');
          $request->session()->flash('message.content', 'Error!');
          return "errors";
        }
      }else{
        return $valid->errors();
      }

    }

    public function DeleteUser($id, Request $request)
    {
      $delete = User::find($id)->delete();

      if($delete){
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content',
                                   '1 Data Berhasil Dihapus!');
        return redirect()->to('/user/list');
      }else{
        return "gagal menghapus";
      }
    }

    //--------Role Management--------
    public function Role()
    {
      $no = 1;
      $listrole = Role::get();
      $listuser = User::get();
      return view("administrator.role", compact('listrole', 'no', 'listuser'));
    }

    public function AddRole(Request $request)
    {
      $valid = Validator::make($request->all(),[
        'Nama_Role' => 'required|string',
        'Deskripsi' => 'required|string',
        'Data' => 'required|string'
      ]);

      if(!$valid->fails()){
        $add = Role::create([
          'Nama_Role' => $_REQUEST['Nama_Role'],
          'Deskripsi' => $_REQUEST['Deskripsi'],
          'Data' => $_REQUEST['Data']
        ]);
        if($add){
          return redirect()->to('/role/list');
        }else{
          return "errors";
        }
      }else{
        return $valid->errors();
      }
    }

    public function viewEditRole($Id, Request $request)
    {
      $role = Role::find($Id);
      return view("administrator.editrole", compact('role'));
    }

    public function EditRole($Id, Request $request)
    {
      $role = Role::find($Id);
      $valid = Validator::make($request->all(),[
        'Deskripsi' => 'required|string',
        'Data' => 'required|string'
      ]);

      if(!$valid->fails()){
        $status = DB::table('role')->where('Id', $Id)->update(array(
          'Deskripsi' => $request->input('Deskripsi'),
          'Data' => $request->input('Data')));

        if($status){
          return redirect()->to('/role/list');
        }else{
          return "errors";
        }
      }else{
        return $valid->errors();
      }
    }
}
