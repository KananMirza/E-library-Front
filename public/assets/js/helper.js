const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

async function ajaxRequest(method, url, data) {
    data._token = CSRF_TOKEN;
    let response = $.ajax({
        url: url,
        method: method,
        data: data
    })
    return response;
}

function checkData(data) {
    if (data.status === 200) {
        return data.body;
    }
    throw new Error(data.message);
}

function checkDataCreateOrUpdate(data) {
    if (data.status === 200 || data.status === 201) {
        return data.message;
    }
    throw new Error(data.message);
}

function errorAlert(message) {
    Swal.fire({
        title: "Error!",
        text: message,
        icon: "warning",
        showCancelButton: !1,
        confirmButtonColor: "#556ee6"
    })
}

function successAlert(message) {
    Swal.fire({
        title: "Success!",
        text: message,
        icon: "success",
        showCancelButton: !1,
        confirmButtonColor: "#556ee6",
    })
}

function showLoader() {
    loader.style.display = 'flex';
}

function hideLoader() {
    loader.style.display = 'none';
}

window.addEventListener('load', function () {
    hideLoader();
});

function tableZeroData(data) {
    $('#tableBody').html(` <tr>
                                    <td colspan="12" class="text-center">${data} not found!</td>
                                </tr>`)
}
async function uploadImage(element,isRequired) {

    return new Promise((resolve, reject) => {
        // choose file
        let fileInput = document.getElementById(element);
        let file = fileInput.files[0];

        if (!file && isRequired) {
            reject(new Error("Please select an image!"));
            return;
        }

        // Convert to base64
        let reader = new FileReader();
        reader.onloadend = function (e) {
            // Base64 file
            let base64Data = e.target.result.split(',')[1];

            // Determine file type
            let fileType = file.type.split('/')[1];

            // Resolve with both base64 data and file type
            resolve({ base64Data, fileType });
        };

        reader.readAsDataURL(file);
    });
}

function base64ToBlob(base64Data, contentType = '') {
    const byteCharacters = atob(base64Data);
    const sliceSize = 1024;
    const byteArrays = [];

    for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        const slice = byteCharacters.slice(offset, offset + sliceSize);
        const byteNumbers = new Array(slice.length);

        for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        byteArrays.push(new Uint8Array(byteNumbers));
    }

    const blob = new Blob(byteArrays, { type: contentType });
    const url = URL.createObjectURL(blob);

    return url;
}


