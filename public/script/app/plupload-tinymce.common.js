let errorMessageShown = false; // 에러 메시지를 표시했는지 여부를 나타내는 변수
let previousUploadedFilesCount = 0 // plupload 새로운 파일 추가 여부 판단위한 변수
let plupladFile = [];

const tinymce_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', '/common/tinyUpload');

    xhr.upload.onprogress = (e) => {
        progress(e.loaded / e.total * 100);
    };

    xhr.onload = () => {
        if (xhr.status === 403) {
            reject({message: 'HTTP Error: ' + xhr.status, remove: true});
            return;
        }

        if (xhr.status < 200 || xhr.status >= 300) {
            reject('HTTP Error: ' + xhr.status);
            return;
        }

        const json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
            reject('Invalid JSON: ' + xhr.responseText);
            return;
        }

        resolve(json.location);
    };

    xhr.onerror = () => {
        reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
    };

    const formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());
    formData.append('_token', $('meta[name=csrf-token]').attr('content'));

    xhr.send(formData);
});

tinymce.init({
    promotion: false,
    selector: '.tinymce', // 에디터 사용 클래스
    image_dimensions: false, //이미지 자동 축소
    language: 'ko_KR',
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    relative_urls: false,
    remove_script_host: false,
    convert_urls: true,
    image_class_list: [
        {title: 'img-responsive', value: 'img-responsive'},
    ],
    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    height: 600,
    images_upload_handler: tinymce_image_upload_handler,
    file_picker_callback: function (cb, value, meta) {
        let input = document.createElement('input');

        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        input.onchange = function () {
            const file = this.files[0];
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function () {
                const id = 'blobid' + moment().valueOf();
                let blobCache = tinymce.activeEditor.editorUpload.blobCache;

                const base64 = reader.result.split(',')[1];
                const blobInfo = blobCache.create(id, file, base64);

                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), {title: file.name});
            };
        };

        input.click();
    },
    setup: function(editor) {
        editor.on('keyup', function(e) {
            if ($('#max_words').length > 0) {
                let tinymceVal = editor.getContent(); // 내용 가져오기
                tinymceVal = tinymceVal.replace(/<[^>]*>?/g, ""); // html 태그 삭제
                tinymceVal = tinymceVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

                const countLength = tinymceVal.split(' ').length;

                const wordcount = tinymce.activeEditor.plugins.wordcount;
                const charCount = wordcount.body.getCharacterCount();
                const editorName = editor.getElement().getAttribute('name');
                const lengthCheckEditor = [
                    'contents',
                ];

                if (lengthCheckEditor.includes(editorName)) {
                    let tinywordCnt = 0;
                    const maxLength = 350;

                    $('#' + editor.id).closest('div').find('.tinyword-cnt').val(countLength)

                    $('.tinyword-cnt').each(function (k, v) {
                        tinywordCnt += parseInt($(v).val());
                    });

                    // 어드민에서는 카운트 처리 X 박지호
                    const _checkUrl = $('#max_words').data('url');
                    if(_checkUrl != 'admin'){
                        if (tinywordCnt > maxLength) {
                            // editor.setContent('');

                            alert( maxLength + '자까지만 등록 가능합니다');

                            // 입력을 막기 위해 이전 상태로 되돌리기
                            editor.undoManager.undo();

                            let tinymceVal = editor.getContent(); // 내용 가져오기
                            tinymceVal = tinymceVal.replace(/<[^>]*>?/g, ""); // html 태그 삭제
                            tinymceVal = tinymceVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

                            const reCount = tinymceVal.split(' ').length;

                            tinywordCnt = 0;
                            $('#' + editor.id).closest('div').find('.tinyword-cnt').val(reCount)

                            $('.tinyword-cnt').each(function (k, v) {
                                tinywordCnt += parseInt($(v).val());
                            });

                        }

                    }

                    $('#max_words').val(tinywordCnt);
                }
            }
        });
    }
});

const pluploadInit = (addOption = {}) => {
    let defaultOption = {
        runtimes: 'html5,flash',
        flash_swf_url: '/script/Moxie.swf',
        silverlight_xap_url: '/script/Moxie.xap',
        url: '/common/plUpload',
        dragdrop: true,
        headers: {
            Accept: 'application/json',
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        },
        init: {
            PostInit: function (up) {
                $(up.getOption('container')).find('.plupload_button.plupload_start').hide();
            },
            Error: function (up, err) {
                // 에러 메시지를 한 번만 표시하도록 처리
                if (!errorMessageShown) {
                    up.stop();
                    up.splice();
                    errorMessageShown = true;
                    alert('파일 업로드 에러 - ' + err.message);
                    location.reload();
                }
            },
            FileUploaded: function (up, file, info) {
                plupladFile.push(JSON.parse(info.response));
            }
        }
    }

    $('#plupload').pluploadQueue($.extend({}, defaultOption, addOption));
}
