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
   <script src="js/main.js"></script>
   <!-- external css -->
  <link rel="stylesheet" href="css/main.css">
</head>
<body>

<div class="dashboard-container">
  <div class="dashboard-header">
    <h1 class="mb-0 text-center">TUME YA UCHAGUZI </h1>
    <div class="user-info">
      <div class="profile-icon">JD</div>
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
    <a href="#" class="nav-link" onclick="toggleContent(' ')">
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


 <!-- Nominations content -->
 <div class="content-section" id="nominationsContent">
    <h2>Nominations</h2>
    <div class="container">
    <form id="nominationsForm" class="paper-form">
    <!-- Form fields for candidate information -->
    <div class="form-row">
    <div class="form-group col-md-6">
            <label for="candidateReg">Registration Number</label>
            <input type="text" class="form-control" id="candidateReg" name="candidateReg" required>
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
            $posts = ['President', 'Vice President', 'Hostel/Hall', 'USRC']; // Replace this with your actual data
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
