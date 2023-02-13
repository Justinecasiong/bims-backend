<?php

namespace App\Http\Controllers;

use App\Models\BarangayInformation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class BarangayInformationController extends Controller
{
    public function index()
    {
        return response()->json(BarangayInformation::all(), 200);
    }

    public function update(Request $request, $id)
    {
        $name = time() . '.' . explode('/', explode(':', substr($request->municipality_logo, 0, strpos($request->municipality_logo, ';')))[1])[1];
        Image::make($request->municipality_logo)->save('img' . $name);
        $request->merge(['municipality_logo' => $name]);

        $name2 = time() . '.' . explode('/', explode(':', substr($request->barangay_logo, 0, strpos($request->barangay_logo, ';')))[1])[1];
        Image::make($request->barangay_logo)->save('img' . $name2);
        $request->merge(['barangay_logo' => $name2]);

        $barangay_info = BarangayInformation::where('id', $id);
        // $barangay_info->province = $request->province;
        // $barangay_info->municipality = $request->municipality;
        // $barangay_info->barangay = $request->barangay;
        // $barangay_info->contact_num = $request->contact_num;
        // $barangay_info->description = $request->description;
        // $barangay_info->municipality_logo = $request->municipality_logo;
        // $barangay_info->barangay_logo = $request->barangay_logo;
        // $barangay_info->hall_logo = $request->hall_logo;
        // $barangay_info->save();
        $barangay_info->update($request->all());

        return response()->json($barangay_info, 200);
    }

    public function getDB()
    {
        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';


        $queryTables = DB::select(DB::raw('SHOW TABLES'));
        foreach ($queryTables as $table) {
            foreach ($table as $tName) {
                $tables[] = $tName;
            }
        }
        // $tables  = array("users","products","categories"); //here your tables...

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword", array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';
        foreach ($tables as $table) {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach ($show_table_result as $show_table_row) {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for ($count = 0; $count < $total_row; $count++) {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "\nINSERT INTO $table (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }

        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
    }
}
