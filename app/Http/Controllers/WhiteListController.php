<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhiteListController extends Controller
{

    public function index()
    {
        return view('educator.whitelist.whitelists');
    }

    public function whitelist_page(int $class)
    {
        $students = DB::select(
            "SELECT students.name, students.code, groups.name AS groupname, SUM(degrees.degree) AS Total
FROM degrees
JOIN students ON students.id = degrees.students_id
JOIN groups ON groups.id = students.groups_id
WHERE groups.class = ?
GROUP BY degrees.students_id, students.name, students.code, groups.name
ORDER BY Total DESC
LIMIT 10", [$class]);

        return view('educator.whitelist.whitelist', [
            'students' => $students
        ]);
    }


}
