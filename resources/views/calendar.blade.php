@extends('master')
@section('content')
    <!-- Include FullCalendar CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <!-- Logo Section -->
                <img src="{{ asset('images/logo.png') }}" alt="Tutorial Bangladesh Logo" style="height: 100px; margin-bottom: 20px;">
                <h1 class="display-4">Official Calendar</h1>
                <p class="lead">Manage and view your holidays with ease.</p>
            </div>
        </div>

        <div class="row">
            <!-- Calendar Section -->
            <div class="col-lg-8 mb-4">
                <div id="calendar" class="shadow rounded"></div>
            </div>

            <!-- Add Holiday Form Section -->
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add a Holiday</h4>
                        <form id="holiday-form" action="{{ route('holidays.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="holiday-date" class="form-label">Date</label>
                                <input type="date" id="holiday-date" name="date" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="holiday-title" class="form-label">Title</label>
                                <input type="text" id="holiday-title" name="title" class="form-control" placeholder="e.g., Independence Day" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add Holiday</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{ route('holidays.fetch') }}', // Fetch holidays from the backend
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek',
                },
                height: 'auto',
                contentHeight: 'auto',
                themeSystem: 'bootstrap', // Modern theme
            });

            calendar.render();
        });
    </script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        #calendar {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
        }

        .card-title {
            font-size: 1.6rem;
            font-weight: bold;
            color: #343a40;
        }

        .btn-primary {
            background-color: #0069d9;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-label {
            font-weight: bold;
            color: #495057;
        }

        .alert {
            font-size: 1rem;
        }
    </style>
@endsection
