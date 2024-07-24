<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;

class AdminController extends Controller
{

    public function destroy($id)
    {
        $website = Website::findOrFail($id);
        $website->delete();

        return response()->json(null, 204);
    }
}
