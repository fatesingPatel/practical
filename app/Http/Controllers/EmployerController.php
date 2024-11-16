<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use DB;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::all();
        return view('themes.default.index', compact('employers'));
    }

    public function create()
    {
        return view('themes.default.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employers',
            'phone_number' => 'required',
            'country_code' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'hobby' => 'required',
            'photo' => 'required'
        ]);

        $emp = $request->all();
        $emp['hobby'] = implode(',',$request->hobby); // Add the additional value
        Employer::create($emp);
      
        return redirect()->route('employers.index');
    }

    public function getData(Request $request)
    {
       
        $postData = $request->post();
        $response = array();
        $model = new Employer();

        $draw = isset($postData['draw']) ? $postData['draw'] : "";
        $offset = isset($postData['start']) ? $postData['start'] : 0;
        $searchValue = isset($postData['search']['value']) ? $postData['search']['value'] : "";
        $columnIndex = $postData['order'][0]['column'];
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder = $postData['order'][0]['dir'];
        $OrderBy = $columnName . " " . $columnSortOrder;
        $limit = isset($postData['length']) ? $postData['length'] : 10;
        $searchQuery = [];
        $totalRecords = $model->get()->toArray();
        $totalRecords = count($totalRecords);

        //        $searchQuery['status'] = 'Active';

        $totalRecords = DB::table('employers')
            ->select('id')
            ->where($searchQuery)
            // ->where('status', 'Active')
            // ->where('role', '1')
            ->orderBy($columnName, $columnSortOrder)
            ->get()->count();

        $totalRecord = DB::table('employers')
            ->select('id', 'first_name', 'last_name', 'created_at', 'email', 'phone_number')
            ->whereRaw("(first_name LIKE '%" . $searchValue . "%' or last_name LIKE '%" . $searchValue . "%' or email LIKE '%" . $searchValue . "%')")
            ->where($searchQuery)
            // ->where('status', 'Active')
            // ->where('role', '1')
            ->orderBy($columnName, $columnSortOrder)
            ->get();

        $totalRecordwithFilter = count($totalRecord);

        $results = DB::table('employers')
        ->select('id', 'first_name', 'last_name', 'created_at', 'email', 'phone_number')
            ->whereRaw("(first_name LIKE '%" . $searchValue . "%' or last_name LIKE '%" . $searchValue . "%' or email LIKE '%" . $searchValue . "%')")
            ->orderBy($columnName, $columnSortOrder)
            ->where($searchQuery)
            // ->where('status', 'Active')
            // ->where('role', '1')
            ->offset($offset)->limit($limit)
            ->get();

        $records = [];
        $url = url('/');
        foreach ($results as $record) {

          
            $records[] = [
                'first_name' => $record->first_name,
                'last_name' => $record->last_name,
                'email' => $record->email,
                'created_at' => date("d-m-Y h:s", strtotime($record->created_at))
            ];
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $records
        );

        echo json_encode($response);
    }

    public function edit(Employer $employer)
    {
        return view('themes.default.edit', compact('employer'));
    }

    public function update(Request $request, Employer $employer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employers,email,' . $employer->id,
            'phone' => 'required',
        ]);

        $employer->update($request->all());
        return redirect()->route('employers.index');
    }

    public function destroy(Employer $employer)
    {
        $employer->delete();
        return redirect()->route('employers.index');
    }
}
