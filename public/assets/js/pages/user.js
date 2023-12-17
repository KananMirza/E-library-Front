$(document).on('click','.viewBtn',async function (){
    showLoader();
    try {
        let id = $(this).data('id');
        let response = await ajaxRequest("GET","/user/get/"+id,{})
        let data = checkData(response);
        viewEditModal(data);
    }catch (e) {
        Swal.fire({
            title: "Error!",
            text: e.message,
            icon: "warning",
            showCancelButton: !1,
            confirmButtonColor: "#556ee6"
        })
    }finally {
        hideLoader();
    }
})
$(document).on('change','.status',async function (){
    showLoader();
    try {
        let id = $(this).data('id');
        let status = $(this).data('status');
        let requestData = {id,status};
        let response = await ajaxRequest("POST","/user/change-status",requestData);
        let message = checkDataCreateOrUpdate(response);
        successAlert(message);
        $(this).data('status',status === 1 ? 0 : 1);
    }catch (e) {
        errorAlert(e.message);
    }finally {
        hideLoader();
    }
})
//helper
function viewEditModal(data){
    $('#firstName').val(data.firstName);
    $('#lastName').val(data.lastName);
    $('#patryonomic').val(data.patryonomic);
    $('#email').val(data.email);
    $('#seriaCode').val(data.seriaCode);
    $('#seriaNumber').val(data.seriaNumber);
    $('#fin').val(data.fin);
    let html ='';
    if(data.phones.length === 0){
        html =`<p class="text-danger">User Phone not found!</p>`
    }else{
        html = `  <label for="phones" class="col-form-label">Phones:</label>`
        data.phones.forEach((phone)=>{
            html += ` <input type="text" class="form-control mb-2" value="${phone.phone}" readonly>`
        })
    }
    $('#phones').html(html);
    $("#viewModal").modal('show')
}

window.addEventListener('load', function () {
    let searchInput = $('input[type="search"]');
    let nameAndSurname = $('#nameAndSurname').val();
    searchInput.val(nameAndSurname);
    searchInput.focus();
    searchInput.trigger('input');

});
