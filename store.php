<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results Submission</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f4f4;
        }
        input[readonly] {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            cursor: not-allowed;
        }
        input[readonly] {
            padding: 5px;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            border-bottom: none;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        .card {
            background-color: #f9f9f9;
            border: none;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .card-title {
            font-weight: bold;
        }
        .input-group {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .input-group .form-control {
            flex: 1;
            margin-right: 5px;
        }
        .form-control {
            height: 38px;
            font-size: 16px;
        }
        /* Add custom styles to the navigation menu */
        .navbar {
            background-color: #007BFF;
        }
        .navbar-brand {
            color: #fff;
        }
        .nav-link {
            color: #333;
        }
        .menu-icon {
            margin-right: 8px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Add a brand/logo if needed -->
    <a class="navbar-brand" href="#">DEIS</a>
    <!-- Add a button to collapse the menu on smaller screens -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Create a menu structure inside a div with a collapse class -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <!-- Voting -->
            <li class="nav-item">
                <a href="dec_dashboard.php" class="nav-link">
                    <i class="fas fa-vote-yea menu-icon"></i>
                    Home
                </a>
            </li>
            <!-- Logout -->
            <li class="nav-item">
                <a href="backend/logout.php" class="nav-link">
                    <i class="fas fa-sign-out-alt menu-icon"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Election Results Submission Form</h2>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="positionSelect">Select Contested Position:</label>
                    <select class="form-control" id="positionSelect" name="positionSelect" onchange="updateCandidates()">
                        <option value="president">President (2 Candidates)</option>
                        <option value="vice_president">Vice President (3 Candidates)</option>
                        <option value="secretary">Secretary (1 Candidate)</option>
                    </select>
                </div>
                <!-- Candidates and Vote Count Section (Dynamically Populated Based on Selection) -->
                <div class="row" id="candidatesSection"></div>
                <!-- Total Votes and Denied Votes -->
                <div class="form-group">
                    <div class="input-group">
                        <input type="number" class="form-control" id="deniedVotes" name="deniedVotes" placeholder="Denied Votes" required>
                        <input type="number" class="form-control" id="totalVotes" name="totalVotes" placeholder="Total Votes" required readonly>
                    </div>
                </div>
                <!-- File Upload Input -->
                <div class="form-group">
                    <label for="referenceDocument">Reference/Witness Document:</label>
                    <input type="file" class="form-control-file" id="referenceDocument" name="referenceDocument">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit Results</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and any additional scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Function to update the candidates and vote count section based on the selected position
    function updateCandidates() {
        const positionSelect = document.getElementById("positionSelect");
        const candidatesSection = document.getElementById("candidatesSection");
        const selectedPosition = positionSelect.value;

        // Clear the current candidates and vote count section
        candidatesSection.innerHTML = "";

        // Create input fields for candidate names and vote count
        if (selectedPosition === "president") {
            createCandidateInputs(candidatesSection, ["Candidate 1", "Candidate 2"], 2);
        } else if (selectedPosition === "vice_president") {
            createCandidateInputs(candidatesSection, ["Candidate 1", "Candidate 2", "Candidate 3"], 3);
        } else if (selectedPosition === "secretary") {
            createCandidateInputs(candidatesSection, ["Candidate 1"], 1);
        }
    }

    // Function to create candidate input fields
    function createCandidateInputs(container, candidateNames, count) {
        for (let i = 1; i <= count; i++) {
            const candidateGroup = document.createElement("div");
            candidateGroup.classList.add("col-md-4");
            candidateGroup.innerHTML = `
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Candidate ${i}</h5>
                        <div class="form-group">
                            <label for="candidateName${i}">Candidate Name:</label>
                            <input type="text" class="form-control" id="candidateName${i}" name="candidateName${i}" value="${candidateNames[i - 1]}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="voteCount${i}">Votes Acquired:</label>
                            <input type="number" class="form-control" id="voteCount${i}" name="voteCount${i}" required>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(candidateGroup);
        }
    }

    // Initially populate the candidates and vote count based on the selected position
    updateCandidates();

// Function to calculate and display the total votes
function calculateTotalVotes() {
    let totalVotes = 0;

    // Calculate the sum of votes for all candidates
    for (let i = 1; i <= 3; i++) { // Update the loop limit based on your maximum number of candidates
        const voteCountInput = document.getElementById(`voteCount${i}`);
        if (voteCountInput) {
            const voteCount = parseInt(voteCountInput.value);
            totalVotes += isNaN(voteCount) ? 0 : voteCount;
        }
    }

    // Get denied votes and update the total votes
    const deniedVotesInput = document.getElementById("deniedVotes");
    if (deniedVotesInput) {
        const deniedVotes = parseInt(deniedVotesInput.value);
        totalVotes += isNaN(deniedVotes) ? 0 : deniedVotes;
    }

    // Update the "Total Votes" field
    const totalVotesInput = document.getElementById("totalVotes");
    if (totalVotesInput) {
        totalVotesInput.value = totalVotes;
    }
}

// Attach the calculateTotalVotes function to input change events
for (let i = 1; i <= 3; i++) { // Update the loop limit based on your maximum number of candidates
    const voteCountInput = document.getElementById(`voteCount${i}`);
    if (voteCountInput) {
        voteCountInput.addEventListener("input", calculateTotalVotes);
    }
}

const deniedVotesInput = document.getElementById("deniedVotes");
if (deniedVotesInput) {
    deniedVotesInput.addEventListener("input", calculateTotalVotes);
}

</script>
</body>
</html>
