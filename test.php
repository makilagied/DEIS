<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Voting Demo</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('img/udsm.jpeg'); /* Replace 'your-background-image.jpg' with your image URL */
            background-size: cover;
            /* filter: blur(5px); */
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0; /* Remove default margin for full coverage */
        }

        .container {
            max-width: 800px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7); /* Adjusted background color with opacity */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #0073e6;
        }

        input[type="text"], button {
            padding: 10px;
            margin: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        /* Style cards for positions */
        .position-card {
            display: inline-block;
            width: 30%;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 10px;
            text-align: center;
        }

        .position-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            background-color: #007bff;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
        }

        .position-card .form-check-label {
            font-size: 16px;
            display: block;
        }

        /* Style the Submit button */
        #submit-button {
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Electronic Voting Demo</h1>
        <div id="otpVerification">
            <h2>OTP Verification</h2>
            <input type="text" id="otpInput" class="form-control" placeholder="Enter OTP">
            <button onclick="verifyOTP()" class="btn btn-primary">Verify OTP</button>
        </div>
        <div id="ballotPaper" style="display: none;">
            <h2>Ballot Paper</h2>
            <form id="votingForm">
                <!-- President -->
                <div class="position-card">
                    <h3>President</h3>
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="president">
                        Candidate A
                    </label>
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="president">
                        Candidate B
                    </label>
                </div>
                <!-- Vice President -->
                <div class="position-card">
                    <h3>Vice President</h3>
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="vice_president">
                        Candidate C
                    </label>
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="vice_president">
                        Candidate D
                    </label>
                </div>
                <!-- Secretary -->
                <div class="position-card">
                    <h3>Secretary</h3>
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="secretary">
                        Candidate E
                    </label>
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="secretary">
                        Candidate F
                    </label>
                </div>
                <button id="submit-button" type="submit" class="btn btn-primary">Submit Vote</button>
            </form>
        </div>
        <div id="confirmation" style="display: none;">
            <h2>Vote Confirmation</h2>
            <p>Your vote has been recorded.</p>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Simulated OTP (for demonstration purposes)
        const simulatedOTP = "123456";

        // Function to verify OTP and show the ballot paper
        function verifyOTP() {
            const otpInput = document.getElementById("otpInput").value;
            if (otpInput === simulatedOTP) {
                document.getElementById("otpVerification").style.display = "none";
                displayBallotPaper();
            } else {
                alert("Invalid OTP. Please try again.");
            }
        }

        // Function to display the ballot paper
        function displayBallotPaper() {
            const ballotPaper = document.getElementById("ballotPaper");
            ballotPaper.style.display = "block";
        }

        // Function to check if a candidate is selected for each position before submission
        function checkBallot() {
            const positions = ["president", "vice_president", "secretary"];
            for (const position of positions) {
                const selectedCandidate = document.querySelector(`input[name="${position}"]:checked`);
                if (!selectedCandidate) {
                    alert(`Please select a candidate for ${position}.`);
                    return false;
                }
            }
            return true;
        }

        // Event listener for form submission
        document.getElementById("votingForm").addEventListener("submit", function (event) {
            event.preventDefault();
            if (checkBallot()) {
                document.getElementById("votingForm").style.display = "none";
                document.getElementById("confirmation").style.display = "block";
            }
        });
    </script>
</body>
</html>
