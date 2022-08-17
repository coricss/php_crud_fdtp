<?php

  
  include('config/database.php');
  $con = get_db_config();

  include_once 'queries/add_employee.php';
  include_once 'queries/get_employee.php';
  include_once 'queries/update_employee.php';
  include_once 'queries/delete_employee.php';

?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Rico Guinanao | Technical Examination</title>

      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
      <link rel ="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
      <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
      <div class="wrapper">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="text-center text-white">
                <h1 class="text-danger fw-bold">FDTP Technical Examination (Medium Part)</h1>
                <h2>Employee Management System</h2>
              </div>
             
              <div class="table-wrapper p-5 text-white">
                <div class="mb-5 text-center">
                  <button type="button" class="btn btn-outline-danger btn-lg btn-new-employee" data-bs-toggle="modal" data-bs-target="#newEmployeeModal">Add New Employee</button>
                </div>
                <table class="table table-dark table-responsive table-bordered table-hover table-striped employee-table text-white w-100" id="employee-table">
                  <thead>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                  <?php while($row = $result->fetch_array()){ ?>
                    <tr>
                      <td class="align-middle">
                        <?php echo $row['emp_id'];?>
                      </td>
                      <td class="text-center">
                        <img src="assets/images/uploads/<?php echo $row['emp_photo'];?>" class="img-fluid rounded-circle" width="70px" alt="">
                      </td>
                      <td class="align-middle">
                        <?php echo $row['emp_name'];?>
                      </td>
                      <td class="align-middle">
                        <?php echo $row['emp_email'];?>
                      </td>
                      <td class="align-middle">
                        <?php echo $row['position_name'];?>
                      </td>
                      <td class="align-middle">
                        <?php echo $row['department_name'];?>
                      </td>
                      <td class="align-middle">
                        <?php echo $row['status'];?>
                      </td>
                      <td class="align-middle text-center">
                        <button class="btn btn-sm btn-primary btn-edit px-2" data-bs-toggle="modal" data-bs-target="#editEmployeeModal-<?php echo $row['emp_id'];?>" data-id="<?php echo $row['emp_id'];?>">
                          <i class="bx bx-edit fs-5"></i>
                        </button>
                        <a href="index.php?delete=<?php echo $row['emp_id']?>">
                          <button class="btn btn-sm btn-danger btn-delete px-2" name="btn-delete" data-status="<?php echo $row['status'];?>">
                            <i class="bx bx-trash fs-5"></i>
                          </button>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="credits">
          <span class="text-white">
            Created by <a href="https://github.com/coricss" class="text-decoration-none text-danger">Rico Guinanao</a>
          </span>
        </div>
      </div>

      <!-- New Employee Modal -->
      <div class="modal fade" id="newEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="newEmployeeModalLabel">Add New Employee</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="container" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row mt-3">
                  <div class="profile-photo">
                    <div class="form-group img-profile text-center col-12" style="position: relative;">
                      <span class="img-div">
                          <div class="text-center img-placeholder" onClick="triggerClick()">
                              <h5>Click to upload your photo</h5>
                          </div>
                          <img src="assets/images/attach.png" width="2in" alt="" onClick="triggerClick()" id="profileDisplay">
                      </span>
                      <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;" accept="image/*" required >
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="form-group col-6">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="emp_name" required>
                  </div>
                  <div class="form-group col-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="test@domain.com" name="emp_email" required>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="form-group col-6">
                    <label for="department">Department</label>
                    <select class="form-select" id="department" name="emp_dept" required>
                      <option value="" disabled selected>Select department</option>
                      <option value="1">MIT</option>
                      <option value="2">Accounting</option>
                      <option value="3">Marketing</option>
                      <option value="4">HR</option>
                    </select>
                  </div>
                  <div class="form-group col-6">
                    <label for="position">Position</label>
                    <select class="form-select" id="position" name="emp_position" required disabled>
                      <option value="" disabled selected>Select position</option>

                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer align-items-center justify-content-center">
                <button type="submit" class="btn btn-primary btn-save" name="btn-add-employee">Save</button>
                <button type="reset" class="btn btn-danger btn-clear">Clear</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Edit Employee Modal -->
      <?php while($rows = $edit->fetch_array()){ ?>
      <div class="modal fade" id="editEmployeeModal-<?php echo $rows['emp_id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="container" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row mt-3">
                  <div class="profile-photo">
                  <div class="form-group img-profile text-center col-12" style="position: relative;">
                      <span class="img-div">
                          <!-- <div class="text-center img-placeholder profileDisplayEdit"  data-id="<?php echo $rows['emp_id'];?>">
                              <h5>Click to upload your photo</h5>
                          </div> -->
                          <img src="assets/images/uploads/<?php echo $rows['emp_photo'];?>" width="2in" alt=""  id="profileDisplayEdit-<?php echo $rows['emp_id'];?>" class="profileDisplayEdit" data-id="<?php echo $rows['emp_id'];?>">
                      </span>
                      <input type="file" name="profileImageEdit" id="profileImageEdit-<?php echo $rows['emp_id'];?>" class="form-control profileImageEdit" style="display: none;" accept="image/*" data-id="<?php echo $rows['emp_id'];?>">
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="form-group col-6">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="emp_name_edit" value="<?php echo $rows['emp_name'];?>" required>
                  </div>
                  <div class="form-group col-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="test@domain.com" name="emp_email_edit" value="<?php echo $rows['emp_email'];?>" required>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="form-group col-6">
                    <label for="department">Department</label>
                    <select class="form-select" id="department" name="emp_dept_edit" required>
                      <option value="<?php echo $rows['department_id'];?>" selected><?php echo $rows['department_name'];?></option>
                      <option value="1">MIT</option>
                      <option value="2">Accounting</option>
                      <option value="3">Marketing</option>
                      <option value="4">HR</option>
                    </select>
                  </div>
                  <div class="form-group col-6">
                    <label for="position">Position</label>
                    <select class="form-select" id="position" name="emp_position_edit" required>
                      <option value="<?php echo $rows['position_id'];?>"selected><?php echo $rows['position_name'];?></option>
                    </select>
                  </div>
                </div>
                <div class="row mt-3 justify-content-center">
                <div class="form-group col-12 w-25 text-center">
                    <label for="status">Status</label>
                    <select class="form-select" id="status" name="emp_dept" required>
                      <option value="<?php echo $rows['status'];?>" selected><?php echo $rows['status'];?></option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer align-items-center justify-content-center">
                <button type="submit" class="btn btn-primary btn-save" name="btn-update-employee">Update</button>
                <button type="reset" class="btn btn-danger btn-reset">Reset</button>
                <input type="hidden" name="emp_id_edit" value="<?php echo $rows['emp_id'];?>">
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
      <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
      <script src="assets/js/script.js"></script>
      <?php if(isset($_SESSION['message'])){?>
        <?php 
          echo $_SESSION['message'];
          unset($_SESSION['message']);
          ?>
      <?php }?>
    </body>
  </html>