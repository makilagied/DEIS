
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

      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('announcements')">
          <i class="fas fa-bullhorn menu-icon"></i>
          Announcements
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

      <li class="menu-item">
        <a href="#" class="menu-link" onclick="toggleContent('polling')">
          <i class="fas fa-map-marker-alt menu-icon"></i>
          Polling Stations
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
  <div id="responseContainer"></div>
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


