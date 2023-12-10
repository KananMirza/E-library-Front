$(document).on('change','.status',async function (){
    showLoader();
    try {
        let id = $(this).data('id');
        let status = $(this).data('status');
        let requestData = {id,status};
        let response = await ajaxRequest("POST","/book/change-status",requestData);
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
        let response = await ajaxRequest("POST","/book/delete",{id});
        let message = checkDataCreateOrUpdate(response);
        row.remove();
        let bookCount = $(".books").length;
        if(bookCount === 0){
            tableZeroData("Books")
        }
        hideLoader()
        successAlert(message)
    }catch (e){
        errorAlert(e.message);
    }finally {
        hideLoader()
    }
})

