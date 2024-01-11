$(document).on('click','.editBtn',async function (){
    showLoader();
    try {
        let id = $(this).data('id');
        let response = await ajaxRequest("GET","/penalty/get/"+id,{})
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
$(document).on('click','#updateBtn',async function (){
    showLoader();
    try {
        let id = $("#id").val();
        let leaseId = $("#editLease").val();
        let penaltyTypeId = $("#editType").val();

        let requestData = {id,leaseId,penaltyTypeId};
        let response = await ajaxRequest("POST","/penalty/update",requestData)
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
        let leaseId = $("#lease").val();
        let penaltyTypeId = $("#type").val();

        let requestData = {leaseId,penaltyTypeId};
        let response = await ajaxRequest("POST","/penalty/create",requestData)
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
// $(document).on('change','.status',async function (){
//     showLoader();
//     try {
//         let id = $(this).data('id');
//         let status = $(this).data('status');
//         let requestData = {id,status};
//         let response = await ajaxRequest("POST","/penalty/change-status",requestData);
//         let message = checkDataCreateOrUpdate(response);
//         successAlert(message);
//         $(this).data('status',status === 1 ? 0 : 1);
//     }catch (e) {
//         errorAlert(e.message);
//     }finally {
//         hideLoader();
//     }
// })
//helper
function viewEditModal(data){
    $('#id').val(data.id);
    $("#editLease option[value='" + data.lease.id + "']").attr("selected", "selected");
    $("#editType option[value='" + data.penaltyType.id + "']").attr("selected", "selected");
    $("#editModal").modal('show')
}
