
let user_id = $('#uid').val();
let folder_id = $('#fid').val();

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

            // $('.list-view').children().not('#openModalCard').remove();
            $('#folder-list-menu').empty();

            $.each(response.data, function(key, value){

                // $('.list-view').append(`
                //     <div>
                //         <div class="costum-card fs-5">
                //             ${value.name}
                //         </div>
                //     </div>
                // `);

                $('#folder-list-menu').append(`
                    <div class="folder" folder-id="${value.id}">
                        <a href="/folder/${value.id}">
                            <i class="fa-solid fa-folder"></i> ${value.name}
                            <div class="editFolder ml-auto btn btn-light" folder-id="${value.id}"  onclick="event.preventDefault();" data-toggle="modal" data-target="#folderFormModal">
                                <i class="fas fa-edit"></i>
                            </div>
                        </a>
                    </div>
                `);
            });
        }
    });
});

// Create Folder and Listing
$('#noteForm').submit(function(e){
    e.preventDefault();

    let title = $('#noteForm').find('#title').val();
    let content = $('#noteForm').find('#content').val();
    let note_id = $('.note-id').val();

    // switch (true) {
    //     case !name:
    //         $('#nameError').show();
    //         break;
    //     default:
    //         $(`.invalid-feedback`).hide();
    // }

    let formData = new FormData($('#noteForm')[0]);
    let url = '/api/note/create/' + folder_id; // Create Note

    if (note_id) {
        url = '/api/note/update/' + note_id; // Update note
    }

    ajaxRequest(url, 'POST', formData, function(response) {

        if(response.status === true) {

            $('#noteForm')[0].reset();

        } else if (response.errors) {

            $(`.invalid-feedback`).hide();

            $.each(response.errors, function(key, value) {
                $('#noteForm').find(`.${key}Error`).show();
                $('#noteForm').find(`.${key}Error`).text(value[0]);
            });
        }
    });

    // Folder and Notes Listing
    ajaxRequest(`/api/folder/show/${user_id}`, 'GET', '', function(response) {

        if(response.status === true) {

            $('.list-view-notes').children().not('#openModalCard').remove();
            $('#folder-list-menu').empty();
            $('#noteFormModal').modal('hide');

            $.each(response.data, function(key, value){

                // Folders
                $('#folder-list-menu').append(`
                    <div class="folder ${parseInt(value.id) === parseInt(folder_id) ? 'active' : '' }" folder-id="${value.id}">
                        <a href="/folder/${value.id}">
                            <i class="fa-solid fa-folder"></i> ${value.name}
                            <div class="editFolder ml-auto btn btn-light" folder-id="${value.id}"  onclick="event.preventDefault();" data-toggle="modal" data-target="#folderFormModal">
                                <i class="fas fa-edit"></i>
                            </div>
                        </a>
                    </div>
                `);

                // Notes
                if(value.folder_with_notes){

                    $.each(value.folder_with_notes, function(noteKey, noteValue){

                        $('.list-view-notes').append(`
                            <a class="note" note-id="${noteValue.id}" data-toggle="modal" data-target="#noteFormModal">
                                <div class="costum-card fs-5">
                                    ${noteValue.title}
                                </div>
                            </a>
                        `);

                        $('#folder-list-menu').append(`
                            <div class="ml-4 note ${parseInt(noteValue.id) === parseInt(folder_id) ? 'active' : '' }" note-id="${noteValue.id}" data-toggle="modal" data-target="#noteFormModal">
                                <a>
                                    ${noteValue.title}
                                    <div class="deleteNote ml-auto btn btn-light" note-id="${noteValue.id}"  onclick="event.preventDefault();">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </a>
                            </div>
                        `);
                    });
                }
            });
        }
    });
});

// Folders and Notes Listing
if(user_id !== null) {

    ajaxRequest(`/api/folder/show/${user_id}`, 'GET', '', function(response) {

        if(response.status === true) {

            $('.list-view').children().not('#openModalCard').remove();
            $('#folder-list-menu').empty();

            $.each(response.data, function(key, value){

                // Folder
                $('#folder-list-menu').append(`
                    <div class="folder ${parseInt(value.id) === parseInt(folder_id) ? 'active' : '' }" folder-id="${value.id}">
                        <a href="/folder/${value.id}" class="text-capitalize">
                            ${parseInt(value.id) === parseInt(folder_id) ? '<i class="fa-solid fa-folder-open"></i>' : '<i class="fa-solid fa-folder"></i>'}
                            ${value.name}
                            <div class="editFolder ml-auto btn btn-light" folder-id="${value.id}"  onclick="event.preventDefault();" data-toggle="modal" data-target="#folderFormModal">
                                <i class="fas fa-edit"></i>
                            </div>
                        </a>
                    </div>
                `);

                // Notes
                if(value.folder_with_notes){

                    $.each(value.folder_with_notes, function(noteKey, noteValue){

                        $('.list-view-notes').append(`
                            <a class="note" note-id="${noteValue.id}" data-toggle="modal" data-target="#noteFormModal">
                                <div class="costum-card fs-5">
                                    ${noteValue.title}
                                </div>
                            </a>
                        `);

                        $('#folder-list-menu').append(`
                            <div class="ml-4 note" note-id="${noteValue.id}" data-toggle="modal" data-target="#noteFormModal">
                                <a>
                                    ${noteValue.title}
                                    <div class="deleteNote ml-auto btn btn-light" note-id="${noteValue.id}"  onclick="event.preventDefault();">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </a>
                            </div>
                        `);
                    });
                }
            });
        }
    });
}

// Update folder
$(document).on('click', '.editFolder', function() {

    let folder_id = $(this).attr('folder-id');

    $('.folder-id').val(folder_id);

    ajaxRequest(`/api/folder/edit/${folder_id}`, 'GET', '', function(response) {
        if(response.status === true) {
            $('#name').val(response.data.name);
            $('.note-id').val(note_id);
        }
    });
});

// Delete note
$(document).on('click', '.deleteNote', function(e) {
    e.stopPropagation();

    let note_id = $(this).attr('note-id');

    if(confirm('Are you sure you want to delete this note?')) {
        ajaxRequest(`/api/note/delete/${note_id}`, 'GET', '', function(response) {
            if(response.status === false) {
                alert(response.message);
            }
        });

        ajaxRequest(`/api/folder/show/${user_id}`, 'GET', '', function(response) {

            if(response.status === true) {

                $('.list-view-notes').children().not('#openModalCard').remove();
                $('#folder-list-menu').empty();

                $.each(response.data, function(key, value){

                    // Folders
                    $('#folder-list-menu').append(`
                        <div class="folder ${parseInt(value.id) === parseInt(folder_id) ? 'active' : '' }" folder-id="${value.id}">
                            <a href="/folder/${value.id}">
                                <i class="fa-solid fa-folder"></i> ${value.name}
                                <div class="editFolder ml-auto btn btn-light" folder-id="${value.id}"  onclick="event.preventDefault();" data-toggle="modal" data-target="#folderFormModal">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </a>
                        </div>
                    `);

                    // Notes
                    if(value.folder_with_notes){

                        $.each(value.folder_with_notes, function(noteKey, noteValue){

                            $('.list-view-notes').append(`
                                <a class="note" note-id="${noteValue.id}" data-toggle="modal" data-target="#noteFormModal">
                                    <div class="costum-card fs-5">
                                        ${noteValue.title}
                                    </div>
                                </a>
                            `);

                            $('#folder-list-menu').append(`
                                <div class="ml-4 note ${parseInt(noteValue.id) === parseInt(folder_id) ? 'active' : '' }" note-id="${noteValue.id}" data-toggle="modal" data-target="#noteFormModal">
                                    <a>
                                        ${noteValue.title}
                                        <div class="deleteNote ml-auto btn btn-light" note-id="${noteValue.id}"  onclick="event.preventDefault();">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    </a>
                                </div>
                            `);
                        });
                    }
                });
            }
        });
    }
});

// Edit note
$(document).on('click', '.note', function() {

    let note_id = $(this).attr('note-id');

    ajaxRequest(`/api/note/edit/${note_id}`, 'GET', '', function(response) {
        if(response.status === true) {
            $('#title').val(response.data.title);
            $('#content').val(response.data.content);
            $('.note-id').val(note_id);
        }
    });
});

// delete Folder
$(document).on('click', '.deleteFolder ', function() {

    let folder_id = $(this).attr('folder-id');

    if (confirm('Are you sure you want to delete this folder?')) {
        ajaxRequest(`/api/folder/delete/${folder_id}`, 'GET', '', function(response) { });

        // Folder and Notes Listing
        ajaxRequest(`/api/folder/show/${user_id}`, 'GET', '', function(response) {

            if(response.status === true) {

                $('.list-view-notes').children().not('#openModalCard').remove();
                $('#folder-list-menu').empty();

                $.each(response.data, function(key, value){

                    // Folders
                    $('#folder-list-menu').append(`
                        <div class="folder ${parseInt(value.id) === parseInt(folder_id) ? 'active' : '' }" folder-id="${value.id}">
                            <a href="/folder/${value.id}">
                                <i class="fa-solid fa-folder"></i> ${value.name}
                                <div class="editFolder ml-auto btn btn-light" folder-id="${value.id}"  onclick="event.preventDefault();" data-toggle="modal" data-target="#folderFormModal">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </a>
                        </div>
                    `);

                    // Notes
                    if(value.folder_with_notes){

                        $.each(value.folder_with_notes, function(noteKey, noteValue){

                            $('.list-view-notes').append(`
                                <a class="note" note-id="${noteValue.id}" data-toggle="modal" data-target="#noteFormModal">
                                    <div class="costum-card fs-5">
                                        ${noteValue.title}
                                    </div>
                                </a>
                            `);

                            $('#folder-list-menu').append(`
                                <div class="ml-4 note ${parseInt(noteValue.id) === parseInt(folder_id) ? 'active' : '' }" note-id="${noteValue.id}" data-toggle="modal" data-target="#noteFormModal">
                                    <a>
                                        ${noteValue.title}
                                    </a>
                                </div>
                            `);
                        });
                    }
                });
            }
        });
    }
});

// Clear modal field's
$('#noteFormModal, #folderFormModal').on('hidden.bs.modal', function () {
    $('#title').val('');
    $('#content').val('');
    $('.note-id').val('');
    $('#name').val('');
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
