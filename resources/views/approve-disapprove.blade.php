<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve - Disapprove</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .circle {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            border: 2px solid black;
            display: inline-block;
            margin-right: 10px;
            cursor: pointer;
        }
        .circle.selected {
            background-color: black;
        }
        .hidden {
            display: none;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            display: inline-block;
            text-align: left;
        }
        .modal-content h2 {
            margin-top: 0;
        }
        .modal-content .actions {
            text-align: center;
        }
        .modal-content .actions button {
            margin: 0 10px;
        }
    </style>
    <script>
        function toggleSelectionMode() {
            var circles = document.querySelectorAll('.circle');
            circles.forEach(function(circle) {
                circle.classList.toggle('hidden');
            });
        }

        function toggleCircleFill(event) {
            event.target.classList.toggle('selected');
        }

        function deleteSelectedRows() {
            var selectedCircles = document.querySelectorAll('.circle.selected');
            var idsToDelete = [];
            selectedCircles.forEach(function(circle) {
                var row = circle.closest('tr');
                idsToDelete.push(row.dataset.id);
            });

            if (idsToDelete.length > 0) {
                var form = document.getElementById('deleteForm');
                var input = document.getElementById('idsToDelete');
                input.value = idsToDelete.join(',');
                showModal();
            }
        }

        function checkSearchInput() {
            var searchInput = document.getElementById('searchInput');
            if (searchInput.value === '') {
                window.location.href = '{{ url("/approve-disapprove") }}';
            }
        }

        function showModal() {
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function hideModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        function confirmDelete() {
            var form = document.getElementById('deleteForm');
            form.submit();
        }

        document.addEventListener('DOMContentLoaded', function() {
            var selectButton = document.getElementById('selectButton');
            selectButton.addEventListener('click', toggleSelectionMode);

            var circles = document.querySelectorAll('.circle');
            circles.forEach(function(circle) {
                circle.addEventListener('click', toggleCircleFill);
            });

            var deleteButton = document.getElementById('deleteButton');
            deleteButton.addEventListener('click', deleteSelectedRows);

            var searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', checkSearchInput);

            document.getElementById('confirmDeleteButton').addEventListener('click', confirmDelete);
            document.getElementById('cancelDeleteButton').addEventListener('click', hideModal);
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Student Evaluation and Consultation</h1>
            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Student List</a></li>
                    <li><a href="/consultation">Appointment</a></li>
                    <li><a href="/approve-disapprove">Approve - Disapprove</a></li>
                    <li><a href="/calendar">Calendar</a></li>
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </nav>
        </div>
        <div class="approve-disapprove-form">
            <h2>Approve - Disapprove Appointments</h2>
            <form action="{{ url('/approve-disapprove') }}" method="GET">
                <input type="text" id="searchInput" name="search" value="{{ old('search', $search) }}" placeholder="Search">
                <button type="submit">Search</button>
                <button type="button" id="selectButton">Select</button>
            </form>
            <form id="deleteForm" action="{{ url('/approve-disapprove/delete') }}" method="POST">
                @csrf
                <input type="hidden" id="idsToDelete" name="idsToDelete">
            </form>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Course/Grade Level/Section</th>
                        <th>Purpose</th>
                        <th>Date / Time</th>
                        <th>Meeting Mode</th>
                        <th>Meeting Preference</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr data-id="{{ $appointment->id }}">
                            <td>
                                <div class="circle hidden"></div>
                            </td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->course }}</td>
                            <td>{{ $appointment->purpose }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->schedule)->format('Y-m-d H:i') }}</td>
                            <td>{{ ucfirst($appointment->meeting_mode) }}</td>
                            <td>{{ $appointment->meeting_mode === 'online' ? ucfirst($appointment->online_preference) : 'N/A' }}</td>
                            <td>
                                <form action="/approve-disapprove/approve/{{ $appointment->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit">Approve</button>
                                </form>
                                <form action="/approve-disapprove/disapprove/{{ $appointment->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit">Disapprove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="actions">
            <button type="button" id="deleteButton">Delete</button>
            <button type="button">Save PDF</button>
            <button type="button">Print</button>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete the selected appointments?</p>
            <div class="actions">
                <button id="confirmDeleteButton">Yes</button>
                <button id="cancelDeleteButton">No</button>
            </div>
        </div>
    </div>
</body>
</html>
