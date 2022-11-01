<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\EmailLog;
use App\Traits\Helpers;
use Illuminate\Http\Request;

class EmailLogsController extends Controller
{


    public function emailsAggregated(Request $request)
    {
        return Helpers::response(EmailLog::reports($request->type), 200);
    }

    public function emailsActual(Request $request)
    {
        return Helpers::response(EmailLog::orderBy('created_at', 'DESC')->paginate(5), 200);
    }
}
