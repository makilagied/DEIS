
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

</body>
</html>




  