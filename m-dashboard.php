<?php
  session_start();
  include "./assets/include/config.php";
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manager Dashboard | Orphanage Care</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">
  
  <style>
    .custom-navbar { background-color: #2c3e50; }
    .custom-sidebar { background-color: #34495e; }
    .custom-brand { color: #ecf0f1 !important; }
    .custom-card { border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .registration-popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      max-width: 500px;
      width: 100%;
    }
    .registration-popup .close {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
    }
    @media (max-width: 768px) {
      .registration-popup { width: 90%; }
    }
    .table-actions { display: flex; justify-content: space-between; margin-bottom: 1rem; }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark custom-navbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#" id="registerBtn" role="button">
          <i class="fas fa-user-plus"></i> Register Beneficiary
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-cog mr-2"></i> Settings
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
          </a>
        </div>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary custom-sidebar elevation-4">
    <a href="index3.html" class="brand-link custom-brand">
      <img src="./assets/images/logo.png" alt="Orphanage Care Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Orphanage Care</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./assets/images/admin-avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">John Doe</a>
          <span class="badge badge-info">Manager</span>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Beneficiaries</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>Events</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-heart"></i>
              <p>Donations</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-header">IMPORTANT LINKS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Policies</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-phone"></i>
              <p>Emergency Contacts</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manager Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info custom-card">
              <div class="inner">
                <h3>150</h3>
                <p>Active Volunteers</p>
              </div>
              <div class="icon">
                <i class="fas fa-hands-helping"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success custom-card">
              <div class="inner">
                <h3>53</h3>
                <p>New Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning custom-card">
              <div class="inner">
                <h3>$50,000</h3>
                <p>Total Donations</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger custom-card">
              <div class="inner">
                <h3>5</h3>
                <p>Upcoming Events</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Beneficiaries Table -->
        <div class="row">
          <div class="col-12">
            <div class="card custom-card">
              <div class="card-header">
                <h3 class="card-title">Registered Beneficiaries</h3>
              </div>
              <div class="card-body">
                <table id="beneficiariesTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Registered By</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Table body will be populated dynamically -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Registration Popup -->
  <div class="registration-popup" id="registrationPopup">
    <span class="close" id="closePopup">&times;</span>
    <h2>Register New Beneficiary</h2>
    <form id="registrationForm">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="tel" class="form-control" id="phone" name="phone" required>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">Orphanage Care</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
  // Initialize DataTable
  var table = $('#beneficiariesTable').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    ajax: {
      url: 'get_beneficiaries.php',
      dataSrc: ''
    },
    columns: [
      { data: 'id' },
      { data: 'name' },
      { data: 'email' },
      { data: 'password' },
      { data: 'address' },
      { data: 'phone' },
      { data: 'registered_by' },
      {
        data: null,
        render: function(data, type, row) {
          return '<button class="btn btn-sm btn-info edit-btn"><i class="fas fa-edit"></i></button>' +
                 '<button class="btn btn-sm btn-success update-btn"><i class="fas fa-sync-alt"></i></button>' +
                 '<button class="btn btn-sm btn-danger delete-btn"><i class="fas fa-trash"></i></button>';
        }
      }
    ]
  });

  // Registration popup functionality
  $('#registerBtn').click(function() {
      $('#registrationPopup').show();
    });

    $('#closePopup').click(function() {
      $('#registrationPopup').hide();
    });

    // Handle form submission
    $('#registrationForm').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'register_beneficiary.php',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          alert('Beneficiary registered successfully!');
          $('#registrationPopup').hide();
          table.ajax.reload();
        },
        error: function() {
          alert('Error registering beneficiary.');
        }
      });
    });

    // Edit functionality
    $('#beneficiariesTable').on('click', '.edit-btn', function() {
      var data = table.row($(this).parents('tr')).data();
      // Populate form with data
      $('#name').val(data.name);
      $('#email').val(data.email);
      $('#password').val(data.password);
      $('#address').val(data.address);
      $('#phone').val(data.phone);
      $('#registrationPopup').show();
    });

    // Update functionality
    $('#beneficiariesTable').on('click', '.update-btn', function() {
      var data = table.row($(this).parents('tr')).data();
      $.ajax({
        url: 'update_beneficiary.php',
        method: 'POST',
        data: { id: data.id },
        success: function(response) {
          alert('Beneficiary updated successfully!');
          table.ajax.reload();
        },
        error: function() {
          alert('Error updating beneficiary.');
        }
      });
    });

    // Delete functionality
    $('#beneficiariesTable').on('click', '.delete-btn', function() {
      var data = table.row($(this).parents('tr')).data();
      if (confirm('Are you sure you want to delete this beneficiary?')) {
        $.ajax({
          url: 'delete_beneficiary.php',
          method: 'POST',
          data: { id: data.id },
          success: function(response) {
            alert('Beneficiary deleted successfully!');
            table.ajax.reload();
          },
          error: function() {
            alert('Error deleting beneficiary.');
          }
        });
      }
    });

    // Add new column functionality
    $('#addColumnBtn').click(function() {
      var columnName = prompt('Enter new column name:');
      if (columnName) {
        $.ajax({
          url: 'add_column.php',
          method: 'POST',
          data: { columnName: columnName },
          success: function(response) {
            alert('New column added successfully!');
            location.reload(); // Reload page to reflect changes
          },
          error: function() {
            alert('Error adding new column.');
          }
        });
      }
    });
  });
  </script>
</body>
</html>