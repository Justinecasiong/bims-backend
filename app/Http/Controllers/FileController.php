<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Logs;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $report = File::where('official_id', $request->id)->where(function ($query) use ($search) {
            if ($search) {
                $query->where('file_name', 'like', "%$search%");
            }
        })->paginate(10);

        return response()->json($report, 200);
    }

    public function reportType(Request $request)
    {
        $search = $request->search;
        $report = File::where('official_id', $request->id)->where(function ($query) use ($search, $request) {
            if ($search) {
                $query->where('file_name', 'like', "%$search%");
            }
            if ($request) {
                $query->where('report_type', $request->report_type);
            }
        })->paginate(10);

        return response()->json($report, 200);
    }

    public function formSubmit(Request $request)
    {
        $fileName = $request->file->getClientOriginalName();
        $request->file->move(public_path('upload'), $fileName);

        $file = new File();
        $file->file_name = $fileName;
        $file->official_id = $request->official_id;
        $file->report_type = $request->report_type;
        $file->save();

        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Created a file report.'
        ]);

        return response()->json(200);
    }

    public function download(Request $request)
    {
        return Response::download(public_path('upload/' . $request->fileName));
    }

    public function destroy($id, Request $request)
    {
        $users = User::where('remember_token', $request->remember_token)->first();
        Logs::create([
            'user_id' => $users->id,
            'user' => $users->name,
            'action' => 'Deleted a file report.'
        ]);
        return response()->json(File::destroy($id), 200);
    }
}
