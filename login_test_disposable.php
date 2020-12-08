<?php
include_once 'head.php';
include_once 'login_db_operation.php';
$error = "";
$record_id = array();
$user_id = array();
$user_pass = array();
$save_date = array();

if (isset($_POST['del_id'])) {
    user_delete_data($_POST['del_id']);
}

// print_r($_POST);
if (isset($_POST['l_id'])) {
    $u_id = $_POST['l_id'];
    $u_pass = $_POST['l_pass'];
    
    if (strlen($u_id) < 6) {
        $error = "ログインIDの文字数がたりません";
    }else {
        if (strlen($u_pass ) < 6) {
            $error = "パスワードの文字数がたりません";
        }else {
                $passwd = makePassword($u_pass);
                // print $passwd;
                $date = date("Y-m-d");
                // print $date;
                $spl = "SELECT id FROM user_data WHERE user_id='$u_id';";
                $rst = $pdo->query($spl);
                if ($row = $rst->fetch(PDO::FETCH_ASSOC)) {
                    $error = "入力されたIDは既に登録されています";
                }else{
                    $set_id = user_add_data($u_id,  $passwd,  $date);
                    if ($set_id > 0) {
                        $error = "ID{$set_id}に登録されました";
                    }else{
                        $error = "登録できませんでした";
                    }
                }
        }
    }
}


$rst = user_getDataAll();

while($row = $rst->fetch(PDO::FETCH_ASSOC)){
    $record_id[] = $row['id'];
    $user_id[] = $row['user_id'];
    $user_pass[] = $row['password'];
    $save_date[] = $row['save_date'];
    // print_r($record_id);
    // print_r($user_id);
    // print_r($user_pass);
    // print_r($save_date);
}


$table = "<table class='table'>";
$table .="<tr><td>id</td><td>ログインID</td><td>パスワード</td><td>登録日</td><td>管理</td></tr>";


for ($i=0; $i < count($record_id); $i++) { 
    $table .="<tr>";
    $table .="<td>" . $record_id[$i] . "</td>";
    $table .="<td>" . $user_id[$i] . "</td>";
    $table .="<td>" . $user_pass[$i] . "</td>";
    $table .="<td>" . $save_date[$i] . "</td>";
    $table .="<td>";
    $table .="<button type='button' class='save_btn btn btn-sm btn-outline-secondary' data-id='$record_id[$i]'>編集</button>&nbsp;";
    $table .="<button type='button' class='delete_btn btn btn-sm btn-outline-danger' data-id='$record_id[$i]'>削除</button>";
    $table .="</td>";
    $table .="</tr>";
}

$table .= "</table>";

if (isset($_POST['del_id'])) {
    print $table;
    return;
}




?>

<?php print makeHeader("ページタイトル"); ?>

</head>

<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-center">
                <h3>ログイン新規登録・削除</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto border rounded p-4">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="l_id" class="col-sm-3 col-form-label">ログインID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="l_id" name="l_id" placeholder="6文字以上">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="l_pass" class="col-sm-3 col-form-label">パスワード</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="l_pass" name="l_pass" placeholder="6文字以上">
                        </div>
                        <div class="col-sm-3">
                            <input type="button" class="btn btn-sm btn-outline-info form-control" id="p_show"
                                value="表示">
                        </div>
                    </div>
                    <p class="text-center">
                        <input type="submit" class="btn btn-sm btn-primary" value="登録">
                        <input type="reset" class="btn btn-sm btn-secondary" value="リセット">
                    </p>
                </form>
            </div>

        </div>
    </div>
    <hr>
    </div>
    <p id="error" class="text-danger text-center"><?php print $error;?></p>
    <div class="container">

        <div class="col-12 text-center py-4">
            <h3>登録リスト</h3>
        </div>
        <div class="col-12" id="update_table">
            <?php print $table;?>
        </div>
    </div>
    <?php print makeFooter("NPO-PC");?>
    <script>
    $('#p_show').on('click', function(e) {
        var val = $(this).val();
        if (val == "表示") {
            $(this).val("隠す");
            $('#l_pass').attr("type", "text");
        } else {
            $(this).val("表示");
            $('#l_pass').attr("type", "password");
        }

    });

    $('.delete_btn').on('click', function(e) {
        var del_id = $(this).data('id');
        console.log(del_id);
        document.body.style.cursor = "wait";

        // Formdata オブジェクトを用意
        var fd = new FormData();
        fd.append("del_id", del_id);
        $.ajax({
            url: "",
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
            $("#update_table").html("");
            $("#update_table").html(res);
        });

    })
    </script>
</body>

</html>