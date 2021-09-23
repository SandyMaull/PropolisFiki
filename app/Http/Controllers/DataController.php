<?php

namespace App\Http\Controllers;

use App\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.data.index');
    }

    public function getDataTables(Request $request){

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
   
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
   
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
   
        // Total records
        $totalRecords = Data::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Data::select('count(*) as allcount')->where('nama', 'like', '%' .$searchValue . '%')->count();
   
        // Fetch records
        $records = Data::orderBy($columnName,$columnSortOrder)
          ->where('data.nama', 'like', '%' .$searchValue . '%')
          ->select('data.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();
   
        $data_arr = array();
        $count = 0;
        foreach($records as $record){
           $id = $record->id;
           $count += 1;
           $nama = $record->nama;
           $no_telp = $record->no_telp;
           $position = $record->position;
           $getsuperior = Data::where('id', $record->superior)->first();
           $superior = ($getsuperior) ? $getsuperior->nama : 'Tidak Ada';
   
            // Update Button
            $updateButton = "<button class='btn btn-sm btn-info' data-id='".$id."' data-nama='".$nama."' data-no_telp='".$no_telp."' data-position='".$position."' data-superior='".$superior."' data-toggle='modal' data-target='#modal_edit_data' >Update</button>";
            // Delete Button
            $deleteButton = "<button class='btn btn-sm btn-danger' data-id='".$id."' data-nama='".$nama."' data-toggle='modal' data-target='#modal_delete_data'>Delete</button>";
            $action = $updateButton." ".$deleteButton;

           $data_arr[] = array(
             "id" => $count,
             "nama" => $nama,
             "no_telp" => $no_telp,
             "position" => $position,
             "superior" => $superior,
             "action" => $action
           );
        }
   
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );
   
        return json_encode($response);
    }

    public function getName(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = Data::where('nama', 'LIKE', '%'.$cari."%")->get();
            return response()->json($data);
        }
    }

    public function updateData(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'telp' => 'required',
            'position'=> 'required',
        ],
        [
            'id.required' => 'Field ID dibutuhkan!',
            'nama.required' => 'Field Nama dibutuhkan!',
            'telp.required' => 'Field Tanggal dibutuhkan!',
            'position.required' => 'Field Position dibutuhkan!',
            
        ]);
        if (!$request->superior) {
            if ($request->rem_superior == 1) {
                $edit = Data::where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'no_telp' => $request->telp,
                    'position' => $request->position,
                    'superior' => 0
                ]);
            } else {
                $edit = Data::where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'no_telp' => $request->telp,
                    'position' => $request->position
                ]);
            }
        } else {
            $edit = Data::where('id', $request->id)->update([
                'nama' => $request->nama,
                'no_telp' => $request->telp,
                'position' => $request->position,
                'superior' => $request->superior
            ]);
        }
        if ($edit) {
            return redirect()->route('all_data')->with(['status' => 'sukses', 'message' => ' Data Berhasil Diupdate!']);
        }
        else {
            return redirect()->route('all_data')->with(['status' => 'error','message' => ' Data Gagal Diupdate! Check Database/Server Log!.']);
        }
    }

    public function deleteData(Request $request)
    {
        $hapus = Data::destroy($request->id);
        if ($hapus) {
            return redirect()->route('all_data')->with(['status' => 'sukses', 'message' => ' Data Berhasil Dihapus!']);
        }
        else {
            return redirect()->route('all_data')->with(['status' => 'error','message' => ' Data Gagal Dihapus! Check Database Connection.']);
        }
    }
}
