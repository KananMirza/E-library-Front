$(document).on('click','.editBtn',async function (){
    showLoader();
    try {
        let id = $(this).data('id');
        let response = await ajaxRequest("GET","/author/get/"+id,{})
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
        let surname = $("#surname").val();
        let description = $("#description").val();
        let requestData = {id,name,surname,description};
        let fileInput = document.getElementById('editImage');
        let file = fileInput.files[0];
        if(file){
            let imageBase64,imageType;
            await uploadImage('editImage',true).then((result) => {
                imageBase64 = result.base64Data;
                imageType = result.fileType;
            });
            requestData = {id,name,surname,description,imageBase64,imageType}
        }

        let response = await ajaxRequest("POST","/author/update",requestData)
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
        let surname = $("#addSurname").val();
        let description = $("#addDescription").val();
        let imageBase64,imageType;
        await uploadImage('addImage',true).then((result) => {
            imageBase64 = result.base64Data;
            imageType = result.fileType;
        });
        let requestData = {name,surname,description,imageBase64,imageType};
        let response = await ajaxRequest("POST","/author/create",requestData)
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
        let response = await ajaxRequest("POST","/author/change-status",requestData);
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
        let response = await ajaxRequest("POST","/author/delete",{id});
        let message = checkDataCreateOrUpdate(response);
        row.remove();
        let authorCount = $(".authors").length;
        if(authorCount === 0){
            tableZeroData("Authors")
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
    $("#image").prop("src",'')
    $('#id').val(data.id);
    $('#name').val(data.name);
    $('#surname').val(data.surname);
    $('#description').text(data.description);
    if(data.image !== undefined){
        $("#image").prop("src",base64ToBlob(data.image))
    }
    $("#editModal").modal('show')
}
