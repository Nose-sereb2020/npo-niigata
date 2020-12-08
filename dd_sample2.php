<?php
include_once 'head.php';

?>

<?php print makeHeader("ページタイトル"); ?>
<style type="text/css">
#main {
    height: 600px;
}

#draggable {
    top: 90px;
    left: 40px;
    width: 320px;
    height: 240px;
    position: absolute;
}
</style>
</head>

<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-center">
                <h3>ドラッグアンドドロップサンプル2 JQuery + PHP</h3>
            </div>
        </div>
        <div id="main">
            <div id="draggable" class="ui-widget-content">
                <div id="sample_img1">
                    <p>ここに画像をドロップ</p>
                </div>
            </div>
        </div>
    </div>
    <?php print makeFooter("NPO-PC");?>
    <script>
    var u_file;

    $(function() {
        $(document).on('drop dragover', function(e) {
            e.stopPropagation();
            e.preventDefault();
        });

        $('#draggable').draggable({
            stop: function(e, ui) {
                alert('top:' + (ui.offset.top - $('body').position().top) + ' left:' + (ui.offset
                    .left - $('body').position().left));
            }
        });


        $('#draggable').on('dragover', function(e) {
            e.stopPropagation();
            e.preventDefault();
        }).resizable({
            stop: function(e, ui) {
                console.log(ui.size['width']);
                console.log(ui.size['height']);
                var im = $('#sample_img1').children('img');
                var im_str = im.attr('src');
                if (im_str) {
                    var base_name = im_str.split("/");
                    var f_num = base_name.length - 1;
                    var file_name = base_name[f_num].split("?");
                    console.log(file_name[0]);
                    setThumbs(file_name[0]);
                } else {
                    console.log("イメージなし")
                }
            }
        });

        $('#draggable').on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var file = e.originalEvent.dataTransfer.files[0];
            if (!file.type.match(/^image\/(jpeg|png)$/)) {
                $('#draggable').css('color', '#ff0000').html("この種類のファイルは使用できません");
                return;
            }
            setFiles(e.originalEvent.dataTransfer.files);


        });

        $('#sample_img1').mousedown(function(e) {
            e.preventDefault();
        });
        $('#sample_img1').mouseup(function(e) {
            e.preventDefault();
        });

    });


    // リサイズイベントの処理
    function onDropFile_resize(file) {
        var $photoArea = $('#draggable');
        var $thumbArea = $('#sample_img1');
        $thumbArea.empty();


        var dataUrl = file;

        createThumbnail_1(dataUrl, function(thumbnail) {
            var $img = $('<img />');
            $img.attr('src', thumbnail);
            $thumbArea.append($img);
        });
    }

    // 写真ファイル保存
    function setFiles(files) {

        if (files.length == 0) return false;
        document.body.style.cursor = "wait";

        // Formdata オブジェクトを用意
        var fd = new FormData();
        var thumbAreaWidth = $('#draggable').width();
        var thumbAreaHeight = $('#draggable').height();

        fd.append("tfiles", files[0]);
        fd.append("width", thumbAreaWidth);
        fd.append("height", thumbAreaHeight);
        console.log(files[0].name);

        $.ajax({
            url: "send_image1.php",
            type: "POST",
            data: fd,
            mode: "multiple",
            processData: false,
            contentType: false,
            timeout: 10000,
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                err =
                    XMLHttpRequest.status +
                    "\n" +
                    XMLHttpRequest.statusText;
                alert(err);
                document.body.style.cursor = "auto";
            },
            beforeSend: function(xhr) {},
        }).done(function(res) {
            document.body.style.cursor = "auto";
            $("#sample_img1").html(res);
        });
    }

    function setThumbs(file_name) {
        document.body.style.cursor = "wait";

        // Formdata オブジェクトを用意
        var fd = new FormData();
        var thumbAreaWidth = $('#draggable').width();
        var thumbAreaHeight = $('#draggable').height();


        fd.append("thumb_name", file_name);
        fd.append("width", thumbAreaWidth);
        fd.append("height", thumbAreaHeight);
        console.log(file_name);

        $.ajax({
            url: "change_thumb.php",
            type: "POST",
            data: fd,
            mode: "multiple",
            processData: false,
            contentType: false,
            timeout: 10000,
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                err =
                    XMLHttpRequest.status +
                    "\n" +
                    XMLHttpRequest.statusText;
                alert(err);
                document.body.style.cursor = "auto";
            },
            beforeSend: function(xhr) {},
        }).done(function(res) {
            document.body.style.cursor = "auto";
            $("#sample_img1").html(res);
        });
    }
    </script>
</body>

</html>