<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or show a message
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>DEIS | Dashboard</title>
  <!-- Include Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <!-- Include the external JS file -->
   <!-- <script src="js/main.js"></script> -->
   <!-- external css -->
  <link rel="stylesheet" href="css/main.css">
      <!-- Include jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="dashboard-container">
  <div class="dashboard-header">
    <h1 class="mb-0 text-center">ELECTION COMMETTE </h1>
    <div class="user-info">
      <div class="profile-icon">ED</div>
    </div>
  </div>


   <!-- Modify your navigation menu with Bootstrap classes and Font Awesome icons -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button id="navbar-toggler-icon" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuCollapse" aria-controls="menuCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="menuCollapse">
    <ul class="navbar-nav ml-auto">
      <!-- Profile -->
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="toggleContent('profile')">
          <i class="fas fa-user menu-icon"></i>
          Profile
        </a>
      </li>

   <!-- Navigation menu item for Results with dropdown -->
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="resultsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-file menu-icon"></i>
    Results
  </a>
  <div class="dropdown-menu" aria-labelledby="resultsDropdown">
    <a href="#" class="nav-link" onclick="toggleContent('results')">
      <i class="fas fa-poll-h menu-icon"></i> Election Results
    </a>
    <a href="store.php" class="nav-link">
      <i class="fas fa-vote-yea menu-icon"></i> Polling Results
    </a>
  </div>
</li>


      <!-- Statistics -->
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="toggleContent('statistics')">
          <i class="fas fa-chart-bar menu-icon"></i>
          Statistics
        </a>
      </li>

      <!-- Assessment Forms -->
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="toggleContent('assessment')">
          <i class="fas fa-file-alt menu-icon"></i>
          Assessment Forms
        </a>
      </li>

      <!-- Nominations -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="nominationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-check menu-icon"></i>
          Nominations
        </a>
        <div class="dropdown-menu" aria-labelledby="nominationsDropdown">
          <a class="dropdown-item" href="#" onclick="toggleContent('nominations')">
            <i class="fas fa-users menu-icon"></i>
            Nominations
          </a>
          <a class="dropdown-item" href="#" onclick="toggleContent('nominationResults')">
            <i class="fas fa-poll menu-icon"></i>
            Nomination Results
          </a>
        </div>
      </li>

      <!-- Voting -->
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="toggleContent('voting')">
          <i class="fas fa-vote-yea menu-icon"></i>
          Voting
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




  
  <!-- Content sections -->
      <!-- Voter Verification content -->
      <div class="content-section" id="votingContent">
      <h2>Voter Verification</h2>
      <div class="row mt-4">
        <div class="col-md-12 dashboard-content">
          <div class="search-box">
            <input type="text" id="surname" class="search-input" placeholder="Enter Surname">
            <input type="text" id="regName" class="search-input" placeholder="Enter Registration Number">
            <button class="search-button" onclick="performSearch()">Verify Voter</button>
            <div class="message-box" id="messageBox"></div>
          </div>
        </div>
      </div>
    </div>

  <!-- Profile content goes here -->
  <div class="content-section" id="profileContent">
    <div class="profile-card">
      <div class="profile-icon">ED</div>
      <h2 class="profile-name">Erick Dick</h2>
      <p class="profile-title">Computer Science</p>
      <p class="profile-description">Passionate about coding and creating innovative solutions.</p>
    </div>
  </div>
  
  <!-- Content sections -->
<div class="content-section" id="settingsContent">
    <h2>Settings</h2>
    <form id="settingsForm">
      <label for="backgroundColor">Theme</label>
      <input type="color" id="backgroundColor" name="backgroundColor" value="#f8f9fa"><br><br>
      <button type="button" onclick="applySettings()">Apply</button>
    </form>
    <script>
        function applySettings() {
  var backgroundColor = document.getElementById("backgroundColor").value;
  document.body.style.backgroundColor = backgroundColor;
  alert("Settings applied successfully!");
}

    </script>
  </div>
  

  <!-- results -->
  <div class="content-section" id="resultsContent">
    <!-- Results Bar Chart -->
    <div class="chart-section">
      <h2>Results Bar Chart</h2>
      <div style="max-height: 5cm; overflow: hidden;">
        <canvas id="resultsBarChart" style="max-height: 5cm;"></canvas>
      </div>
    </div>
  </div>
  

  <!-- stats -->
  <div class="content-section" id="statisticsContent">
    <!-- Bar Chart -->
    <div class="chart-section">
      <h2>Bar Chart</h2>
      <div style="max-height: 5cm; overflow: hidden;">
        <canvas id="barChart" style="max-height: 5cm;"></canvas>
      </div>
    </div>
  
    <!-- Pie Chart -->
    <div class="chart-section">
      <h2>Pie Chart</h2>
      <div style="max-height: 5cm; overflow: hidden;">
        <canvas id="pieChart" style="max-height: 5cm;"></canvas>
      </div>
    </div>
  
    <!-- Histogram -->
    <div class="chart-section">
      <h2>Histogram</h2>
      <div style="max-height: 5cm; overflow: hidden;">
        <canvas id="histogramChart" style="max-height: 5cm;"></canvas>
      </div>
    </div>
  </div>


  <div class="content-section" id="nominationsContent">
  <h1>Contestant Registration</h1>
  <form>
    <div class="row">
      <!-- First Column -->
      <div class="col-md-4">
        <div class="form-group">
          <label for="registration_number">Registration Number:</label>
          <input type="text" class="form-control" id="registration_number">
        </div>
        <button type="button" class="btn btn-primary" onclick="searchUser()">Search User</button>
      </div>

      <!-- Second Column -->
      <div class="col-md-4">
        <div class="form-group">
          <label for="contesting_role">Contesting Role:</label>
          <select class="form-control" id="contesting_role">
            <option value="President">President</option>
            <option value="Vice President">Vice President</option>
            <option value="Secretary">Secretary</option>
            <!-- Add more contesting roles as needed -->
          </select>
        </div>
        <button type="button" class="btn btn-success" onclick="storeContestant()">Store Contestant</button>
      </div>

      <!-- Third Column -->
      <div class="col-md-4">
        <div id="userInformation"></div>
      </div>
    </div>
  </form>
</div>






    </div>
  </div>

  <!-- Nomination Results content -->
  <div class="content-section" id="nominationResultsContent" style="display: none;">
    <!-- Form to select candidate filter criteria -->
    <div class="container mt-5">
      <h2>Select Candidates to Display</h2>
      <form id="candidateFilterForm">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="positionFilter">Position:</label>
            <select class="form-control" id="positionFilter" name="positionFilter">
              <option value="all">All Positions</option>
              <option value="President">President</option>
              <option value="Vice President">Vice President</option>
              <option value="Secretary">USRC</option>
              <!-- Add more position options here -->
            </select>
          </div>
          <!-- Add more filter criteria if needed -->
        </div>
        <div class="text-center">
          <button type="button" class="btn btn-primary" onclick="filterCandidates()">Apply Filters</button>
        </div>
      </form>
    </div>

    <!-- Table to display nominated persons and their scores -->
    <div class="container mt-5">
      <h2>Nominated Persons and Scores</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
          <th>Reg Number</th>
            <th>Candidate Name</th>
            <th>Position</th>
            <th>Score</th>
          </tr>
        </thead>
        <tbody id="candidateTableBody">
          <!-- Data will be populated here based on user selection -->
        </tbody>
      </table>
    </div>
  </div>






<!-- Assessment Forms content -->
<div class="content-section" id="assessmentContent">
  <div class="container mt-5">
    <h1 class="text-center">DARUSO Assessment Form</h1>
    <form id="assessmentForm">
      <!-- Personal Information -->
      <div class="form-group">
        <label for="postDropdown">Select Post:</label>
        <select class="form-control" id="postDropdown" required onchange="fetchCandidates()">
          <option value="">Select Post</option>
          <!-- Use PHP to populate this dropdown with contestant roles from your database -->
          <?php
            // Establish a database connection
            $servername = "localhost";
            $username = "makilagied";
            $password = "password";
            $dbname = "DEIS";
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to fetch contestant roles from the "contestant" table
            $query = "SELECT DISTINCT contesting_role FROM contestant"; // Modify this if you need other criteria

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Output an option for each contestant role
                    echo "<option value='{$row['contesting_role']}'>{$row['contesting_role']}</option>";
                }
            } else {
                echo "No contestant roles found in the database.";
            }

            // Close the database connection
            $conn->close();
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="candidateDropdown">Select Candidate:</label>
        <select class="form-control" id="candidateDropdown" required disabled>
          <option value="">Select Candidate</option>
          <!-- This dropdown will be populated dynamically using JavaScript -->
        </select>
      </div>

      <!-- Rest of the form remains unchanged -->
            <!-- Button to reveal criteria section -->
            <div class="text-center">
        <button type="button" class="btn btn-primary" id="showCriteriaButton" onclick="showCriteriaSection()">Next: Criteria for Assessment</button>
      </div>

      <!-- Criteria for Assessment Section (Initially hidden) -->
      <div id="criteriaSection" style="display: none;">
        <h2 class="text-center">Criteria for Assessment</h2>
        <!-- Your criteria table remains unchanged -->
        <table class="table table-bordered">
        <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Criteria for Assessment</th>
                        <th>G/Marks</th>
                        <th>Marks Scored</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- You can add more rows for other criteria -->
                    <tr>
                        <td>1</td>
                        <td>Physical Appearance and Personality</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score1" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Confidence of the Aspirant</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score2" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Knowledge about the Existing Students’ Problems</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score3" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Knowledge about DARUSO</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score4" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Response to the Questions</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score5" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Fluency in Both English and Swahili Languages</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score6" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Articulation</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score7" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Leadership Experience</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score8" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Uniqueness and Neatness</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score9" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>International and Cross Cutting Issues</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score10" min="1" max="10" required></td>
                    </tr>
                </tbody>
        </table>

        <div class="form-group">
          <label for="committeeMemberSignature">Signature:</label>
          <input type="text" class="form-control" id="committeeMemberSignature" name="committee_member_signature" required>
        </div>
      <!-- Submit Button -->
      <div class="text-center">
        <button type="button" class="btn btn-primary" onclick="submitAssessment()">Submit Assessment</button>
      </div>

    </form>
  </div>
</div>  
</div>
</div>
  </div>
</div>









<!-- Include Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!-- Include Bootstrap JS and any additional scripts --><script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>






  function toggleContent(contentId) {
    // Hide all content sections
    var contentSections = document.querySelectorAll('.content-section');
    contentSections.forEach(function(section) {
      section.style.display = 'none';
    });

    // Show the selected content section
    var selectedContent = document.getElementById(contentId + 'Content');
    selectedContent.style.display = 'block';
  }




function performSearch() {
  var surname = document.getElementById("surname").value;
  var regName = document.getElementById("regName").value;

  // Send the data to the server for user existence check and OTP generation
  fetch("backend/check_user.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ surname: surname, regName: regName }),
  })
    .then(response => response.json())
    .then(data => {
      var messageBox = document.getElementById("messageBox");
      messageBox.innerHTML = "";

      if (data.exists) {
        if (data.message === "") {
          messageBox.innerHTML = "<p>Your OTP Code: " + data.otp + "</p>";
        } else {
          messageBox.innerHTML = "<p>" + data.message + "</p>";
        }
      } else {
        messageBox.innerHTML = "<p>Error: Student not found.</p>";
      }
    })
    .catch(error => {
      console.error("Error:", error);
    });
}



    // Function to generate random data
    function generateRandomData(count) {
      const data = [];
      for (let i = 0; i < count; i++) {
        data.push(Math.floor(Math.random() * 100));
      }
      return data;
    }
  
    // Function to create charts

    // Function to create the Results Bar Chart
    function createResultsBarChart() {
      var resultsBarChart = new Chart(document.getElementById("resultsBarChart"), {
        type: 'bar',
        data: {
          labels: ['Candidate 1', 'Candidate 2', 'Candidate 3'],
          datasets: [{
            label: 'Results',
            data: [85, 70, 60], // Sample data
            backgroundColor: ['#0864AF', '#F6B418', '#6BBE45'],
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              beginAtZero: true,
            },
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }
  
    // Function to create the Statistics Charts
    function createStatisticsCharts() {
      // Bar Chart
      var barChart = new Chart(document.getElementById("barChart"), {
        type: 'bar',
        data: {
          labels: ['COICT', 'COHU', 'COSS 3'],
          datasets: [{
            label: 'COLLEGE PARTICIPATIONS',
            data: generateRandomData(3),
            backgroundColor: ['#0864AF', '#F6B418', '#6BBE45'],
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
        },
      });
  
      // Pie Chart
      var pieChart = new Chart(document.getElementById("pieChart"), {
        type: 'pie',
        data: {
          labels: ['Year 1', 'Year 2', 'Year 3','Year 4','Year 5'],
          datasets: [{
            label: 'STUDY YEAR PARTICIPATION',
            data: generateRandomData(5),
            backgroundColor: ['#0864AF', '#F6B418', '#6BBE45','#08C9AF', '#F6B4C8'],
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
        },
      });
  
      // Histogram
      var histogramChart = new Chart(document.getElementById("histogramChart"), {
        type: 'bar',
        data: {
          labels: ['Male', 'Female'],
          datasets: [{
            label: 'GENDER INVOLVEMENT',
            data: generateRandomData(2),
            backgroundColor: ['#0864AF', '#F6B418'],
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              beginAtZero: true,
            },
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }
  
    // Call the functions to create charts when the page loads
    window.onload = function () {
      createResultsBarChart();
      createStatisticsCharts();
    };

    

  function fetchCandidates() {
    let selectedRole = document.getElementById("postDropdown").value;
    let candidateDropdown = document.getElementById("candidateDropdown");

    // Clear the current options in the "Select Candidate" dropdown
    candidateDropdown.innerHTML = '<option value="">Select Candidate</option>';

    if (selectedRole) {
      // Make an AJAX request to fetch candidate names and registration numbers based on the selected role
      // You can use XMLHttpRequest, fetch, or a library like Axios for this purpose
      // Upon receiving a response, populate the "Select Candidate" dropdown with the retrieved data

      // Example using fetch (adjust the URL and data format as per your server-side script)
      fetch("fetch_candidates.php", {
        method: "POST",
        body: JSON.stringify({ selectedRole }), // Send the selected role to the server
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => response.json())
        .then((data) => {
          if (data && data.length > 0) {
            // Populate the "Select Candidate" dropdown with candidate names and registration numbers
            data.forEach((candidate) => {
              let option = document.createElement("option");
              option.value = candidate.regnumber;
              option.textContent = `${candidate.surname} (${candidate.regnumber})`;
              candidateDropdown.appendChild(option);
            });

            // Enable the "Select Candidate" dropdown
            candidateDropdown.removeAttribute("disabled");
          } else {
            // No candidates found for the selected role
            candidateDropdown.innerHTML = '<option value="">No candidates found</option>';
            candidateDropdown.setAttribute("disabled", "true");
          }
        })
        .catch((error) => {
          console.error("Error fetching candidates:", error);
        });
    }
  }


  function showCriteriaSection() {
    let selectedCandidate = candidateDropdown.value;
    if (selectedCandidate) {
      document.getElementById('criteriaSection').style.display = 'block';
    } else {
      alert('Please select a candidate first.');
    }
  }


// Function to submit the assessment form
function submitAssessment() {
  // You can add validation code here to ensure all required fields are filled
  
  // Capture the selected candidate's registration number from the dropdown
  let selectedCandidateRegistrationNumber = document.getElementById("candidateDropdown").value;

  // Check if a candidate is selected
  if (!selectedCandidateRegistrationNumber) {
    alert("Please select a candidate before submitting.");
    return;
  }

  // Prepare the data to be sent via AJAX
  let formData = $("#assessmentForm").serialize();
  // Add the selected candidate's registration number to the data
  formData += `&registration_number=${selectedCandidateRegistrationNumber}`;

  // Submit the form via AJAX to the process_assessment.php script
  $.ajax({
    type: "POST",
    url: "process_assessment.php",
    data: formData, // Include the registration_number in the data
    success: function (response) {
      // Handle the response from the PHP script (e.g., display a success message)
      alert(response);
      // You can also reset the form if needed
      document.getElementById("assessmentForm").reset();
    },
    error: function () {
      alert("Error submitting assessment.");
    },
  });
}






  function searchUser() {
  const registrationNumber = document.getElementById('registration_number').value;

  // Create a JSON object to send in the request
  const requestData = { registrationNumber: registrationNumber };

  // Make an AJAX request to the PHP script with the registration number
  fetch('search_user.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(requestData),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text(); // Assuming the response is plain text
    })
    .then((userInfo) => {
      // Process the userInfo as needed
      displayUserInfo(userInfo);
    })
    .catch((error) => {
      console.error('There was a problem with the fetch operation:', error);
      // Handle the error or display a user-friendly message
    });
}

function displayUserInfo(userInfo) {
  const userInformationDiv = document.getElementById('userInformation');
  userInformationDiv.innerHTML = userInfo;
}

// ...

        function storeContestant() {
            const registrationNumber = document.getElementById('registration_number').value;
            const contestingRole = document.getElementById('contesting_role').value;

            // Make an AJAX request to a PHP script with the user's information and contesting role
            fetch('store_contestant.php', {
                method: 'POST',
                body: JSON.stringify({ registrationNumber, contestingRole }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    alert('Contestant stored successfully!');
                } else {
                    alert('Failed to store contestant.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }


        // Function to fetch and display data
function fetchDataAndDisplay() {
  fetch("fetch_data.php")
    .then((response) => response.json())
    .then((data) => {
      // Reference to the table body
      const tableBody = document.getElementById("candidateTableBody");

      // Clear existing table rows
      tableBody.innerHTML = "";

      // Loop through the data and create table rows
      data.forEach((candidate) => {
        const row = document.createElement("tr");

        // Create table cells for registration number, surname, contesting role, and total score
        const regNumberCell = document.createElement("td");
        regNumberCell.textContent = candidate.registration_number;

        const surnameCell = document.createElement("td");
        surnameCell.textContent = candidate.surname;

        const contestingRoleCell = document.createElement("td");
        contestingRoleCell.textContent = candidate.contesting_role;

        const totalScoreCell = document.createElement("td");
        totalScoreCell.textContent = candidate.total_score;

        // Append cells to the row
        row.appendChild(regNumberCell);
        row.appendChild(surnameCell);
        row.appendChild(contestingRoleCell);
        row.appendChild(totalScoreCell);

        // Append the row to the table body
        tableBody.appendChild(row);
      });
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });
}

// Call the fetchDataAndDisplay function to populate the table
fetchDataAndDisplay();




</script>