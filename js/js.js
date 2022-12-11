var deleteModal = document.getElementById("DeleteModal");


deleteModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var projectid=$(opener).attr('data-bs-whatever');

  //set what we got to our form
  $('.modal-footer').find('[name="deleteModalSubmit"]').click(function(){
    $.ajax({
      url: 'scripts/delete.php?ID=' + projectid,
      type: "GET",
      success: function (response) {

        // project successfully deleted
        // let's redirect
        if (response == "1"){
          location.href = 'index.php';
        }
      }
    });
  });
}); 