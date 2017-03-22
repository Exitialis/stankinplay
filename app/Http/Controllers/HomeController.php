<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
	public function test()
	{
		return view('test1');
	}

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function testReq()
    {
        return response()->json(flash('kek'));
    }
}
