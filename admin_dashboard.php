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
  <title>Admin Panel</title>
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
      background-color: #0864AF;
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
    <button id="navbar-toggler-icon" type="button" data-toggle="collapse" data-target="#menuCollapse" aria-controls="menuCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">☰</span>
    </button>
    <h1 class="mb-0">Welcome to Admin Panel</h1>
    <div class="user-info">
      <div class="profile-icon">JD</div>
    </div>
  </div>

  <div class="collapse" id="menuCollapse">
    <ul class="menu-list">
      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('assignRole')">
          <i class="fas fa-user-shield menu-icon"></i>
          Assign Role
        </a>
      </li>
      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('editUser')">
          <i class="fas fa-user-edit menu-icon"></i>
          Edit User
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

  <!-- Assign Role content goes here -->
  <div class="content-section" id="assignRoleContent">
    <h2>Assign Role</h2>
    <!-- Form to assign roles -->
    <form id="assignRoleForm" action="backend/assign_role.php" method="post">
      <label for="user_id">Select User:</label>
      <select id="user_id" name="user_id">
        <option value="1">User 1</option>
        <option value="2">User 2</option>
        <!-- Add more user options here -->
      </select>
      <label for="role_id">Select Role:</label>
      <select id="role_id" name="role_id">
        <option value="1">Admin</option>
        <option value="2">User</option>
      </select>
      <button type="submit">Assign Role</button>
    </form>
  </div>

  <!-- Edit User content goes here -->
  <div class="content-section" id="editUserContent">
    <h2>Edit User Information</h2>
    <!-- Form to edit user information -->
    <form id="editUserForm" action="backend/edit_user.php" method="post">
      <label for="user_id">Select User:</label>
      <select id="user_id" name="user_id">
        <option value="1">User 1</option>
        <option value="2">User 2</option>
        <!-- Add more user options here -->
      </select>
      <label for="new_name">New Name:</label>
      <input type="text" id="new_name" name="new_name">
      <label for="new_email">New Email:</label>
      <input type="email" id="new_email" name="new_email">
      <button type="submit">Save Changes</button>
    </form>
  </div>

</div>

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
</body>
</html>
