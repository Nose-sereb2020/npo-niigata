<?php 
if (isset($_POST["thumb_name"])) {
    
    $dir_name = "uploads";

    $thumb_name = $_POST["thumb_name"];

    $base_file_name = str_replace("_thumb", "", $thumb_name);

    $save_path = $dir_name . "/";

    // サムネイル生成関数の呼び出し
    $thumb_name = makethumb($save_path, $base_file_name, $_POST["width"], $_POST["height"]);

    $stamp = time();

    // HTMLを出力
    //?以降はキャッシュ対策
    print "<img src='" . $thumb_name . "?$stamp'>";

}


function makethumb($path, $file, $width, $height){
    // イメージサイズ取得
    $imgarray = getimagesize($path . $file);
    $srcwidth = $imgarray[0];
    $srcheight = $imgarray[1];

    // 縦横の元画像に対する比率をセット
    $scaleX = $width / $srcwidth;
    $scaleY = $height / $srcheight;

    if($scaleX >= $scaleY){
        $scale = $scaleX;
    }else {
        $scale = $scaleY;
    }

    // 拡張子チェック
    // $info = new SqlFileInfo($file);

    // ファイル情報取得
    $path_parts = pathinfo($path . $file);
    
    // ビットマップイメージを生成(拡張子別)
    if ($path_parts['extension'] == "jpg" || $path_parts['extension'] == "JPG") {
        $srcimgfile = imagecreatefromjpeg($path . $file);
    }elseif ($path_parts['extension'] == "png" || $path_parts['extension'] == "PNG") {
        $srcimgfile = imagecreatefrompng($path . $file);
    }else {
         return;
    }

    // ビットマップイメージのスケールダウンサイズを指定
    $newwidth = $srcwidth * $scale;
    $newheight = $srcheight * $scale;

    // スケールダウン用キャンバス生成
    $newimgfile = imagecreatetruecolor($newwidth, $newheight);

    // ブレンドモードを無効にする
    imagealphablending($newimgfile, false);

    // 完全なアルファチャネル情報を保存するフラグをonにする（透過を可能にする設定）
    imagesavealpha($newimgfile, true);

    // スケールダウンイメージ生成
    imagecopyresampled($newimgfile, $srcimgfile, 0, 0, 0, 0, $newwidth, $newheight, $srcwidth, $srcheight);

    // サムネイル用キャンバスを生成
    $thumbimg = imagecreatetruecolor($width, $height);

    // ブレンドモードを無効にする
    imagealphablending($newimgfile, false);

    // 完全なアルファチャネル情報を保存するフラグをonにする（透過を可能にする設定）
    imagesavealpha($newimgfile, true);

    // サイズに合わせてトリミング
    $ofsetX = ($newwidth - $width) / 2;
    $ofsetY = ($newheight - $height) / 2;
    imagecopy($thumbimg, $newimgfile, 0, 0, $ofsetX, $ofsetY, $width, $height);

    // 生成したサムネイルの書き出し
    if ($path_parts['extension'] == "jpg" || $path_parts['extension'] == "JPG") {
        // ファイル名生成
        $savename = $path . $path_parts['filename'] . "_thumb.jpg";
        // ファイルが存在している場合は削除
        if (file_exists($savename)) {
            unlink($savename);
        }
        // 生成したビットマップをjpgで保存
        imagejpeg($thumbimg, $savename);
    }

    if ($path_parts['extension'] == "png" || $path_parts['extension'] == "PNG") {
        // ファイル名生成
        $savename = $path . $path_parts['filename'] . "_thumb.png";
        // ファイルが存在している場合は削除
        if (file_exists($savename)) {
            unlink($savename);
        }
        // 生成したビットマップをpngで保存
        imagepng($thumbimg, $savename);
    }
    
    // 一時ファイルの削除
    // メモリの消費を防ぐ
    imagedestroy($srcimgfile);
    imagedestroy($newimgfile);
    imagedestroy($thumbimg);

    // 生成したファイル名を戻す
    return $savename;

}


?>