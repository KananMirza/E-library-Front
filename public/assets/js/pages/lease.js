$(document).on('click','#addSubmitBtn',async function () {
    showLoader();
    try {
        let userId = $("#userId").val();
        let bookId = $("#bookId").val();
        let statusId = $("#statusId").val();
        let fromDate = $("#fromDate").val();
        let toDate   = $("#toDate").val();
        let requestData = {userId,bookId,statusId,fromDate,toDate};
        console.log(requestData);
        let response = await ajaxRequest("POST","/lease/create",requestData)
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
$(document).on('click','.editBtn',async function (){
    showLoader();
    try {
        let id = $(this).data('id');
        let response = await ajaxRequest("GET","/lease/get/"+id,{})

        let data = checkData(response);
        console.log(data);
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
$(document).on('click','#updateBtn',async function () {
    showLoader();
    try {
        let id = $("#id").val();
        let userId = $("#editUserId").val();
        let bookId = $("#editBookId").val();
        let statusId = $("#editStatusId").val();
        let fromDate = $("#editFromDate").val();
        let toDate   = $("#editToDate").val();
        let requestData = {id,userId,bookId,statusId,fromDate,toDate};
        console.log(requestData);
        let response = await ajaxRequest("POST","/lease/update",requestData)
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
function viewEditModal(data){
    $('#id').val(data.id);
    $('#editFromDate').val(data.fromDate);
    $('#editToDate').val(data.toDate);
    let lastStatus = data.statuses.pop();
    $('#editUserId option[value="' + data.user.id + '"]').prop('selected', true);
    $('#editBookId option[value="' + data.book.id + '"]').prop('selected', true);
    $('#editStatusId option[value="' + lastStatus.id + '"]').prop('selected', true);

    $("#editModal").modal('show')
}

