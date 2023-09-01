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
    html {
    scroll-behavior: smooth;
  }

/* Style buttons */
button {
  background-color: #0864AF;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.3s;
}
button:hover {
  background-color: #F6B418;
}

    .profile-card {
  /* max-width: 30% */
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
      background-color: #0864AF;
      border: none;
      padding: 6px 10px;
      border-radius: 4px;
    }

.map-container {
  width: 100%;
  height: 450px;
  overflow: hidden;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

    .dashboard-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .profile-card {
      width: 100%; /* Adjust width to fit contents */
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
    .profile-position {
      color: #777;
      margin-bottom: 15px;
    }
    .manifesto-card {
      text-align: left;
      width: fit-content;
    }
    .manifesto-title {
      font-size: 1.25rem;
      margin-bottom: 5px;
    }
    .manifesto-content {
      font-size: 0.875rem;
    }
    .content-section {
      display: none; /* Hide content sections by default */
    }
    /* Adjust layout for smaller screens */
@media (max-width: 768px) {
  .dashboard-container {
    padding: 10px;
  }
  .profile-card {
    padding: 10px;
  }
  .profile-card,
  .profile-name,
  .profile-position,
  .manifesto-card {
    text-align: center;
  }
  .dashboard-header {
    padding: 10px;
    font-size: 1.5rem;
  }
  .menu-link {
    font-size: 1rem;
  }
  .profile-icon {
    font-size: 18px;
    width: 30px;
    height: 30px;
    margin-bottom: 5px;
  }
  .chart-section {
    margin: 10px 0;
  }
}

/* Further adjustments for even smaller screens */
@media (max-width: 576px) {
  .dashboard-header {
    font-size: 1.2rem;
  }
  .menu-link {
    font-size: 0.9rem;
  }
  .profile-icon {
    font-size: 16px;
    width: 28px;
    height: 28px;
    margin-bottom: 5px;
  }
  .profile-card,
  .manifesto-card {
    padding: 10px;
  }
  .manifesto-title {
    font-size: 1rem;
    margin-bottom: 5px;
  }
  .manifesto-content {
    font-size: 0.8rem;
  }
}

/* Adjust width of contestant cards for small screens */
@media (max-width: 576px) {
  .profile-card {
    width: 80%;
  }
}

/* Adjust chart dimensions for small screens */
@media (max-width: 576px) {
  .chart-section canvas {
    max-height: 200px;
  }
}

.announcement-card {
    background-color: #f8f9fa;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
  }
  
  .announcement-card:hover {
    transform: scale(1.02);
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
  }
  
  .announcement-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .announcement-title {
    margin: 0;
    font-size: 1.25rem;
  }
  
  .announcement-date {
    color: #777;
  }
  
  .announcement-content {
    color: #555;
    margin-bottom: 15px;
  }
  
  .announcement-footer {
    display: flex;
    justify-content: flex-end;
  }
  
  .announcement-link {
    color: #fff;
    background-color: #0864AF;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s;
  }
  
  .announcement-link:hover {
    background-color: #065694;
  }

  </style>
</head>
<body>

<div class="dashboard-container">
  <div class="dashboard-header">
    <button id="navbar-toggler-icon" type="button" data-toggle="collapse" data-target="#menuCollapse" aria-controls="menuCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">☰</span>
    </button>
    <h1 class="mb-0">Welcome to DEIS</h1>
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
        <a href="#" class="menu-link" onclick="toggleContent('announcements')">
          <i class="fas fa-bullhorn menu-icon"></i>
          Announcements
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
        <a href="#" class="menu-link" onclick="toggleContent('polling')">
          <i class="fas fa-map-marker-alt menu-icon"></i>
          Polling Stations
        </a>
      </li>
      
      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('statistics')">
          <i class="fas fa-chart-bar menu-icon"></i>
          Statistics
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

<!-- Replace the search box with contestant manifesto cards -->


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

  <div class="content-section" id="pollingContent">
    <div class="map-container">
      <iframe src="/webmap/index.html" 
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
 
<div class="content-section" id="announcementsContent">
  <h2>Announcements</h2>
  <div class="row">
    <div class="col-md-6">
      <div class="announcement-card mb-4">
        <div class="announcement-header">
          <h3 class="announcement-title">Announcement 1</h3>
          <span class="announcement-date">Posted on August 25, 2023</span>
        </div>
        <div class="announcement-content">
          This is an important announcement that you can download as a PDF.
        </div>
        <div class="announcement-footer">
          <a href="announcement1.pdf" class="announcement-link" download>Download PDF</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="announcement-card mb-4">
        <div class="announcement-header">
          <h3 class="announcement-title">Announcement 2</h3>
          <span class="announcement-date">Posted on August 24, 2023</span>
        </div>
        <div class="announcement-content">
          This is another important announcement that you can download as a Word document.
        </div>
        <div class="announcement-footer">
          <a href="announcement2.docx" class="announcement-link" download>Download Word</a>
        </div>
      </div>
    </div>
  </div>
  <div class="announcement-card">
    <h3 class="announcement-title">Read-Only Announcement</h3>
    <p class="announcement-content">This announcement is for information purposes only.</p>
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
  
  <div class="content-section" id="logoutContent">
    <!-- Logout content goes here -->
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
  
  <div class="row mt-4">
    <div class="col-md-12 dashboard-content">
      <div class="row">
        <!-- Contestant 1 -->
        <div class="col-md-4">
          <div class="profile-card">
            <div class="profile-icon">JD</div>
            <h2 class="profile-name">John Doe</h2>
            <p class="profile-position">Candidate for President</p>
            <div class="manifesto-card">
              <h3 class="manifesto-title">Manifesto</h3>
              <p class="manifesto-content">
                Committed to improving education and healthcare for all. I believe in creating a brighter future for our community.
              </p>
            </div>
          </div>
        </div>
        <!-- ... (Contestant 2 and 3) ... -->
         <!-- Contestant 2 -->
         <div class="col-md-4">
            <div class="profile-card">
              <div class="profile-icon">AB</div>
              <h2 class="profile-name">Alice Brown</h2>
              <p class="profile-position">Candidate for Vice President</p>
              <div class="manifesto-card">
                <h3 class="manifesto-title">Manifesto</h3>
                <p class="manifesto-content">
                  Advocating for sustainable environmental policies and community engagement. Let's work together for a greener tomorrow.
                </p>
              </div>
            </div>
          </div>
          <!-- Contestant 3 -->
          <div class="col-md-4">
            <div class="profile-card">
              <div class="profile-icon">EF</div>
              <h2 class="profile-name">Eric Foster</h2>
              <p class="profile-position">Candidate for Treasurer</p>
              <div class="manifesto-card">
                <h3 class="manifesto-title">Manifesto</h3>
                <p class="manifesto-content">
                  Dedicated to responsible financial management and transparency. Together, we can ensure a strong financial foundation.
                </p>
              </div>
            </div>
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
