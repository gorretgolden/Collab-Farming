<?php

namespace App\Models;

use App\Traits\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'to',
        'title',
        'message'
    ];

    static function reports($dt)
    {

        $emails = [];



        switch ($dt) {
            case '30':
                $dates = array_reverse(Helpers::datesPast(30));
                foreach ($dates as $date) {
                    $emails[] = count(self::where(DB::raw('DATE(updated_at)'), $date)->get());
                }

                return array(
                    'data' => $emails,
                    'labels' => collect($dates)->map(function ($d) {
                        return date('d/M', strtotime($d));
                    })->all(),
                    'message' => [
                        'in the last 30 days',
                        'from ' . date("d/M", strtotime($dates[0])) . ' - ' . date("d/M", strtotime($dates[29]))
                    ]
                );
            case '6':
                $months = array_reverse(Helpers::monthsPast(6));
                foreach ($months as $month) {
                    $emails[] = count(self::where(DB::raw('MONTH(updated_at)'), date("m", strtotime($month)))->where(DB::raw('YEAR(updated_at)'), date("Y", strtotime($month)))->get());
                }
                return array(
                    'data' => $emails,
                    'labels' => collect($months)->map(function ($m) {
                        return date('F', strtotime($m));
                    })->all(),
                    'message' => [
                        'in the last 6 months',
                        'from ' . date("M/y", strtotime($month)) . ' - ' . date("M/y", strtotime($month))
                    ]
                );
            default:
                $months = array_reverse(Helpers::monthsPast(12));
                foreach ($months as $month) {
                    $emails[] = count(self::where(DB::raw('MONTH(updated_at)'), date("m", strtotime($month)))->where(DB::raw('YEAR(updated_at)'), date("Y", strtotime($month)))->get());
                }
                return array(
                    'data' => $emails,
                    'labels' => collect($months)->map(function ($m) {
                        return date('M/y', strtotime($m));
                    })->all(),
                    'message' => [
                        'in the last 12 months',
                        'from ' . date("M/y", strtotime($month)) . ' - ' . date("M/y", strtotime($month))
                    ]
                );
        }
    }
}
