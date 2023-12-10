$(document).on('click','.editBtn',async function (){
    showLoader();
    try {
        let id = $(this).data('id');
        let response = await ajaxRequest("GET","/penalty-type/get/"+id,{})
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
        let name = $("#name").val();
        let requestData = {id,name};

        let response = await ajaxRequest("POST","/penalty-type/update",requestData)
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
        let name = $("#addName").val();
        let requestData = {name};
        let response = await ajaxRequest("POST","/penalty-type/create",requestData)
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
$(document).on('click','.deleteBtn',async function () {
    showLoader();
    try {
        let id = $(this).data('id');
        let row = $(this).closest('tr');
        let response = await ajaxRequest("POST","/penalty-type/delete",{id});
        let message = checkDataCreateOrUpdate(response);
        row.remove();
        let penaltyTypeCount = $(".penaltyTypes").length;
        if(penaltyTypeCount === 0){
            tableZeroData("Penalty Type")
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
    $('#name').val(data.name);
    $("#editModal").modal('show')
}
