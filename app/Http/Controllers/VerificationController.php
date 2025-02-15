<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function phone(Request $request)
    {
        $request->validate(['phone' => 'required']);

        return response(status: 204);
    }

    public function code(Request $request)
    {
        $request->validate(['code' => 'required']);

        return response(status: 204);
    }

    public function profile(Request $request)
    {
        return response(status: 204);
    }
}
