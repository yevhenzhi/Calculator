<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Calculate the amount of insulation needed for an attic.
     */
    public function calculate(Request $request): JsonResponse
    {
        $request->validate([
            'length' => ['required', 'int'],
            'width' => ['required', 'int'],
            'height' => ['required', 'int'],
            'roof_slope' => ['int', 'nullable'],
            'r_value' => ['int'],
        ]);

        $result = ($request->get('length') * $request->get('width') * $request->get('height')) / $request->get('r_value');

        return response()->json($result);
    }

}
