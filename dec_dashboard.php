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
  <style>
    /* Custom styles */
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      padding-top:10px;
    }

    body::before {
  content: "";
  background-image: url('img/udsm.jpg'); /* Replace with your image URL */
  filter: blur(1px); /* Adjust the blur radius as needed */
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1; /* Place it behind the content */
  background-repeat: no-repeat;
  background-size: cover;
}

    @media (max-width: 768px) {
      .menu-list {
        display: block; /* Change to block display for mobile */
      }
      .menu-item {
        margin: 10px 0;
      }
    }
    .dashboard-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
   /* Profile card */
.profile-card {
  /* max-width: 30%; */
  margin: 0 auto;
  padding: 20px;
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.profile-icon {
  font-size: 24px;
  width: 40px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #F6B418;
  color: #fff;
  border-radius: 50%;
  margin: 0 auto;
  margin-bottom: 10px;
}

.profile-name {
  font-size: 1.5rem;
  margin-bottom: 5px;
}

.profile-title {
  color: #777;
  margin-bottom: 15px;
}

.profile-description {
  font-size: 0.875rem;
}

    .dashboard-content {
      margin-bottom: 20px;
    }
    .dashboard-header {
      background-color: #0864AF;
      color: #fff;
      padding: 15px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .menu-list {
      list-style-type: none;
      padding: 0;
    }
    .menu-item {
      margin: 10px 0;
    }
      /* Disable underlining on hover for all links */
a:hover {
    text-decoration: none;
    /* background-color:#0864AF; */
    color:black;
}

    .menu-link {
      color: #0864AF;
      text-decoration: none;
      cursor: pointer; /* Add cursor style */
    }
    .menu-icon {
      margin-right: 10px;
      color: #0864AF;
    }
    /* #navbar-toggler-icon {
      color: #F6B418;
      background-color: #0864AF;
      border: none;
      padding: 6px 10px;
      border-radius: 4px;
    } */
    .search-box {
      max-width: 40%;
      margin: 0 auto;
      text-align: center;
    }
    .search-input {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #0864AF;
      border-radius: 4px;
    }
    .search-button {
      background-color: #0864AF;
      color: #fff;
      border: none;
      padding: 10px 15px;
      border-radius: 4px;
      cursor: pointer;
    }
    .message-box {
      text-align: center;
      margin-top: 20px;
    }
    .content-section {
      display: none; /* Hide content sections by default */
    }
    .form-section {
            display: none;
  }
  .form-heading {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }



   /* Custom CSS styles */
   .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        h2 {
          text-align: center;
            font-size: 18px;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .table {
            margin-top: 20px;
        }

        /* Additional CSS for form elements */
        input[type="number"] {
            width: 70px;
        }

        /* Responsive table */
        @media (max-width: 576px) {
            .table {
                overflow-x: auto;
            }
        }
/* Sticky navigation bar */
.navbar {
  position: sticky;
  top: 0;
  z-index: 100;
}

  </style>
</head>
<body>

<div class="dashboard-container">
  <div class="dashboard-header">
    <h1 class="mb-0 text-center">TUME YA UCHAGUZI </h1>
    <div class="user-info">
      <div class="profile-icon">JD</div>
    </div>
  </div>


    <!-- Modify your navigation menu with Bootstrap classes -->
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

      <!-- Settings -->
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="toggleContent('settings')">
          <i class="fas fa-cog menu-icon"></i>
          Settings
        </a>
      </li>

      <!-- Results -->
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="toggleContent('results')">
          <i class="fas fa-file menu-icon"></i>
          Results
        </a>
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
  <a href="#" onclick="toggleContent('nominations')">Nominations</a>
  <a href="#" onclick="toggleContent('nominationResults')">Nomination Results</a>
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

  <!-- Profile content goes here -->
  <div class="content-section" id="profileContent">
    <div class="profile-card">
      <div class="profile-icon">JD</div>
      <h2 class="profile-name">John Doe</h2>
      <p class="profile-title">Software Engineer</p>
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


 <!-- Nominations content -->
 <div class="content-section" id="nominationsContent">
    <h2>Nominations</h2>
    <div class="container">
    <form id="nominationsForm" class="paper-form">
        <!-- Form fields for candidate information -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="candidateName">Candidate Name:</label>
                <input type="text" class="form-control" id="candidateName" name="candidateName" required>
            </div>
            <div class="form-group col-md-6">
                <label for="position">Position:</label>
                <select class="form-control" id="position" name="position" required>
                    <option value="">Select Position</option>
                    <option value="President">President</option>
                    <option value="Vice President">Vice President</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="candidateReg">Registration Number</label>
                <input type="text" class="form-control" id="candidateReg" name="candidateReg" required>
            </div>
        </div>

        <!-- Add more form fields as needed -->

        <!-- Submit Button -->
        <div class="text-center">
            <button type="button" class="btn btn-primary" onclick="submitNomination()">Submit Nomination</button>
        </div>
    </form>

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
              <option value="Secretary">Secretary</option>
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
        <select class="form-control" id="postDropdown" required>
          <option value="">Select Post</option>
          <!-- Use PHP to populate this dropdown with posts from your database -->
          <?php
            // Your PHP code to fetch and populate the posts here
            $posts = ['President', 'Vice President', 'Secretary', 'Treasurer']; // Replace this with your actual data
            foreach ($posts as $post) {
              echo "<option value='$post'>$post</option>";
            }
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
          <input type="text" class="form-control" id="committeeMemberSignature" name="committeeMemberSignature" required>
        </div>
        <!-- Submit Button -->
        <div class="text-center">
          <button type="button" class="btn btn-primary" onclick="submitAssessment()">Submit Assessment</button>
        </div>
      </div>
    </form>
  </div>
</div>






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
  
</div>
</div>
  </div>
</div>
<!-- Include Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!-- Include Bootstrap JS and any additional scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
        function submitNomination() {
            // Get the form data
            const candidateName = document.getElementById("candidateName").value;
            const position = document.getElementById("position").value;
            const candidateReg = document.getElementById("candidateReg").value;

            // Create a JavaScript object with the data
            const nominationData = {
                candidateName,
                position,
                candidateReg
            };

            // Send the data to a PHP script using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "insert_nomination.php", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from the server (e.g., show a success message)
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert("Nomination submitted successfully!");
                        // You can also reset the form if needed
                        document.getElementById("nominationsForm").reset();
                    } else {
                        alert("Error submitting nomination: " + response.error);
                    }
                }
            };

            // Send the nomination data as JSON to the PHP script
            xhr.send(JSON.stringify(nominationData));
        }
    </script>



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



</script>

<script>
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


</script>

<script>
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
          labels: ['Subject 1', 'Subject 2', 'Subject 3', 'Subject 4'],
          datasets: [{
            label: 'Results',
            data: [85, 70, 95, 60], // Sample data
            backgroundColor: '#0864AF',
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
          labels: ['Category 1', 'Category 2', 'Category 3'],
          datasets: [{
            label: 'Bar Chart Data',
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
          labels: ['Label 1', 'Label 2', 'Label 3'],
          datasets: [{
            label: 'Pie Chart Data',
            data: generateRandomData(3),
            backgroundColor: ['#0864AF', '#F6B418', '#6BBE45'],
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
          labels: ['Range 1', 'Range 2', 'Range 3'],
          datasets: [{
            label: 'Histogram Data',
            data: generateRandomData(3),
            backgroundColor: '#0864AF',
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
  </script>

  
<script>
  // JavaScript to populate candidate dropdown based on selected post
  const postDropdown = document.getElementById('postDropdown');
  const candidateDropdown = document.getElementById('candidateDropdown');
  const showCriteriaButton = document.getElementById('showCriteriaButton');

  // Replace this with actual data from your database
  const candidatesByPost = {
    'President': ['Candidate 1', 'Candidate 2', 'Candidate 3'],
    'Vice President': ['Candidate A', 'Candidate B'],
    'Secretary': ['Candidate X', 'Candidate Y'],
    'Treasurer': ['Candidate P', 'Candidate Q', 'Candidate R'],
  };

  postDropdown.addEventListener('change', () => {
    const selectedPost = postDropdown.value;
    candidateDropdown.innerHTML = '<option value="">Select Candidate</option>';
    if (selectedPost && candidatesByPost[selectedPost]) {
      candidatesByPost[selectedPost].forEach(candidate => {
        const option = document.createElement('option');
        option.value = candidate;
        option.textContent = candidate;
        candidateDropdown.appendChild(option);
      });
      candidateDropdown.disabled = false;
    } else {
      candidateDropdown.disabled = true;
    }
  });

  function showCriteriaSection() {
    const selectedCandidate = candidateDropdown.value;
    if (selectedCandidate) {
      document.getElementById('criteriaSection').style.display = 'block';
    } else {
      alert('Please select a candidate first.');
    }
  }

  function submitAssessment() {
    // Handle form submission here
    // You can access all form fields using document.getElementById() or other DOM methods
    alert('Assessment submitted successfully!');
    // Add your logic to submit data to the server using AJAX or form submission
  }


  // Function to show the nomination table based on user selection
function showNominationTable(tableType) {
  // Hide all content sections
  var contentSections = document.querySelectorAll('.content-section');
  contentSections.forEach(function (section) {
    section.style.display = 'none';
  });

  // Show the selected content section
  var selectedContent = document.getElementById('nominationsContent');
  selectedContent.style.display = 'block';

  // Depending on the user's choice, you can customize what to display here.
  // For example, if tableType is 'form', display the nomination form;
  // if tableType is 'results', display the nomination results.
  if (tableType === 'form') {
    // Show the nomination form (modify this part as needed)
    document.getElementById('nominationsForm').style.display = 'block';
  } else if (tableType === 'results') {
    // Show the nomination results table (modify this part as needed)
    document.getElementById('candidateTableContainer').style.display = 'block';
    filterCandidates(); // Populate the table with data, you may need to call your filter function here
  }
}



// Sample data for nominated candidates (you can replace this with your own data)
const nominatedCandidates = [
  { candidateName: 'John Doe', position: 'President', score: 95 },
  { candidateName: 'Jane Smith', position: 'Vice President', score: 88 },
  { candidateName: 'Alice Johnson', position: 'Secretary', score: 91 },
  // Add more candidate data as needed
];

// Function to submit a nomination
function submitNomination() {
  // Get the form values
  const candidateName = document.getElementById('candidateName').value;
  const position = document.getElementById('position').value;
  const candidateReg = document.getElementById('candidateReg').value;

  // Validation (you can add more validation as needed)
  if (!candidateName || !position || !candidateReg) {
    alert('Please fill in all fields.');
    return;
  }

  // Create a new candidate object
  const newCandidate = { candidateName, position, score: 0 }; // Initial score is set to 0

  // Add the new candidate to the nominatedCandidates array
  nominatedCandidates.push(newCandidate);

  // Clear the form fields
  document.getElementById('candidateName').value = '';
  document.getElementById('position').value = '';
  document.getElementById('candidateReg').value = '';

  // Optional: You can update the candidate table here
  updateCandidateTable();
}

// Function to filter and display candidates based on user selection
function filterCandidates() {
  // Get the selected position filter value
  const positionFilter = document.getElementById('positionFilter').value;

  // Filter candidates based on the selected position or display all candidates
  const filteredCandidates = positionFilter === 'all'
    ? nominatedCandidates
    : nominatedCandidates.filter(candidate => candidate.position === positionFilter);

  // Update the candidate table with the filtered data
  updateCandidateTable(filteredCandidates);
}

// Function to update the candidate table with data
function updateCandidateTable(candidates = nominatedCandidates) {
  const tableBody = document.getElementById('candidateTableBody');

  // Clear the table body
  tableBody.innerHTML = '';

  // Populate the table with candidate data
  candidates.forEach(candidate => {
    const row = tableBody.insertRow();
    const nameCell = row.insertCell(0);
    const positionCell = row.insertCell(1);
    const scoreCell = row.insertCell(2);

    nameCell.textContent = candidate.candidateName;
    positionCell.textContent = candidate.position;
    scoreCell.textContent = candidate.score;
  });
}

// Initial table population (on page load)
updateCandidateTable();

// Optional: You can add an event listener to the "Apply Filters" button
// to trigger the filterCandidates function when the button is clicked
// Example:
// document.getElementById('applyFiltersButton').addEventListener('click', filterCandidates);


</script>


<script>
  function filterCandidates() {
    // Get selected filter criteria
    const positionFilter = document.getElementById("positionFilter").value;

    // Fetch candidate data based on the selected filter (You should implement this logic)
    // Replace the following sample data retrieval with your actual database query
    // Sample data for demonstration purposes
    const candidatesData = [
      ['Candidate 1', 'President', 85],
      ['Candidate A', 'Vice President', 78],
      ['Candidate B', 'Vice President', 92],
      ['Candidate X', 'Secretary', 88],
      // ... Add more data here ...
    ];

    // Filter candidates based on selected criteria
    const filteredCandidates = positionFilter === "all"
      ? candidatesData
      : candidatesData.filter(candidate => candidate[1] === positionFilter);

    // Populate the table with filtered data
    const candidateTableBody = document.getElementById("candidateTableBody");
    candidateTableBody.innerHTML = "";

    filteredCandidates.forEach(data => {
      const row = document.createElement("tr");
      const nameCell = document.createElement("td");
      nameCell.textContent = data[0];
      const positionCell = document.createElement("td");
      positionCell.textContent = data[1];
      const scoreCell = document.createElement("td");
      scoreCell.textContent = data[2];

      row.appendChild(nameCell);
      row.appendChild(positionCell);
      row.appendChild(scoreCell);
      candidateTableBody.appendChild(row);
    });
  }

  // Initially populate the table with all candidates
  filterCandidates();
</script><script>
  function filterCandidates() {
    // Get selected filter criteria
    const positionFilter = document.getElementById("positionFilter").value;

    // Fetch candidate data based on the selected filter (You should implement this logic)
    // Replace the following sample data retrieval with your actual database query
    // Sample data for demonstration purposes
    const candidatesData = [
      ['Candidate 1', 'President', 85],
      ['Candidate A', 'Vice President', 78],
      ['Candidate B', 'Vice President', 92],
      ['Candidate X', 'Secretary', 88],
      // ... Add more data here ...
    ];

    // Filter candidates based on selected criteria
    const filteredCandidates = positionFilter === "all"
      ? candidatesData
      : candidatesData.filter(candidate => candidate[1] === positionFilter);

    // Populate the table with filtered data
    const candidateTableBody = document.getElementById("candidateTableBody");
    candidateTableBody.innerHTML = "";

    filteredCandidates.forEach(data => {
      const row = document.createElement("tr");
      const nameCell = document.createElement("td");
      nameCell.textContent = data[0];
      const positionCell = document.createElement("td");
      positionCell.textContent = data[1];
      const scoreCell = document.createElement("td");
      scoreCell.textContent = data[2];

      row.appendChild(nameCell);
      row.appendChild(positionCell);
      row.appendChild(scoreCell);
      candidateTableBody.appendChild(row);
    });
  }

  // Initially populate the table with all candidates
  filterCandidates();
</script>
