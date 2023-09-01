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
    #navbar-toggler-icon {
      color: #F6B418;
      background-color: #0864AF;
      border: none;
      padding: 6px 10px;
      border-radius: 4px;
    }
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

  </style>
</head>
<body>

<div class="dashboard-container">
  <div class="dashboard-header">
  <button id="navbar-toggler-icon" type="button" data-toggle="collapse" data-target="#menuCollapse" aria-controls="menuCollapse" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon">☰</span>
</button>
    <h4 class="mb-0">TUME YA UCHAGUZI </h4>
    <div class="user-info">
      <div class="profile-icon">JD</div>
    </div>
  </div>

  <div class="collapse" id="menuCollapse">
    <ul class="menu-list">
      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('profile')">
          <i class="fas fa-user menu-icon"></i>
          Profile
        </a>
      </li>
      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('settings')">
          <i class="fas fa-cog menu-icon"></i>
          Settings
        </a>
      </li>
      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('results')">
          <i class="fas fa-file menu-icon"></i>
          Results
        </a>
      </li>
      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('statistics')">
          <i class="fas fa-chart-bar menu-icon"></i>
          Statistics
        </a>
      </li>
      <li class="menu-item">
          <a href="#" class="menu-link" onclick="toggleContent('assessment')">
             <i class="fas fa-file-alt menu-icon"></i>
             Assessment Forms
           </a>
       </li>
      <li class="menu-item">
         <a href="#" class="menu-link" onclick="toggleContent('nominations')">
         <i class="fas fa-user-check menu-icon"></i>
          Nominations
        </a>
      </li>
      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('voting')">
          <i class="fas fa-vote-yea  menu-icon"></i>
           Voting
        </a>
      </li>
      <li class="menu-item">
    <a href="backend/logout.php" class="menu-link">
        <i class="fas fa-sign-out-alt menu-icon"></i>
        Logout
    </a>
</li>
    </ul>
  </div>
  
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
    <form id="nominationsForm" class='paper-form'>
        <!-- Form fields for candidate information -->
        <div class="form-group">
            <label for="candidateName">Candidate Name:</label>
            <input type="text" class="form-control" id="candidateName" name="candidateName" required>
        </div>
        <div class="form-group">
            <label for="candidateReg">Registration Number</label>
            <input type="text" class="form-control" id="candidateName" name="candidateName" required>
        </div>

        <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>

        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea class="form-control" id="bio" name="bio" rows="4" required></textarea>
        </div>

        <!-- Add more form fields as needed -->

        <!-- Submit Button -->
        <div class="text-center">
            <button type="button" class="btn btn-primary" onclick="submitNomination()">Submit Nomination</button>
        </div>
    </form>
</div>



<!-- Assessment Forms content -->
<div class="content-section" id="assessmentContent">
<div class="container mt-5">
        <h1>DARUSO Assessment Form</h1>
        <form id="assessmentForm">
            <!-- Personal Information -->
            <div class="form-group">
                <label for="aspirantName">Name of Aspirant</label>
                <input type="text" class="form-control" id="aspirantName" name="aspirantName" required>
            </div>
            <div class="form-group">
                <label for="registrationNumber">Registration Number</label>
                <input type="text" class="form-control" id="registrationNumber" name="registrationNumber" required>
            </div>
            <div class="form-group">
                <label for="yearOfStudy">Year of Study</label>
                <input type="text" class="form-control" id="yearOfStudy" name="yearOfStudy" required>
            </div>
            <div class="form-group">
                <label for="programme">Programme</label>
                <input type="text" class="form-control" id="programme" name="programme" required>
            </div>
            <div class="form-group">
                <label for="postContested">Post Contested</label>
                <input type="text" class="form-control" id="postContested" name="postContested" required>
            </div>
            <div class="form-group">
                <label for="hallsBlocks">Halls/Blocks</label>
                <input type="text" class="form-control" id="hallsBlocks" name="hallsBlocks" required>
            </div>

            <!-- Criteria for Assessment -->
            <h2>Criteria for Assessment</h2>
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
                        <td><input type="number" class="form-control" name="score1" required></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Confidence of the Aspirant</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score2" required></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Knowledge about the Existing Students’ Problems</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score3" required></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Knowledge about DARUSO</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score4" required></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Response to the Questions</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score5" required></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Fluency in Both English and Swahili Languages</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score6" required></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Articulation</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score7" required></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Leadership Experience</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score8" required></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Uniqueness and Neatness</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score9" required></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>International and Cross Cutting Issues</td>
                        <td>10</td>
                        <td><input type="number" class="form-control" name="score10" required></td>
                    </tr>
                </tbody>
            </table>

            <!-- Member of General Electoral Committee -->
            <h2>Member of General Electoral Committee</h2>
            <div class="form-group">
                <label for="committeeMemberName">Name</label>
                <input type="text" class="form-control" id="committeeMemberName" name="committeeMemberName" required>
            </div>
            <div class="form-group">
                <label for="committeeMemberSignature">Signature</label>
                <input type="text" class="form-control" id="committeeMemberSignature" name="committeeMemberSignature" required>
            </div>

            <!-- Chairperson General Electoral Committee -->
            <h2>Chairperson General Electoral Committee</h2>
            <div class="form-group">
                <label for="chairpersonName">Name</label>
                <input type="text" class="form-control" id="chairpersonName" name="chairpersonName" required>
            </div>
            <div class="form-group">
                <label for="chairpersonSignature">Signature</label>
                <input type="text" class="form-control" id="chairpersonSignature" name="chairpersonSignature" required>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit Assessment</button>
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


  

function submitAssessment() {
        // Retrieve questionnaire data and send it to the server for processing
        var satisfaction = document.querySelector('input[name="satisfaction"]:checked').value;
        var usability = document.getElementById("usability").value;

        // Send the data to the server for processing
        // You can use JavaScript fetch or AJAX for this purpose

        // Display a success message or handle errors as needed
        // For example:
        alert("Assessment submitted successfully!");
    }

    function submitNomination() {
        // Retrieve form data and send it to the server for database upload
        var candidateName = document.getElementById("candidateName").value;
        var position = document.getElementById("position").value;
        var bio = document.getElementById("bio").value;

        // Send the data to the server for database upload
        // You can use JavaScript fetch or AJAX for this purpose

        // Display a success message or handle errors as needed
        // For example:
        alert("Nomination submitted successfully!");
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
  
</body>
</html>




  