// Delete Modals
var deleteModal = document.getElementById("DeleteModal");
var deleteUserModal = document.getElementById("DeleteUserModal");
var deleteContractorModal = document.getElementById("DeleteContractorModal");
var deleteMatModal = document.getElementById("DeleteMatModal");
// Edit Modals
var editUserModal = document.getElementById("EditUserModal");
var editContractorModal = document.getElementById("EditContractorModal");
var editMatModal = document.getElementById("EditMatModal");

// Pass ID to modals
editUserModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var uid=$(opener).attr('data-bs-id');
  var email=$(opener).attr('data-bs-email');
  var fname=$(opener).attr('data-bs-fname');
  var lname=$(opener).attr('data-bs-lname');
  var gid=$(opener).attr('data-bs-gid');
  
  $('.modal-body').find('[id="inputEmail"]').val(email);
  $('.modal-body').find('[id="inputFName"]').val(fname);
  $('.modal-body').find('[id="inputLName"]').val(lname);
  $('.modal-body').find('[id="inputGroup"]').val(gid);

  $('#editUserForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: 'scripts/edit_user.php',
        data:'UID='+uid+'&GID='+$("#inputGroup").val()+'&fname='+$("#inputFName").val()+'&lname='+$("#inputLName").val(),
        success: function()
        {
          location.href = 'index.php';
        }
    });
  });
});

editContractorModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var id=$(opener).attr('data-bs-cid');
  var contractor=$(opener).attr('data-bs-contractor');
  var description=$(opener).attr('data-bs-description');

  $('.modal-body').find('[name="contractor"]').val(contractor);
  $('.modal-body').find('[name="contractorDesc"]').val(description);

  $('#EditContractorForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: 'scripts/edit_contractor.php',
        data:'CID='+id+'&name='+$("#inputEdtContractor").val()+'&desc='+$("#inputEdtContractorDesc").val(),
        success: function()
        {
          location.href = 'index.php';
        }
    });
  });
});

editMatModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var mid=$(opener).attr('data-bs-mid');
  var material=$(opener).attr('data-bs-material');
  var description=$(opener).attr('data-bs-description');
  var cost=$(opener).attr('data-bs-cost');
  
  $('.modal-body').find('[id="inputEdtMat"]').val(material);
  $('.modal-body').find('[id="inputEdtMatDesc"]').val(description);
  $('.modal-body').find('[id="inputEdtMatCost"]').val(cost);

  $('#EditMatForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: 'scripts/edit_material.php',
        data:'MID='+mid+'&material='+$("#inputEdtMat").val()+'&desc='+$("#inputEdtMatDesc").val()+'&cost='+$("#inputEdtMatCost").val(),
        success: function()
        {
          location.href = 'index.php';
        }
    });
  });
});

deleteModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var projectid=$(opener).attr('data-bs-whatever');

  //set what we got to our form
  $('.modal-footer').find('[name="deleteModalSubmit"]').click(function(){
    $.get('scripts/delete_project.php?ID=' + projectid, function (data) {
      // successfully deleted
      // let's redirect
      if (data == 1) {
        location.href = 'index.php';
      }
    })
  });
}); 

deleteUserModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var uid=$(opener).attr('data-bs-whatever');

  //set what we got to our form
  $('.modal-footer').find('[name="deleteUserModalSubmit"]').click(function(){
    $.get('scripts/delete_user.php?ID=' + uid, function (data) {
      // successfully deleted
      // let's redirect
      if (data == 1) {
        location.href = 'index.php';
      }
    })
  });
}); 

deleteContractorModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var contractorid=$(opener).attr('data-bs-whatever');

  //set what we got to our form
  $('.modal-footer').find('[name="deleteContractorModalSubmit"]').click(function(){
    $.get('scripts/delete_contractor.php?ID=' + contractorid, function (data) {
      // successfully deleted
      // let's redirect
      if (data == 1) {
        location.href = 'index.php';
      }
    })
  });
}); 

deleteMatModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var matid=$(opener).attr('data-bs-whatever');

  //set what we got to our form
  $('.modal-footer').find('[name="deleteMatModalSubmit"]').click(function(){
    $.get('scripts/delete_material.php?ID=' + matid, function (data) {
      // successfully deleted
      // let's redirect
      if (data == 1) {
        location.href = 'index.php';
      }
    })
  });
}); 

// AJAX new project
$(document).ready(function() {
  $('#createProjectForm').submit(function(e) {
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: 'scripts/create_project.php',
          data: $(this).serialize(),
          success: function(response)
          {
            location.href = 'project.php?ID=' + response;
          }
      });
  });
});