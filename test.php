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
      background-color: #f8f9fa;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      display: flex;
    }
    .dashboard-sidebar {
      background-color: #0864AF;
      color: #fff;
      padding: 15px;
      border-top-left-radius: 10px;
      border-bottom-left-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 20%;
    }
    .menu-list {
      list-style-type: none;
      padding: 0;
    }
    .menu-item {
      margin: 10px 0;
    }
    .menu-link {
      color: #fff;
      text-decoration: none;
    }
    .menu-icon {
      margin-right: 10px;
    }
    .dashboard-content {
      background-color: #ffffff;
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      flex-grow: 1;
    }
    .content-section {
      display: none;
    }
  /* Custom form styles */
  .paper-form {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    margin: 20px 0;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .paper-form label {
    font-weight: bold;
  }

  .paper-form input[type="text"],
  .paper-form input[type="number"],
  .paper-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .paper-form button {
    background-color: #0864AF;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
  }

  .paper-form button:hover {
    background-color: #075299;
  }

  /* Responsive styles */
  @media (max-width: 768px) {
    .paper-form {
      padding: 10px;
    }
  }

  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <div class="dashboard-container">
        <div class="dashboard-sidebar">
          <h4 class="mb-0">TUME YA UCHAGUZI</h4>
          <div class="user-info">
            <div class="profile-icon">JD</div>
          </div>
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
      </div>
    </div>
    <!-- Content -->
    <div class="col-md-9">
      <div class="dashboard-content">
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

        <!-- Settings content goes here -->
        <div class="content-section" id="settingsContent">
          <h2>Settings</h2>
          <form id="settingsForm">
            <label for="backgroundColor">Theme</label>
            <input type="color" id="backgroundColor" name="backgroundColor" value="#f8f9fa"><br><br>
            <button type="button" onclick="applySettings()">Apply</button>
          </form>
        </div>

        <!-- Results content goes here -->
        <div class="content-section" id="resultsContent">
          <!-- Results Bar Chart -->
          <div class="chart-section">
            <h2>Results Bar Chart</h2>
            <div style="max-height: 5cm; overflow: hidden;">
              <canvas id="resultsBarChart" style="max-height: 5cm;"></canvas>
            </div>
          </div>
        </div>

        <!-- Statistics content goes here -->
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

        <!-- Nominations content goes here -->
        <div class="content-section" id="nominationsContent">
          <h2>Nominations</h2>
          <form id="nominationsForm">
            <!-- Form fields for candidate information -->
            <div class="form-group">
              <label for="candidateName">Candidate Name:</label>
              <input type="text" class="form-control" id="candidateName" name="candidateName" required>
            </div>
            <div class="form-group">
              <label for="candidateReg">Registration Number</label>
              <input type="text" class="form-control" id="candidateReg" name="candidateReg" required>
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

        <!-- Assessment Forms content goes here -->
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
                  <!-- Add more criteria rows as needed -->
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
                <label for="chairpersonName">Name</label
                <input type="text" class="form-control" id="chairpersonName" name="chairpersonName" required>
              </div>
              <div class="form-group">
                <label for="chairpersonSignature">Signature</label>
                <input type="text" class="form-control" id="chairpersonSignature" name="chairpersonSignature" required>
              </div>
              <!-- Submit Button -->
              <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="submitAssessmentForm()">Submit Assessment Form</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Voting content goes here -->
        <div class="content-section" id="votingContent">
          <h2>Voting</h2>
          <p>Voting functionality can be added here.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleContent(contentId) {
    // Hide all content sections
    const contentSections = document.getElementsByClassName("content-section");
    for (let i = 0; i < contentSections.length; i++) {
      contentSections[i].style.display = "none";
    }

    // Show the selected content section
    document.getElementById(contentId + "Content").style.display = "block";
  }

  // JavaScript functions for form submission or other actions can be added here

</script>

</body>
</html>
