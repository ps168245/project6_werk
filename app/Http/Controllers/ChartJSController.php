<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class ChartJSController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        [$monthsCount, $months] = $this->dashboardUserLinechartJs(); // first function
        [$yearsCount, $years] = $this->dashboardUserBarchartJs(); // second function

        // dd($years,$yearsCount, $months, $monthsCount);
        return view('stats', compact('months', 'monthsCount', 'years', 'yearsCount'));
    }

    public function dashboardUserBarchartJs()
    {
        $data = User::select('id', 'dateOfBirth')->orderBy('dateOfBirth')->get()->groupBy(function ($data) {
            return Carbon::parse($data->dateOfBirth)->format('Y'); // parse data to years instead of months (M = Months) (Y = Years)
        });
        $years = [];
        $yearsCount = [];
        foreach ($data as $year => $values) {
            $years[] = $year;
            $yearsCount[] = count($values);
        }

        return [$yearsCount, $years];
    }

    public function dashboardUserLinechartJs()
    {
        $data = User::select('id', 'created_at')->orderBy('created_at')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->format('M'); // parse data to month instead of year (M = Months) (Y = Years)
        });
        $months = [];
        $monthsCount = [];
        foreach ($data as $month => $values) {
            $months[] = $month;
            $monthsCount[] = count($values);
        }

        return [$monthsCount, $months];

    }
}
