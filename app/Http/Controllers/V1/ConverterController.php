<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConverterController extends Controller
{
    public function convert(Request $request)
    {
        return response()->json([
            'converted' => $request->input('converted'),
        ]);
    }
}
