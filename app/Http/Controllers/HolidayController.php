<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;


class HolidayController extends Controller
{
    // Show the calendar page
    public function showCalendar()
    {
        return view('calendar');
    }

    // Fetch holidays as JSON
    public function fetchHolidays()
    {
        $holidays = Holiday::all();

        // Convert holidays to FullCalendar event format
        return $holidays->map(function ($holiday) {
            return [
                'title' => $holiday->title,
                'start' => $holiday->date,
                'allDay' => true,
            ];
        });
    }

    public function storeHoliday(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|unique:holidays,date',
            'title' => 'required|string|max:255',
        ]);
    
        Holiday::create($validated);
    
        // Redirect to the calendar page with a success message
        return redirect()->route('calendar.show')->with('success', 'Holiday added successfully!');
    }
    
    

}
