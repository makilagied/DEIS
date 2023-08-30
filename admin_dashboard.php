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
  <!-- Search and role assignment form -->
  <!-- Search and role assignment form -->
<form id="assignRoleForm">
  <label for="searchInput">Search by Username or Regnumber:</label>
  <input type="text" id="searchInput" name="searchInput" required>
  <button type="button" onclick="searchUser();">Search User</button>
</form>

<!-- Display search status -->
<div id="searchResponse">
  <p id="searchStatus"></p>
</div>


<!-- Display user information and role assignment form -->
<div id="searchResults"></div>

<!-- Role assignment form (hidden by default) -->
<form id="roleAssignmentForm" style="display: none;">
  <label for="role_id">Select Role:</label>
  <select id="new_role_id" name="new_role_id">
    <option value="2">Daruso</option>
  </select>
  
  <button type="button" onclick="assignRole()">Assign Role</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    // Hide the role assignment form
    document.getElementById("roleAssignmentForm").style.display = "none";
  }

// Function to handle role assignment
function assignRole() {
  // Gather selected user IDs and the new role ID
  var selectedUsers = [];
  $("input[name='selected_users[]']:checked").each(function() {
    selectedUsers.push($(this).val());
  });

  var newRoleDropdown = document.getElementById("new_role_id");
  var newRoleID = newRoleDropdown ? newRoleDropdown.value : null;

  if (newRoleID !== null) {
    // Perform AJAX request to assign new role
    $.ajax({
      type: "POST",
      url: "backend/assign_role.php", // Modify this to your backend script
      data: {
        selected_users: selectedUsers,
        new_role_id: newRoleID
      },
      success: function(response) {
        // Display response on the dashboard
        document.getElementById("responseContainer").innerHTML = response;
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  } else {
    console.error("New role dropdown not found");
  }
}






function searchUser() {
  var searchInput = document.getElementById("searchInput").value;
  console.log("Search Input:", searchInput);

  $.ajax({
    type: "POST",
    url: "backend/search_user.php",
    data: {
      searchInput: searchInput
    },
    success: function(response) {
      console.log("Search response:", response);

      var searchStatus = document.getElementById("searchStatus");
      var searchResults = document.getElementById("searchResults");
      var roleAssignmentForm = document.getElementById("roleAssignmentForm");

      // Clear previous search results
      searchResults.innerHTML = "";

      // Parse the JSON response
      var userResults = JSON.parse(response);

      if (userResults.length > 0) {
  console.log("Users found");

  var userHtml = "";
  userResults.forEach(function(user) {
    userHtml += `
      <div class="user-entry">
        <p>User Information: ${user.surname} (${user.regnumber})</p>
        <label for="user_${user.id}">
          <input type="checkbox" id="user_${user.id}" name="selected_users[]" value="${user.id}">
          Select this user
        </label>
      </div>
    `;
  });

  searchResults.innerHTML = userHtml;

  searchStatus.textContent = ""; // Clear the status message
  roleAssignmentForm.style.display = "block";
} else {
  console.log("No users found");
  searchStatus.textContent = "No users found";
  roleAssignmentForm.style.display = "none";
}

    },
    error: function(xhr, status, error) {
      console.error("AJAX Error:", error);
    }
  });
}





</script>


</body>
</html>