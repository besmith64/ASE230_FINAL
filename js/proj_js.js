var deletePMIDModal = document.getElementById("DeletePMIDModal");
var editModal = document.getElementById("EditModal");

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

editModal.addEventListener("show.bs.modal", function (e) {
  // Button that triggered the modal
  var opener = e.relatedTarget;
  // Extract info from data-bs-* attributes
  var project=$('.modal-body').find('[id="inputProj"]').val();
  var pmid=$(opener).attr('data-bs-pmid');
  var material=$(opener).attr('data-bs-material');
  var projcost=$(opener).attr('data-bs-projcost');
  var qty=$(opener).attr('data-bs-qty');
  var paid=$(opener).attr('data-bs-paid');
  
  $('.modal-body').find('[id="inputPMID"]').val(pmid);
  $('.modal-body').find('[id="inputMaterial"]').val(material);
  $('.modal-body').find('[id="inputMatCost"]').val(projcost);
  $('.modal-body').find('[id="inputMatQty"]').val(qty);
  $('.modal-body').find('[id="inputMatPaid"]').val(paid);

  $('#editPM').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: 'scripts/edit_pm.php',
        data:'project='+project+'&pmid='+pmid+'&projcost='+$("#inputMatCost").val()+'&qty='+$("#inputMatQty").val()+'&paid='+$("#inputMatPaid").val(),
        success: function(response)
        {
          location.href = 'project.php?ID=' + response;
        }
    });
});
});
