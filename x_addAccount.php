<?php
include "zzz_initialize.php";
?>
  <!-- MODAL CONTENT [START]-->
  <div class="modal-header noselect" style="background-color: #2b2b2b;">
    <h4 class="modal-title" style="color: white;">Create New Account</h4>
  </div>

  <form autocomplete="off" method="post">
  <div class="modal-body noselect" style="color: black;">

    <div class="container">
      <h4><u>Personal Information</u></h4>
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="nm" placeholder="Enter full name" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="em" placeholder="Enter email" required>
      </div>
      <div class="form-group">
        <label>Address</label>
        <input type="text" class="form-control" name="ad" placeholder="Enter address" required>
      </div>
      <div class="form-group">
        <label>Contact Number</label>
        <input type="text" class="form-control" name="cn" placeholder="Enter contact number" required>
      </div>
    </div>

    <hr style="border-color: black;"/>

    <div class="container">
      <h4><u>Account Information</u></h4>
      <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="un" placeholder="Enter username" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="pw" placeholder="Enter password" required>
      </div>
      <div class="form-group">
        <label>Account Type</label>
        <select class="mb-3" name="t">
          <option value="Admin">Admin</option>
          <option value="Staff">Staff</option>
        </select>
      </div>
    </div>

  </div>
  <div class="modal-footer noselect">
    <button style="height:36px;border-radius:30px;" type="button" class="btn btn-dark" data-bs-dismiss="modal" formnovalidate>Cancel</button>
    <button style="height:36px;border-radius:30px;" class="btn btn-success" type="submit" name="create_btn">Create</button>
  </div>
  </form>
  <!-- MODAL CONTENT [END]-->