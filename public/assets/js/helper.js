const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
async function ajaxRequest(method,url,data){
    data._token = CSRF_TOKEN;
    let response = $.ajax({
        url:url,
        method:method,
        data:data
    })
  return response;
}

function checkData(data){
    if(data.status === 200){
        return data.body;
    }
    throw new Error(data.message);
}
function checkDataCreateOrUpdate(data){
    if(data.status === 200 || data.status === 201){
        return data.message;
    }
    throw new Error(data.message);
}

function errorAlert(message){
    Swal.fire({
        title: "Error!",
        text: message,
        icon: "warning",
        showCancelButton: !1,
        confirmButtonColor: "#556ee6"
    })
}

function successAlert(message){
    Swal.fire({
        title: "Success!",
        text: message,
        icon: "success",
        showCancelButton: !1,
        confirmButtonColor: "#556ee6",
    })
}

function showLoader(){
    loader.style.display = 'flex';
}
function hideLoader(){
    loader.style.display = 'none';
}
window.addEventListener('load', function () {
    hideLoader();
});

function tableZeroData(data){
    $('#tableBody').html(` <tr>
                                    <td colspan="12" class="text-center">${data} not found!</td>
                                </tr>`)
}
