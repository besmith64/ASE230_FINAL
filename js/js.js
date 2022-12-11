var deleteModal = document.getElementById("DeleteModal");
var deleteUserModal = document.getElementById("DeleteUserModal");
var deleteContractorModal = document.getElementById("DeleteContractorModal");
var deleteMatModal = document.getElementById("DeleteMatModal");

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
// $(document).ready(function(){
//   $("#createProj").click(function(){
//     var project = $("#inputProject").val();
//     var description = $("#projDesc").val();
//     var contractor = $("#inputContractor").val();
//     var address = $("#inputAddress").val();
//     var city = $("#inputCity").val();
//     var state = $("#inputState").val();
//     var zip = $("#inputZip").val();

//     // Returns successful data submission message when the entered information is stored in database.
//     var dataString = 'project='+ project + '&description='+ description + '&contractor='+ contractor + 
//                      '&address=' + address + '&city=' + city + '&state=' + state + '&zip=' + zip;
//     if(project == '') {
//       alert("Please Enter a Project Name");
//     }
//     else if (contractor == '') {
//       alert("Please Enter a Contractor");
//     } else {
//       // AJAX Code To Submit Form.
//       $.ajax({
//         type: "POST",
//         url: "scripts/create_project.php",
//         data: dataString,
//         cache: false,
//         success: function(result){
//           alert(result);
//         }
//       });
//     }
//     return false;
//   });
// });
$('#createProjForm > button').click(function(e) {
  e.preventDefault(); //prevent default behaviour
  var formData = $('#createProjForm').serialize() //serialize data from form

  // AJAX Code To Submit Form.
  $.ajax({
    type: "POST",
    url: "scripts/create_project.php",
    data: formData
  });
});