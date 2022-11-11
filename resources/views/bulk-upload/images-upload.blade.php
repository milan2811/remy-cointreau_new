@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <input type="file" name="file[]" id="file" accept="image/*" multiple="multiple">
                                    <!-- Drag and Drop container-->

                                    <div class="upload-area" id="uploadfile">
                                        <i class="fas fa-cloud-upload-alt" style="font-size: 100px;"></i>
                                        <p id="uploadText">Drag and drop file here OR click to select file</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="progress" style="display: none;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                             aria-valuemin="0" aria-valuemax="100">
                                            <span class="pct-only">0%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="thumbnailExists" style="display: none;">
                                    <h3>Las imágenes ya existen</h3>
                                    <ul id="iamgeexixtUl"></ul>
                                </div>
                                <br />
                                <div class="thumbnail" style="display: none;">
                                    <h3>Imágenes cargadas</h3>
                                    <div class="row" id="uploadedImages"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .upload-area {
            width: 100%;
            height: auto;
            border: 2px solid lightgray;
            border-radius: 3px;
            margin: 0 auto;
            /* margin-top: 100px; */
            text-align: center;
            overflow: auto;
        }

        .upload-area:hover {
            cursor: pointer;
        }

        .upload-area p {
            text-align: center;
            /* font-weight: normal; */
            /* font-family: sans-serif; */
            /* line-height: 50px; */
            /* color: darkslategray; */
        }

        #file {
            display: none;
        }

        .size {
            font-size: 12px;
        }

    </style>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

    <script>
        // preventing page from redirecting
        $(function() {

            // preventing page from redirecting
            $("html").on("dragover", function(e) {
                e.preventDefault();
                e.stopPropagation();
                // $("p").text("Drag here");
            });

            $("html").on("drop", function(e) {
                e.preventDefault();
                e.stopPropagation();
            });

            // Drag enter
            $('.upload-area').on('dragenter', function(e) {
                e.stopPropagation();
                e.preventDefault();
                // $("p").text("Drop");
            });

            // Drag over
            $('.upload-area').on('dragover', function(e) {
                e.stopPropagation();
                e.preventDefault();
                // $("p").text("Drop");
            });

            // Drop
            $('.upload-area').on('drop', function(e) {
                e.stopPropagation();
                e.preventDefault();

                // $("p").text("Upload");

                var file = e.originalEvent.dataTransfer.files;
                var fd = new FormData();

                // fd.append('file', file[0]);
                if (files.length <= 50) {
                    for (var i = 0; i < file.length; i++) {
                        fd.append("file[]", file[i]);
                    }
                    fd.append("images_for", $('#images_for').val());

                    uploadData(fd);
                } else {
                    alert('Puedes seleccionar solo 50 imágenes');
                }
            });

            // Open file selector on div click
            $("#uploadfile").click(function() {
                $("#file").click();
            });

            // file selected
            $("#file").change(function() {
                var fd = new FormData();
                var files = $('#file')[0].files;
                if (files.length <= 50) {
                    for (var i = 0; i < files.length; i++) {
                        fd.append("file[]", files[i]);
                    }
                    fd.append("images_for", $('#images_for').val());
                    uploadData(fd);
                } else {
                    alert('Puedes seleccionar solo 50 imágenes');
                }
            });
        });

        // Sending AJAX request and upload file
        function uploadData(formdata) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('upload.images') }}',
                type: 'post',
                data: formdata,
                contentType: false,
                processData: false,
                dataType: 'json',
                xhr: function() {
                    $('.progress').show();
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            $('.progress-bar').css({
                                width: percentComplete * 100 + '%'
                            });
                            $('.pct-only').html(Math.round(percentComplete * 100) + '%');

                        }
                    }, false);
                    xhr.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            $('.progress-bar').css({
                                width: percentComplete * 100 + '%'
                            });
                            $('.pct-only').html(Math.round(percentComplete * 100) + '%');

                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    if (response.status == 1) {
                        addThumbnail(response);
                    } else {
                        alert(response.msg);
                    }
                }
            });
        }

        // Added thumbnail
        function addThumbnail(data) {
            // $("#uploadfile h1").remove();

            var len = $("#uploadfile div.thumbnail").length;

            var num = Number(len);
            num = num + 1;
            if (data.existsFiles.length > 0) {
                $("#iamgeexixtUl").html('');
                $.each(data.existsFiles, function(indexInArray, existsFileData) {
                    $("#iamgeexixtUl").append('<li>' + existsFileData + '</li>');
                });
                $('.thumbnailExists').show();
            }
            if (data.uploadedFiles.length > 0) {
                $('#uploadedImages').html('');
                $.each(data.uploadedFiles, function(indexInArray, fileData) {
                    var name = fileData.name;
                    var size = convertSize(fileData.size);
                    var src = fileData.src;
                    // Creating an thumbnail
                    $('#uploadedImages').append(`<div class="col-6 col-sm-2"><img src="` + src +
                        `" width="100%" class="img-thumbnail"><span class="size">` + name +
                        `</span><br/><span class="size">` + size +
                        `</span></div>`);
                });
                $(".thumbnail").show();
            }

        }

        // Bytes conversion
        function convertSize(size) {
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (size == 0) return '0 Byte';
            var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
            return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
        }
    </script>
@endsection
