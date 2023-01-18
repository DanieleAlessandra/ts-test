<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $locale = session()->get('locale');

        $query = "SELECT c.id,
       cl.name_alias AS name,
       COUNT(a.id) AS activities
FROM cities c
    INNER JOIN activities a on c.id = a.city_id
INNER JOIN cities_localizations cl on c.id = cl.city_id AND cl.lang = ?
GROUP BY a.city_id, c.id, cl.name_alias
HAVING COUNT(a.id) > 0
LIMIT 7;";


        $cities = DB::select($query, [$locale]);

        return view('homepage', ['cities' => $cities]);
    }
}
