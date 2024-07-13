<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Appointment</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
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
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 400px;
            text-align: center;
        }
        .alert-success {
            padding: 10px;
            border: 1px solid green;
            background-color: #dff0d8;
            color: green;
        }
    </style>
    <script>
        function toggleOnlinePreference() {
            var meetingMode = document.getElementById("meeting-mode");
            var onlinePreference = document.getElementById("online-preference-group");

            if (meetingMode.value === "online") {
                onlinePreference.style.display = "block";
            } else {
                onlinePreference.style.display = "none";
                document.getElementById("online-preference").value = ""; // Reset the online preference
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("meeting-mode").addEventListener("change", toggleOnlinePreference);
            toggleOnlinePreference(); // Initial call to set the correct state on page load

            @if(session('success'))
                showModal();
                setTimeout(hideModal, 3000);
            @endif
        });

        function showModal() {
            document.getElementById('successModal').style.display = 'block';
        }

        function hideModal() {
            document.getElementById('successModal').style.display = 'none';
        }
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
        <div class="appointment-form">
            <form action="/consultation" method="POST">
                @csrf
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="course">Course/Grade Level/Section:</label>
                <select id="course" name="course" required>
                    <option value="BSIT/1ST YEAR/101">BSIT/1ST YEAR/101</option>
                    <option value="BSIT/2ND YEAR/202">BSIT/2ND YEAR/202</option>
                    <option value="BSIT/3RD YEAR/301">BSIT/3RD YEAR/301</option>
                    <option value="BSIT/4TH YEAR/401">BSIT/4TH YEAR/401</option>
                </select>

                <label for="purpose">Purpose of Consultation:</label>
                <select id="purpose" name="purpose" required>
                    <option value="transfer">Transfer</option>
                    <option value="return-to-class">Return to Class - Academic</option>
                    <option value="graduating">Graduating Students</option>
                    <option value="personal">Personal</option>
                </select>

                <label for="department">Select Department Head/Admin:</label>
                <select id="department" name="department" required>
                    <option value="cs">CS Department</option>
                    <option value="engineering">Engineering</option>
                </select>

                <label for="meeting-mode">Select Meeting Mode:</label>
                <select id="meeting-mode" name="meeting_mode" required onchange="toggleOnlinePreference()">
                    <option value="face-to-face">Face to Face</option>
                    <option value="online">Online</option>
                </select>

                <div id="online-preference-group" style="display: none;">
                    <label for="online-preference">If Online Choose via Meeting Preference:</label>
                    <select id="online-preference" name="online_preference">
                        <option value="google-meet">Google Meet</option>
                        <option value="messenger">Messenger</option>
                    </select>
                </div>

                <label for="schedule">Select Schedule:</label>
                <input type="datetime-local" id="schedule" name="schedule" required>

                <button type="submit">Confirm Appointment</button>
            </form>
        </div>
    </div>

    <!-- The Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <div class="alert alert-success">
                Appointment confirmed successfully.
            </div>
        </div>
    </div>
</body>
</html>
