<?php
  session_start();
  $type = $_SESSION['type']; 
  $name = $_SESSION['name']; 
  $id = $_SESSION['id']; 

  include "../../assets/include/config.php";
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
 

  function getimg(){
    include "../../assets/include/config.php";
    $id = $_SESSION['id']; 
    $sql = "SELECT picture FROM _PDAdmin WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['picture'];
  } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | Orphanage Care</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  
  <style>
    .custom-navbar { background-color: #2c3e50; }
    .custom-sidebar { background-color: #34495e; }
    .custom-brand { color: #ecf0f1 !important; }
    .custom-card { border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: all 0.3s ease; }
    .custom-card:hover { transform: translateY(-5px); box-shadow: 0 6px 12px rgba(0,0,0,0.15); }
    
    .registration-popup, .view-popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
      background-color: white;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      max-width: 600px;
      width: 90%;
      max-height: 90vh;
      overflow-y: auto;
    }
    
    .registration-popup .close, .view-popup .close {
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 24px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .registration-popup .close:hover, .view-popup .close:hover { transform: rotate(90deg); }
    
    .step-indicators {
      display: flex;
      justify-content: center;
      margin-bottom: 30px;
    }
    
    .step {
      height: 15px;
      width: 15px;
      margin: 0 5px;
      background-color: #bbbbbb;
      border: none;
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
      transition: all 0.3s ease;
    }
    
    .step.active {
      opacity: 1;
      background-color: #007bff;
      transform: scale(1.2);
    }
    
    .form-navigation {
      margin-top: 30px;
      display: flex;
      justify-content: space-between;
    }
    
    .form-navigation button {
      transition: all 0.3s ease;
    }
    
    .form-navigation button:hover { transform: translateY(-2px); }
    
    @media (max-width: 768px) {
      .registration-popup {
        width: 95%;
        padding: 20px;
      }
    }
    
    .table-actions { display: flex; justify-content: space-between; margin-bottom: 1rem; }
    
    .success-animation {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1001;
      font-size: 100px;
      color: #28a745;
      opacity: 0;
      transform: scale(0);
      animation: icon-appear 0.6s ease-in-out forwards, pulse-effect 1.5s ease-in-out 0.6s infinite;
    }

    @keyframes icon-appear {
      0% {
        opacity: 0;
        transform: scale(0);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes pulse-effect {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.1);
      }
    }
    
    @media (max-width: 768px) {
      .beneficiary-table th:nth-child(n+4),
      .beneficiary-table td:nth-child(n+4) {
        display: none;
      }
    
      @media (max-width: 768px) {
  .beneficiary-table th:nth-child(n+4),
  .beneficiary-table td:nth-child(n+4) {
    display: none;
  }

  .expandable-row {
    display: none;
  }

  .expandable-row td {
    padding: 10px;
  }

  .show-more-btn {
    display: inline-block;
    margin-left: 10px;
    background: #007bff;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
  }
}
    }

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
          <a href="#" class="dropdown-item" id="profileBtn">
            <i class="fas fa-user mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" id="signOutBtn">
            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
          </a>
        </div>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary custom-sidebar elevation-4">
    <a href="index3.html" class="brand-link custom-brand">
      <img src="./images/logo.png" alt="Orphanage Care Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Orphanage Care</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./images/<?php echo getimg() ; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $name; ?></a>
          <span class="badge badge-info"><?php echo $type; ?></span>
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
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info custom-card animate__animated animate__fadeIn">
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
            <div class="small-box bg-success custom-card animate__animated animate__fadeIn animate__delay-1s">
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
            <div class="small-box bg-warning custom-card animate__animated animate__fadeIn animate__delay-2s">
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
            <div class="small-box bg-danger custom-card animate__animated animate__fadeIn animate__delay-3s">
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
    <div class="card custom-card animate__animated animate__fadeInUp">
      <div class="card-header">
        <h3 class="card-title">Registered Beneficiaries</h3>
      </div>
      <div class="table-responsive">
  <table id="beneficiariesTable" class="table table-bordered table-striped beneficiary-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>LGA</th>
        <th class="d-none d-md-table-cell">Gender</th>
        <th class="d-none d-md-table-cell">Benefit Type</th>
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

  <!-- Multi-step Registration Popup -->
  <div class="registration-popup animate__animated animate__fadeIn" id="registrationPopup">
    <span class="close" id="closePopup">&times;</span>
    <h2 class="text-center mb-4">Register New Beneficiary</h2>
    <form id="beneficiaryForm" action="register_beneficiary.php" method="post" enctype="multipart/form-data">
    <div class="step-indicators">
        <span class="step active"></span>
        <span class="step"></span>
        <span class="step"></span>
      </div>

      <!-- Step 1 -->
      <div class="step-content" id="step1">
        <h3 class="text-center mb-4">Basic Information</h3>
        <div class="form-group">
          <label for="fullName">Full Name of Late</label>
          <input type="text" class="form-control" id="fullName" name="fullName" required>
        </div>
        <div class="form-group">
          <label for="yod">Year of Death</label>
          <input type="date" class="form-control" id="yod" name="yod" required>
        </div>
        <div class="form-group">
          <label for="fullNameB">Full Name of Beneficiary</label>
          <input type="text" class="form-control" id="fullNameB" name="fullNameB" required>
        </div>
        <div class="form-group">
          <label for="dob">Date of Birth</label>
          <input type="date" class="form-control" id="dob" name="dob" required>
        </div>
        <div class="form-group">
          <label for="gender">Gender</label>
          <select class="form-control" id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step-content" id="step2" style="display:none;">
        <h3 class="text-center mb-4">Contact Information</h3>
        <div class="form-group">
          <label for="lga">State</label>
          <select class="form-control" id="lga" name="lga" required>
            <option value="">Select State</option>
            <!-- Add LGA options here -->
          </select>
        </div>
        <div class="form-group">
          <label for="ward">Local Government Area (LGA)</label>
          <select class="form-control" id="ward" name="ward" required>
            <option value="">Select LGA</option>
          </select>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step-content" id="step3" style="display:none;">
        <h3 class="text-center mb-4">Additional Details</h3>
        <div class="form-group">
          <label for="idNumber">ID Number</label>
          <input type="text" class="form-control" id="idNumber" name="idNumber" required>
        </div>
        <div class="form-group">
          <label for="benefitType">Benefit Type</label>
          <select class="form-control" id="benefitType" name="benefitType" required>
            <option value="">Select Benefit Type</option>
            <option value="financial">Financial Aid</option>
            <option value="medical">Medical Assistance</option>
            <option value="education">Education Support</option>
            <option value="housing">Housing Assistance</option>
          </select>
        </div>
        <div class="form-group">
          <label for="photo">Photo</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="photo" name="photo" accept="image/*" required>
            <label class="custom-file-label" for="photo">Choose file</label>
          </div>
          <img id="imagePreview" src="#" alt="Image Preview" style="display:none; max-width: 100%; margin-top: 10px;">
        </div>
      </div>

      <div class="form-navigation">
        <button type="button" class="btn btn-secondary" id="prevBtn" style="display:none;">Previous</button>
        <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
        <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">Submit</button>
      </div>
    </form>
  </div>

  <!-- View Beneficiary Popup -->
  <div class="view-popup animate__animated animate__fadeIn" id="viewPopup">
    <span class="close" id="closeViewPopup">&times;</span>
    <h2 class="text-center mb-4">Beneficiary Details</h2>
    <div id="beneficiaryDetails"></div>
  </div>

  <!-- Success Animation -->
<div class="success-animation">
  <i class="fas fa-check-circle animate__animated animate__bounceIn" id="success-icon"></i>
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
  var table = $('#beneficiariesTable').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    ajax: {
      url: 'get_beneficiaries.php',
      dataSrc: ''
    },
    columns: [
    { data: 'id' },
    { data: 'full_name_b' },
    { data: 'lga' },
    { data: 'gender', className: 'd-none d-md-table-cell' },
    { data: 'benefit_type', className: 'd-none d-md-table-cell' },
    {
      data: null,
      render: function(data, type, row) {
        var actions = '<button class="btn btn-sm btn-info view-btn"><i class="fas fa-eye"></i> View</button>' +
                      '<button class="btn btn-sm btn-success update-btn"><i class="fas fa-sync-alt"></i> Update</button>' +
                      '<button class="btn btn-sm btn-danger delete-btn"><i class="fas fa-trash"></i> Delete</button>';
        
        if ($(window).width() <= 768) {
          actions += '<span class="show-more-btn">Show More</span>';
        }
        
        return actions;
      }
    }
  ],
  responsive: true,
  rowCallback: function(row, data, index) {
    // Create the expandable row
    var expandableRow = '<tr class="expandable-row" style="display:none;">' +
      '<td colspan="6">' +
      '<p><strong>Full Name of Late:</strong> ' + data.full_name + '</p>' +
      '<p><strong>Year of Death:</strong> ' + data.yod + '</p>' +
      '<p><strong>Date of Birth:</strong> ' + data.dob + '</p>' +
      '<p><strong>Gender:</strong> ' + data.gender + '</p>' +
      '<p><strong>LGA:</strong> ' + data.lga + '</p>' +
      '<p><strong>Ward:</strong> ' + data.ward + '</p>' +
      '<p><strong>Address:</strong> ' + data.address + '</p>' +
      '<p><strong>OP Number:</strong> ' + data.op_number + '</p>' +
      '<p><strong>Phone:</strong> ' + data.phone + '</p>' +
      '<p><strong>Email:</strong> ' + data.email + '</p>' +
      '<p><strong>ID Number:</strong> ' + data.id_number + '</p>' +
      '<p><strong>Benefit Type:</strong> ' + data.benefit_type + '</p>' +
      '<p><strong>Registered By:</strong> ' + data.reg_by + '</p>' +
      '<img src="uploads/' + data.photo + '" alt="Beneficiary Photo" style="max-width: 200px;">' +
      '</td>' +
      '</tr>';

    $(row).after(expandableRow);


   // Add the "Show More" button
   $(row).find('td:last').append('<div class="show-more-btn d-md-none">Show More <i class="fas fa-chevron-down"></i></div>');
  }
  });

  // Toggle expandable row
$('#beneficiariesTable').on('click', '.show-more-btn', function() {
  var $this = $(this);
  var $row = $this.closest('tr');
  var $expandableRow = $row.next('.expandable-row');

  $expandableRow.toggle();

  if ($expandableRow.is(':visible')) {
    $this.html('Hide');
  } else {
    $this.html('Show More');
  }
});

  // List of Nigerian states and their wards (simplified example)
  const nigeriaData = {
  "Abia": ["Aba North", "Aba South", "Arochukwu", "Bende", "Ikwuano", "Isiala Ngwa North", "Isiala Ngwa South", "Isuikwuato", "Obi Ngwa", "Ohafia", "Osisioma", "Ugwunagbo", "Ukwa East", "Ukwa West", "Umu Nneochi", "Umuahia North", "Umuahia South"],
  "Adamawa": ["Demsa", "Fufore", "Ganye", "Girei", "Gombi", "Guyuk", "Hong", "Jada", "Lamurde", "Madagali", "Maiha", "Mayo-Belwa", "Michika", "Mubi North", "Mubi South", "Numan", "Shelleng", "Song", "Toungo", "Yola North", "Yola South"],
  "Akwa Ibom": ["Abak", "Eket", "Esit Eket", "Essien Udim", "Etim Ekpo", "Etinan", "Ibesikpo Asutan", "Ibiono Ibom", "Ika", "Ikot Abasi", "Ikot Ekpene", "Ikot Ekpene", "Ini", "Nsit Atai", "Nsit Ibom", "Nsit Ubium", "Obot Akara", "Okobo", "Onna", "Oruk Anam", "Oron", "Udung Uko", "Uruan", "Urue-Offong/Oruko", "Uyo"],
  "Anambra": ["Aguata", "Anambra East", "Anambra West", "Anaocha", "Awka North", "Awka South", "Ayamelum", "Dunukofia", "Ekwusigo", "Idemili North", "Idemili South", "Ihiala", "Njikoka", "Nnewi North", "Nnewi South", "Ogbaru", "Orumba North", "Orumba South", "Oyi"],
  "Bauchi": ["Alkaleri", "Babura", "Bogoro", "Damban", "Dass", "Gamawa", "Gamawa", "Ganjuwa", "Itas/Gadau", "Jama'are", "Katagum", "Kirfi", "Misau", "Ningi", "Shira", "Tafawa Balewa", "Toro", "Warji", "Zaki"],
  "Bayelsa": ["Brass", "Ekeremor", "Kolokuma/Opokuma", "Nembe", "Ogbia", "Sagbama", "Southern Ijaw", "Yenagoa"],
  "Benue": ["Ado", "Agatu", "Apa", "Buruku", "Gboko", "Guma", "Gwer East", "Gwer West", "Katsina-Ala", "Konshisha", "Kwande", "Logo", "Makurdi", "Ogbadibo", "Ohimini", "Oju", "Okpokwu", "Oturkpo", "Tarka", "Ushongo", "Vandeikya"],
  "Borno": ["Abadam", "Askira/Uba", "Bama", "Bayo", "Biu", "Chibok", "Damboa", "Dikwa", "Gubio", "Guzamala", "Gwoza", "Hawul", "Jere", "Kaga", "Kala/Balge", "Konduga", "Kukawa", "Kwaya Kusar", "Mafa", "Magumeri", "Maiduguri", "Monguno", "Ngala", "Nganzai", "Shani"],
  "Cross River": ["Akamkpa", "Akpabuyo", "Akpabuyo", "Biase", "Boki", "Calabar Municipal", "Calabar South", "Etung", "Ikom", "Obanliku", "Obubra", "Obudu", "Odukpani", "Ogoja", "Yala", "Yarkur"],
  "Delta": ["Aniocha North", "Aniocha South", "Bomadi", "Burutu", "Ika North East", "Ika South", "Isoko North", "Isoko South", "Ndokwa East", "Ndokwa West", "Okpe", "Oshimili North", "Oshimili South", "Patani", "Sapele", "Udu", "Ughelli North", "Ughelli South", "Ukwuani", "Uvwie", "Warri North", "Warri South", "Warri South West"],
  "Ebonyi": ["Abakaliki", "Afikpo North", "Afikpo South", "Ebonyi", "Ezza North", "Ezza South", "Ikwo", "Ishielu", "Ivo", "Izzi", "Ohaozara", "Ohaukwu", "Onicha"],
  "Edo": ["Akoko-Edo", "Esan Central", "Esan North-East", "Esan South-East", "Esan West", "Etsako Central", "Etsako East", "Etsako West", "Igueben", "Ikpoba-Okha", "Oredo", "Ovia North-East", "Ovia South-West", "Owan East", "Owan West", "Uhunmwonde"],
  "Ekiti": ["Ado Ekiti", "Efon", "Ekiti East", "Ekiti South-West", "Ekiti West", "Emure", "Ijero", "Ikere", "Ikole", "Ilejemeje", "Irepodun/Ifelodun", "Ise/Orun", "Moba", "Oye"],
  "Enugu": ["Enugu East", "Enugu North", "Enugu South", "Ezeagu", "Isi-Uzo", "Nkanu East", "Nkanu West", "Nsukka", "Oji River", "Udenu", "Udi", "Uzo-Uwani"],
  "Gombe": ["Akko", "Balanga", "Billiri", "Dukku", "Funakaye", "Gombe", "Kaltungo", "Kwami", "Nafada", "Shongom", "Yamaltu/Deba"],
  "Imo": ["Aboh Mbaise", "Ahiazu Mbaise", "Ahiazu Mbaise", "Ezinihitte", "Ideato North", "Ideato South", "Ikeduru", "Isiala Mbano", "Isu", "Mbaitoli", "Ngor-Okpala", "Njaba", "Nkwere", "Nkwerre", "Obowo", "Oguta", "Ohaji/Egbema", "Okigwe", "Orlu", "Orsu", "Oru East", "Oru West", "Owerri Municipal", "Owerri North", "Owerri West"],
  "Jigawa": ["Auyo", "Babura", "Birnin Kudu", "Buji", "Dutse", "Gagarawa", "Garki", "Gumel", "Guri", "Gwaram", "Gwiwa", "Hadejia", "Jahun", "Kafin Hausa", "Kaugama", "Kazaure", "Kiri Kasama", "Maigatari", "Malam Madori", "Miga", "Ringim", "Roni", "Sule Tankarkar", "Taura", "Zago"],
  "Kano": ["Ajingi", "Albasu", "Bagwai", "Bebeji", "Bichi", "Bunkure", "Dala", "Dambatta", "Dawakin Kudu", "Dawakin Tofa", "Doguwa", "Fagge", "Gabasawa", "Garko", "Garun Mallam", "Gaya", "Gezawa", "Gaya", "Gwarzo", "Kano Municipal", "Kibiya", "Kiru", "Kumbotso", "Kunchi", "Kura", "Madobi", "Makoda", "Minjibir", "Nasarawa", "Rano", "Rimin Gado", "Rogo", "Shanono", "Sumaila", "Takai", "Tarauni", "Tofa", "Tsanyawa", "Wudil"],
  "Kogi": ["Adavi", "Ajaokuta", "Bassa", "Dekina", "Ibaji", "Idah", "Igalamela Odolu", "Ijumu", "Kogi", "Lokoja", "Mopa Muro", "Ofu", "Ogori/Mangogo", "Okehi", "Okene", "Olamaboro", "Omala", "Yagba East", "Yagba West"],
  "Kwara": ["Asa", "Baruten", "Edu", "Ekiti", "Ifelodun", "Ilorin East", "Ilorin South", "Ilorin West", "Irepodun", "Isin", "Offa", "Oke-Ero", "Oyun", "Pategi"],
  "Lagos": ["Agege", "Ajeromi-Ifelodun", "Alimosho", "Amuwo-Odofin", "Apapa", "Badagry", "Epe", "Ibeju-Lekki", "Ifako-Ijaye", "Ifelodun", "Ikeja", "Ikorodu", "Kosofe", "Lagos Island", "Lagos Mainland", "Mushin", "Ojo", "Oshodi-Isolo", "Shomolu", "Surulere"],
  "Nasarawa": ["Akwanga", "Akko", "Doma", "Karu", "Keffi", "Kokona", "Lafia", "Nasarawa", "Nasarawa Eggon", "Obi", "Toto", "Wamba"],
  "Niger": ["Agwara", "Bida", "Borgu", "Bosso", "Chanchaga", "Edati", "Gbako", "Gawu-Babangida", "Gbusu", "Katcha", "Keffi", "Kontagora", "Lapai", "Lapai", "Lapai", "Lavun", "Mokwa", "Mashegu", "Magama", "Mariga", "Rafi", "Rijau", "Shiroro", "Suleja", "Wushishi"],
  "Ogun": ["Abeokuta North", "Abeokuta South", "Ado-Odo/Ota", "Egbado North", "Egbado South", "Ewekoro", "Ifo", "Ijebu East", "Ijebu North", "Ijebu North East", "Ijebu Ode", "Ikenne", "Imeko-Afon", "Ipokia", "Obafemi-Owode", "Odogbolu", "Odeda", "Ogun Waterside", "Remo North", "Remo South", "Sagamu"],
  "Ondo": ["Akoko North-East", "Akoko North-West", "Akoko South-East", "Akoko South-West", "Akure North", "Akure South", "Ese-Odo", "Idanre", "Ifedore", "Ilaje", "Ileoluji/Okeigbo", "Odigbo", "Okitipupa", "Ondo East", "Ondo West", "Ose", "Owo"],
  "Osun": ["Aiyedaade", "Aiyedire", "Atakumosa East", "Atakumosa West", "Boluwaduro", "Boripe", "Ifelodun", "Ife North", "Ife South", "Ife East", "Ilesa East", "Ilesa West", "Ilesa West", "Irepodun", "Iwo", "Odo Otin", "Ola-Oluwa", "Olorunda", "Oriade", "Orolu", "Osogbo"],
  "Oyo": ["Afijio", "Akinyele", "Atiba", "Atigbade", "Egbeda", "Ibadan North", "Ibadan North-East", "Ibadan North-West", "Ibadan South-East", "Ibadan South-West", "Ido", "Iseyin", "Itesiwaju", "Itesiwaju", "Kajola", "Lagelu", "Ogo Oluwa", "Ogbomosho North", "Ogbomosho South", "Olorunsogo", "Oluyole", "Ona Ara", "Saki East", "Saki West"],
  "Plateau": ["Bokkos", "Barkin Ladi", "Bassa", "Jos East", "Jos North", "Jos South", "Kanam", "Langtang North", "Langtang South", "Mangu", "Pankshin", "Quan'Pan", "Riyom", "Shendam", "Wase"],
  "Rivers": ["Abua/Odual", "Ahoada East", "Ahoada West", "Akuku-Toru", "Andoni", "Asari-Toru", "Bonny", "Degema", "Emohua", "Etche", "Ikwerre", "Khana", "Obio/Akpor", "Ogba/Egbema/Ndoni", "Ogoni", "Okrika", "Ogu/Bolo", "Ogu/Bolo", "Port Harcourt", "Tai"],
  "Sokoto": ["Binji", "Bodinga", "Dange Shuni", "Gada", "Goronyo", "Gudu", "Illela", "Kebbe", "Rabah", "Sokoto North", "Sokoto South", "Tambuwal", "Tureta", "Wamako", "Wurno", "Yabo"],
  "Taraba": ["Ardo-Kola", "Bali", "Donga", "Gashaka", "Gassol", "Ibi", "Jalingo", "Karim-Lamido", "Kumi", "Lau", "Sardauna", "Takum", "Ussa", "Wukari", "Yorro", "Zing"],
  "Yobe": ["Bade", "Bursari", "Damaturu", "Fika", "Fune", "Geidam", "Gulani", "Jakusko", "Karasuwa", "Machina", "Nangere", "Nguru", "Potiskum", "Tarmuwa", "Yunusari", "Yusufari"],
  "Zamfara": ["Anka", "Bakura", "Birnin Magaji", "Bukkuyum", "Bungudu", "Gummi", "Gusau", "Kaura Namoda", "Maradun", "Maru", "Shinkafi", "Talata Mafara", "Zumi"]
};


// Populate states dropdown
function populateStates() {
  const stateSelect = document.getElementById("lga");
  Object.keys(nigeriaData).forEach(state => {
    const option = document.createElement("option");
    option.value = state;
    option.textContent = state;
    stateSelect.appendChild(option);
  });
}

// Update wards based on selected state
function updateWards() {
  const stateSelect = document.getElementById("lga");
  const wardSelect = document.getElementById("ward");
  const selectedState = stateSelect.value;

  // Clear existing options
  wardSelect.innerHTML = "<option value=''>Select Ward</option>";

  if (nigeriaData[selectedState]) {
    nigeriaData[selectedState].forEach(ward => {
      const option = document.createElement("option");
      option.value = ward;
      option.textContent = ward;
      wardSelect.appendChild(option);
    });
  }
}

// Call this function when the page loads
populateStates();
document.getElementById("lga").addEventListener("change", updateWards);

// Your existing multi-step form functionality
var currentStep = 1;
var totalSteps = 3;

function showStep(step) {
  $('.step-content').hide();
  $('#step' + step).show();
  
  $('.step').removeClass('active');
  $('.step:nth-child(' + step + ')').addClass('active');

  if (step === 1) {
    $('#prevBtn').hide();
  } else {
    $('#prevBtn').show();
  }

  if (step === totalSteps) {
    $('#nextBtn').hide();
    $('#submitBtn').show();
  } else {
    $('#nextBtn').show();
    $('#submitBtn').hide();
  }
}

$('#nextBtn').click(function() {
  if (currentStep < totalSteps) {
    currentStep++;
    showStep(currentStep);
  }
});

$('#prevBtn').click(function() {
  if (currentStep > 1) {
    currentStep--;
    showStep(currentStep);
  }
});

$('#registerBtn').click(function() {
  $('#registrationPopup').show().removeClass('animate__fadeOut').addClass('animate__fadeIn');
  showStep(1);
});

$('#closePopup').click(function() {
  $('#registrationPopup').removeClass('animate__fadeIn').addClass('animate__fadeOut');
  setTimeout(function() {
    $('#registrationPopup').hide();
    currentStep = 1;
    showStep(1);
  }, 500);
});

// Handle form submission
$('#beneficiaryForm').submit(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: 'register_beneficiary.php',
    method: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json',  // Expect JSON response
    success: function(response) {
      if (response.success) {
        // Hide the registration popup
        $('#registrationPopup').removeClass('animate__fadeIn').addClass('animate__fadeOut');
        setTimeout(function() {
          $('#registrationPopup').hide();
          showNextActionPopup();
        }, 500);
      } else {
        alert('Error: ' + response.message);
      }
    },
    error: function(xhr, status, error) {
  console.error('AJAX Error:', status, error);
  console.log('Response Text:', xhr.responseText);
  alert('Error registering beneficiary. Please check the console for details.');
}
  });
});

// Function to show next action popup
function showNextActionPopup() {
  var popupHtml = `
    <div id="nextActionPopup" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registration Successful</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>What would you like to do next?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="returnToDashboard">Return to Dashboard</button>
            <button type="button" class="btn btn-primary" id="registerNewBeneficiary">Register New Beneficiary</button>
          </div>
        </div>
      </div>
    </div>
  `;

  $('body').append(popupHtml);
  $('#nextActionPopup').modal('show');

  // Handle return to dashboard
  $('#returnToDashboard').click(function() {
    $('#nextActionPopup').modal('hide');
    $('.success-animation').show().addClass('animate__animated animate__bounceIn');
    setTimeout(function() {
      $('.success-animation').removeClass('animate__bounceIn').addClass('animate__fadeOut');
      setTimeout(function() {
        $('.success-animation').hide().removeClass('animate__fadeOut');
        if (typeof table !== 'undefined' && table.ajax && typeof table.ajax.reload === 'function') {
          table.ajax.reload();
        } else {
          console.warn('Table reload function not available');
        }
      }, 500);
    }, 2000);
  });

  // Handle register new beneficiary
  $('#registerNewBeneficiary').click(function() {
    $('#nextActionPopup').modal('hide');
    $('#registrationPopup').show().removeClass('animate__fadeOut').addClass('animate__fadeIn');
    $('#beneficiaryForm')[0].reset();
    if (typeof showStep === 'function') {
      showStep(1);
    } else {
      console.warn('showStep function not defined');
    }
  });
}
  // Image preview functionality
  $('#photo').change(function() {
    var file = this.files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#imagePreview').attr('src', e.target.result).show();
      }
      reader.readAsDataURL(file);
    }
  });

  // View functionality
  $('#beneficiariesTable').on('click', '.view-btn', function() {
    var data = table.row($(this).parents('tr')).data();
    var detailsHtml = `
      <p><strong>Full Name:</strong> ${data.full_name_b}</p>
      <p><strong>Date of Birth:</strong> ${data.dob}</p>
      <p><strong>Gender:</strong> ${data.gender}</p>
      <p><strong>LGA:</strong> ${data.lga}</p>
      <p><strong>Ward:</strong> ${data.ward}</p>
      <p><strong>Address:</strong> ${data.address}</p>
      <p><strong>Phone:</strong> ${data.phone}</p>
      <p><strong>Email:</strong> ${data.email}</p>
      <p><strong>ID Number:</strong> ${data.id_number}</p>
      <p><strong>Benefit Type:</strong> ${data.benefit_type}</p>
      <p><strong>Registered By:</strong> ${data.reg_by}</p>
      <img src="uploads/${data.photo}" alt="Beneficiary Photo" style="max-width: 200px;">
    `;
    $('#beneficiaryDetails').html(detailsHtml);
    $('#viewPopup').show().removeClass('animate__fadeOut').addClass('animate__fadeIn');
  });

  $('#closeViewPopup').click(function() {
    $('#viewPopup').removeClass('animate__fadeIn').addClass('animate__fadeOut');
    setTimeout(function() {
      $('#viewPopup').hide();
    }, 500);
  });

  // Update functionality
  $('#beneficiariesTable').on('click', '.update-btn', function() {
    var data = table.row($(this).parents('tr')).data();
    $.ajax({
      url: 'update_beneficiary.php',
      method: 'POST',
      data: { id: data.id },
      success: function(response) {
        $('.success-animation').show().addClass('animate__animated animate__bounceIn');
        setTimeout(function() {
          $('.success-animation').removeClass('animate__bounceIn').addClass('animate__fadeOut');
          setTimeout(function() {
            $('.success-animation').hide().removeClass('animate__fadeOut');
          }, 500);
        }, 2000);
        table.ajax.reload();
      },
      error: function() {
        alert('Error updating beneficiary.');
      }
    });
  });
  
 // Sign out functionality
$('#signOutBtn').click(function(e) {
  e.preventDefault();
  $.ajax({
    url: 'sign_out.php',
    method: 'POST',
    success: function(response) {
      window.location.href = '../../index.php'; // Redirect to login page
    },
    error: function() {
      alert('Error signing out. Please try again.');
    }
  });
});

// Profile functionality
$('#profileBtn').click(function(e) {
  e.preventDefault();
  $.ajax({
    url: 'get_profile.php',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
      if(response.error) {
        alert(response.error);
      } else {
        showProfilePopup(response);
      }
    },
    error: function() {
      alert('Error fetching profile information.');
    }
  });
});

function showProfilePopup(profileData) {
  var popupHtml = `
    <div id="profilePopup" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Admin Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="profileForm" enctype="multipart/form-data">
              <img src="images/${profileData.picture}" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
              <div class="form-group">
                <label for="profilePicture">Update Profile Picture</label>
                <input type="file" class="form-control-file" id="profilePicture" name="profilePicture">
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="${profileData.name}">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="${profileData.email}">
              </div>
              <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" id="type" name="type" value="${profileData.type}" readonly>
              </div>
              <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  `;

  $('body').append(popupHtml);
  $('#profilePopup').modal('show');

  $('#profilePopup').on('hidden.bs.modal', function (e) {
    $(this).remove();
  });

  // Handle form submission
  $('#profileForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: 'update_profile.php',
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        alert('Profile updated successfully');
        $('#profilePopup').modal('hide');
      },
      error: function() {
        alert('Error updating profile.');
      }
    });
  });
}

  // Delete functionality
  $('#beneficiariesTable').on('click', '.delete-btn', function() {
    var data = table.row($(this).parents('tr')).data();
    if (confirm('Are you sure you want to delete this beneficiary?')) {
      $.ajax({
        url: 'delete_beneficiary.php',
        method: 'POST',
        data: { id: data.id },
        success: function(response) {
          $('.success-animation').show().addClass('animate__animated animate__bounceIn');
          setTimeout(function() {
            $('.success-animation').removeClass('animate__bounceIn').addClass('animate__fadeOut');
            setTimeout(function() {
              $('.success-animation').hide().removeClass('animate__fadeOut');
            }, 500);
          }, 2000);
          table.ajax.reload();
        },
        error: function() {
          alert('Error deleting beneficiary.');
        }
      });
    }
  });
});
</script>
</body>
</html>