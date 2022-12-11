var deletePMIDModal = document.getElementById("DeletePMIDModal");

deletePMIDModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var projectid=$(opener).attr('data-bs-whatever');
  var pmid=$(opener).attr('data-bs-whatever-2');

  //set what we got to our form
  $('.modal-footer').find('[name="deletePMIDModalSubmit"]').click(function(){
    $.get('scripts/delete_PMID.php?ID=' + projectid + '&PMID=' + pmid, function (data) {
      // successfully deleted
      // let's redirect
      if (data == 1) {
        location.href = 'project.php?ID=' + projectid;
      }
    })
  });
}); 