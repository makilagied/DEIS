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
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Include Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Include your custom CSS -->
  <!-- <link rel="stylesheet" href="styles.css"> -->
  <style>
    /* Custom styles */
body {
  background-color: #f8f9fa;
  font-family: Arial, sans-serif;
}
.user-entry {
  margin-bottom: 10px;
}

.dashboard-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
/* ... (Rest of the CSS from your provided code) ... */
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
      /* background-color: #0864AF; */
      border: none;
      padding: 6px 10px;
      border-radius: 4px;
    }
    .search-box {
      max-width: 30%;
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
  </style>
</head>
<body>

<div class="dashboard-container">
  <div class="dashboard-header">
    <h4 class="mb-0 text-center">APPEALS COMMISSION</h4>
    <div class="user-info">
      <div class="profile-icon">JD</div>
    </div>
  </div>
<!-- Modify your navigation menu with Bootstrap classes -->
<!-- Modify your navigation menu with custom icons for the "Appeals" dropdown -->
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

      <!-- Appeals Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="appealsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-gavel menu-icon"></i>
          Appeals
        </a>
        <div class="dropdown-menu" aria-labelledby="appealsDropdown">
          <a class="dropdown-item" href="#" onclick="toggleContent('appealsReceived')">
            <i class="fas fa-inbox menu-icon"></i>
            Appeals Received
          </a>
          <a class="dropdown-item" href="#" onclick="toggleContent('appealsOnProcess')">
            <i class="fas fa-cogs menu-icon"></i>
            Appeals on Process
          </a>
          <a class="dropdown-item" href="#" onclick="toggleContent('appealsCompleted')">
            <i class="fas fa-check-circle menu-icon"></i>
            Appeals Completed
          </a>
        </div>
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
<div id="profile" class="content-section">
  <!-- Profile content here -->
  <div class="profile-card">
      <div class="profile-icon">JD</div>
      <h2 class="profile-name">John Doe</h2>
      <p class="profile-title">Software Engineer</p>
      <p class="profile-description">Passionate about coding and creating innovative solutions.</p>
    </div>
</div>

<div id="results" class="content-section">
  <!-- Results content here -->
   <!-- Results Bar Chart -->
   <div class="chart-section">
      <h2>Results Bar Chart</h2>
      <div style="max-height: 5cm; overflow: hidden;">
        <canvas id="resultsBarChart" style="max-height: 5cm;"></canvas>
      </div>
    </div>
</div>

<div id="statistics" class="content-section">
  <!-- Statistics content here -->
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

<div id="appealsReceived" class="content-section">
  <h3>Appeals Received</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Registration Number</th>
        <th>Name</th>
        <th>Post Contesting</th>
        <th>Reason for Appealing</th>
      </tr>
    </thead>
    <tbody>
      <!-- Populate this section with data for appeals received -->
      <tr>
        <td>2023-01-001</td>
        <td>John Doe</td>
        <td>President</td>
        <td>Disputed vote count</td>
      </tr>
      <!-- Add more rows as needed -->
    </tbody>
  </table>
</div>

<div id="appealsOnProcess" class="content-section">
  <h3>Appeals on Process</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Registration Number</th>
        <th>Name</th>
        <th>Post Contesting</th>
        <th>Reason for Appealing</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <!-- Populate this section with data for appeals on process -->
      <tr>
        <td>2023-01-002</td>
        <td>Jane Smith</td>
        <td>Vice President</td>
        <td>Alleged misconduct</td>
        <td>In progress</td>
      </tr>
      <!-- Add more rows as needed -->
    </tbody>
  </table>
</div>


<div id="appealsCompleted" class="content-section">
  <h3>Appeals Completed</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Registration Number</th>
        <th>Name</th>
        <th>Post Contesting</th>
        <th>Reason for Appealing</th>
        <th>Judgment</th>
      </tr>
    </thead>
    <tbody>
      <!-- Populate this section with data for appeals completed -->
      <tr>
        <td>2023-01-003</td>
        <td>Emily Johnson</td>
        <td>Treasurer</td>
        <td>Irregularities in voting process</td>
        <td>Appeal granted</td>
      </tr>
      <!-- Add more rows as needed -->
    </tbody>
  </table>
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
  // JavaScript functions for toggling content
  function toggleContent(contentId) {
    // Hide all content sections
    const contentSections = document.querySelectorAll('.content-section');
    contentSections.forEach((section) => {
      section.style.display = 'none';
    });

    // Show the selected content section
    const selectedContent = document.getElementById(contentId);
    if (selectedContent) {
      selectedContent.style.display = 'block';
    }
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
  </script>


</body>
</html>