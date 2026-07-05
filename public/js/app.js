
let user_id = $('#uid').val();

// Create Folder and Listing
$('#folderForm').submit(function(e){
    e.preventDefault();

    let name = $('#folderForm').find('#name').val();
    let currentModal_folderId = $('#folderForm').find('.folder-id').val();

    switch (true) {
        case !name:
            $('#nameError').show();
            break;
        default:
            $(`.invalid-feedback`).hide();
    }

    let formData = new FormData($('#folderForm')[0]);

    let url = '/api/folder/create';

    if (currentModal_folderId) {
        url = '/api/folder/update/' + currentModal_folderId;
    }

    // Create Folder
    ajaxRequest(url, 'POST', formData, function(response) {

        if(response.status === true) {
            $('#folderForm')[0].reset();
            $('#folderFormModal').modal('hide');
        } else if (response.errors) {
            $(`.invalid-feedback`).hide();
            $.each(response.errors, function(key, value) {
                $('#folderForm').find(`.${key}Error`).show();
                $('#folderForm').find(`.${key}Error`).text(value[0]);
            });
        }
    });

    // Folders Listing
    ajaxRequest(`/api/folder/show/${user_id}`, 'GET', '', function(response) {

        if(response.status === true) {

            $('.list-view').children().not('#openModalCard').remove();
            $('#folder-list-menu').empty();

            $.each(response.data, function(key, value){
                $('.list-view').append(`
                    <a class="folder" href="/folder/${value.id}" folder-id="${value.id}">
                        <div class="costum-card fs-5">
                            ${value.name}
                        </div>
                    </a>
                `);
                $('#folder-list-menu').append(`
                    <div class="folder" folder-id="${value.id}">
                        <a href="/folder/${value.id}">
                            <i class="fa-solid fa-folder"></i> ${value.name}
                            <div class="editFolder ml-auto btn btn-light" folder-id="${value.id}" onclick="event.preventDefault();" data-toggle="modal" data-target="#folderFormModal">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="deleteFolder btn btn-light" folder-id="${value.id}" onclick="event.preventDefault();">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </a>
                    </div>
                `);
            });
        }
    });
});

// Folders Listing
if(user_id !== null) {

    ajaxRequest(`/api/folder/show/${user_id}`, 'GET', '', function(response) {

        if(response.status === true) {

            $('.list-view').children().not('#openModalCard').remove();
            $('#folder-list-menu').empty();

            $.each(response.data, function(key, value){

                // Folder in Dashboard
                $('.list-view').append(`
                    <a class="folder" href="/folder/${value.id}" folder-id="${value.id}">
                        <div class="costum-card fs-5">
                            ${value.name}
                        </div>
                    </a>
                `);

                // Folder Menu
                $('#folder-list-menu').append(`
                    <div class="folder" folder-id="${value.id}">
                        <a href="/folder/${value.id}">
                            <i class="fa-solid fa-folder"></i> ${value.name}
                            <div class="editFolder ml-auto btn btn-light" folder-id="${value.id}" onclick="event.preventDefault();" data-toggle="modal" data-target="#folderFormModal">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="deleteFolder btn btn-light" folder-id="${value.id}" onclick="event.preventDefault();">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </a>
                    </div>
                `);
            });
        }
    });
}


// update folder
$(document).on('click', '.editFolder', function() {

    let folder_id = $(this).attr('folder-id');

    $('.folder-id').val(folder_id);

    ajaxRequest(`/api/folder/edit/${folder_id}`, 'GET', '', function(response) {
        if(response.status === true) {
            $('#name').val(response.data.name);
        }
    });
});


// delete Folder
$(document).on('click', '.deleteFolder ', function() {

    let folder_id = $(this).attr('folder-id');

    if (confirm('Are you sure you want to delete this folder?')) {
        ajaxRequest(`/api/folder/delete/${folder_id}`, 'GET', '', function(response) { });

        // Folders Listing
        ajaxRequest(`/api/folder/show/${user_id}`, 'GET', '', function(response) {

            if(response.status === true) {

                $('.list-view').children().not('#openModalCard').remove();
                $('#folder-list-menu').empty();

                $.each(response.data, function(key, value){

                    // Folder in Dashboard
                    $('.list-view').append(`
                        <a class="folder" href="/folder/${value.id}" folder-id="${value.id}">
                            <div class="costum-card fs-5">
                                ${value.name}
                            </div>
                        </a>
                    `);

                    // Folder Menu
                    $('#folder-list-menu').append(`
                        <div class="folder" folder-id="${value.id}">
                            <a href="/folder/${value.id}">
                                <i class="fa-solid fa-folder"></i> ${value.name}
                                <div class="editFolder ml-auto btn btn-light" folder-id="${value.id}" onclick="event.preventDefault();" data-toggle="modal" data-target="#folderFormModal">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="deleteFolder btn btn-light" folder-id="${value.id}" onclick="event.preventDefault();">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
                            </a>
                        </div>
                    `);
                });
            }
        });
    }
});

// Ajax Request
function ajaxRequest(url, method, data, callback) {
    $.ajax({
        url: url,
        method: method,
        headers: {
            'Accept': 'application/json',
        },
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            callback(response);
        },
        error: function(xhr, status, error) {
            switch(xhr.status) {
                case 422:
                    callback(xhr.responseJSON);
                    break;
                case 401:
                    callback(xhr.responseJSON);
                    break;
                default:
                    console.error(xhr, status, error);
            }
        }
    });
}
