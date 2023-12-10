$(document).on('click','.editBtn',async function (){
    showLoader();
    try {
        let id = $(this).data('id');
        let response = await ajaxRequest("GET","/shelf/get/"+id,{})
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
$(document).on('click','#updateBtn',async function (){
    showLoader();
    try {
        let id = $("#id").val();
        let shelfNo = $("#shelfNo").val();
        let requestData = {id,shelfNo};

        let response = await ajaxRequest("POST","/shelf/update",requestData)
        let message = checkDataCreateOrUpdate(response);
        successAlert(message);
        setTimeout(function (){
            location.reload();
        },2000)
    }catch (e){
        errorAlert(e.message);
    }finally {
        hideLoader();
    }
})
$(document).on('click','#addSubmitBtn',async function () {
    showLoader();
    try {
        let shelfNo = $("#addShelfNo").val();
        let requestData = {shelfNo};
        let response = await ajaxRequest("POST","/shelf/create",requestData)
        let message = checkDataCreateOrUpdate(response);
        successAlert(message);
        setTimeout(function (){
            location.reload();
        },2000)
    }catch (e){
        errorAlert(e.message);
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
        let response = await ajaxRequest("POST","/shelf/change-status",requestData);
        let message = checkDataCreateOrUpdate(response);
        successAlert(message);
        $(this).data('status',status === 1 ? 0 : 1);
    }catch (e) {
        errorAlert(e.message);
    }finally {
        hideLoader();
    }
})
$(document).on('click','.deleteBtn',async function () {
    showLoader();
    try {
        let id = $(this).data('id');
        let row = $(this).closest('tr');
        let response = await ajaxRequest("POST","/shelf/delete",{id});
        let message = checkDataCreateOrUpdate(response);
        row.remove();
        let shelfCount = $(".shelves").length;
        if(shelfCount === 0){
            tableZeroData("Shelves")
        }
        hideLoader()
        successAlert(message)
    }catch (e){
        errorAlert(e.message);
    }finally {
        hideLoader()
    }
})
//helper
function viewEditModal(data){
    $('#id').val(data.id);
    $('#shelfNo').val(data.shelfNo);
    $("#editModal").modal('show')
}
