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
                <h3>ドラッグアンドドロップサンプル1 JQuery</h3>
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
                console.log('top: ' + (ui.offset.top - $('body').position().top));
                console.log('left: ' + (ui.offset.left - $('body').position().left));
                var b = $('#draggable');
                console.log(b.width());
                console.log(b.height());
                alert('top:' + (ui.offset.top - $('body').position().top) + ' left:' + (ui.offset
                    .left - $('body').position().left));
            }
        }).resizable({
            stop: function(e, ui) {
                if (u_file != null) {
                    onDropFile_resize(u_file);
                }
                console.log(ui.size['width']);
                console.log(ui.size['height']);
                alert('width:' + ui.size['width'] + ' height:' + ui.size['height']);
            }
        });

        $('#draggable').on('dragover', function(e) {
            e.stopPropagation();
            e.preventDefault();
        });
        $('#draggable').on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            onDropFile_1(e);
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

    // ドロップイベントの処理
    function onDropFile_1(event) {
        var $photoArea = $('#draggable');
        var $thumbArea = $('#sample_img1');
        $thumbArea.empty();
        // var $span = $photoArea.find('span');
        // $span.empty();
        // console.log(event);
        // console.log(event.originalEvent);
        // console.log(event.originalEvent.dataTransfer);

        var file = event.originalEvent.dataTransfer.files[0];
        console.log(file)
        if (!file.type.match(/^image\/(jpeg|png)$/)) {
            $thumbArea.css('color', '#ff0000').html("この種類のファイルは使用できません");
            return;
        }

        var reader = new FileReader();
        reader.onload = function(e) {
            var dataUrl = e.target.result;
            u_file = dataUrl;
            createThumbnail_1(dataUrl, function(thumbnail) {
                var $img = $('<img />');
                $img.attr('src', thumbnail);
                $thumbArea.append($img);
            });
        }
        reader.readAsDataURL(file);

    }

    // 表示用サムネイルの作成
    function createThumbnail_1(dataUrl, callback) {
        // サムネイル領域のサイズ
        var thumbAreaWidth = $('#draggable').width();
        var thumbAreaHeight = $('#draggable').height();
        var image = new Image();

        image.onload = function() {
            var w = image.width;
            var h = image.height;

            console.log('画像サイズ 高さ X 幅 : ' + image.height + 'X' + image.width);

            var sw = thumbAreaWidth / image.width;
            var sh = thumbAreaHeight / image.height;

            var scale = Math.max(sw, sh);
            rw = parseInt(image.width * scale);
            rh = parseInt(image.height * scale);

            // サムネイル作成
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');

            canvas.width = thumbAreaWidth;
            canvas.height = thumbAreaHeight;

            var ofsetX = 0;
            var ofsetY = 0;

            if (rw > thumbAreaWidth) {
                ofsetX = parseInt(-((rw - thumbAreaWidth) / 2));
            }

            if (rh > thumbAreaHeight) {
                ofsetY = parseInt(-((rh - thumbAreaHeight) / 2));
            }

            ctx.drawImage(image, ofsetX, ofsetY, rw, rh);

            callback(canvas.toDataURL());


        }
        image.src = dataUrl;

    }
    </script>
</body>

</html>