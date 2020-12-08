<?php
$title = "フォームサンプル";

$u_name = "";
$u_post = "";
$u_address = "";
$u_seibetsu = "";
$u_tel = "";
$u_mail = "";
$u_comment = "";

if(isset($_POST["u_name"])){
    print_r($_POST);
    $u_name = $_POST["u_name"];
    $u_post = $_POST["u_post"];
    $u_address = $_POST["u_address"];
    $u_seibetsu = $_POST["u_seibetsu"];
    $u_tel = $_POST["u_tel"];
    $u_mail = $_POST["u_mail"];
    $u_comment = $_POST["u_comment"];

    return;
}

$radio = "";
if($u_seibetsu == "" || $u_seibetsu =="男性"){
    $radio .="<div class='form-check form-check-inline'>";
    $radio .="<input class='form-check-input' type='radio' name='u_seibetsu' id='u_seibetsu1' value='男性' checked/>";
    $radio .="<label class='form-check-label' for='u_seibetsu1'>男性</label>";
    $radio .="</div>";
    $radio .="<div class='form-check form-check-inline'>";
    $radio .="<input class='form-check-input' type='radio' name='u_seibetsu' id='u_seibetsu2' value='女性'/>";
    $radio .="<label class='form-check-label' for='u_seibetsu2'>女性</label>";
    $radio .="</div>";
}else{
    $radio .="<div class='form-check form-check-inline'>";
    $radio .="<input class='form-check-input' type='radio' name='u_seibetsu' id='u_seibetsu1' value='男性'/>";
    $radio .="<label class='form-check-label' for='u_seibetsu1'>男性</label>";
    $radio .="</div>";
    $radio .="<div class='form-check form-check-inline'>";
    $radio .="<input class='form-check-input' type='radio' name='u_seibetsu' id='u_seibetsu2' value='女性' checked/>";
    $radio .="<label class='form-check-label' for='u_seibetsu2'>女性</label>";
    $radio .="</div>";
}


?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link rel="stylesheet" href="jquery-ui/jquery-ui.css" />
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="jquery-ui/external/jquery/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.js"></script>
        <script src="bootstrap/js/yubinbango.js"></script>
        <script src="jquery-ui/jquery-ui.js"></script>
        <script src="jquery-ui/datepicker-ja.js"></script>

        <title><?php print $title; ?></title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h1 class="text-center"><?php print $title; ?></h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6 mx-auto">
                    <div class="form-group">
                        <label for="u_name">名前</label>
                        <input
                            type="text"
                            class="form-control"
                            id="u_name"
                            value="<?php print $u_name;?>"
                            name="u_name"
                        />
                    </div>

                    <form class="h-adr">
                        <span class="p-country-name" style="display: none"
                            >Japan</span
                        >
                        <div class="form-group">
                            <label for="u_post">郵便番号</label>
                            <input
                                type="text"
                                class="form-control p-postal-code"
                                size="8"
                                maxlength="8"
                                id="u_post"
                                placeholder="123-4567"
                            />
                        </div>

                        <div class="form-group">
                            <label for="u_address">住所</label>
                            <input
                                type="text"
                                class="form-control p-region p-locality p-street-address"
                                id="u_address"
                                placeholder="住所を入力してください"
                            />
                            <!-- <input
                                type="text"
                                class="p-region"
                                readonly
                            /><br />
                            <input
                                type="text"
                                class="p-locality"
                                readonly
                            /><br />
                            <input type="text" class="p-street-address" /><br />
                            <input type="text" class="p-extended-address" /> -->
                        </div>
                    </form>

                    <div class="form-group">
                        <label for="u_tel">電話番号</label>
                        <input
                            type="text"
                            class="form-control"
                            id="u_tel"
                            value="<?php print $u_tel;?>"
                            name="u_tel"
                        />
                    </div>
                    <div class="form-group">
                        <label for="u_mail">メールアドレス</label>
                        <input
                            type="text"
                            class="form-control"
                            id="u_mail"
                            value="<?php print $u_mail;?>"
                            name="u_mail"
                        />
                    </div>
                    <?php print $radio; ?>
                    <!-- <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="u_seibetsu"
                                id="u_seibetsu1"
                                value="男性"
                            />
                            <label class="form-check-label" for="u_seibetsu1"
                                >男性</label
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="u_seibetsu"
                                id="u_seibetsu2"
                                value="女性"
                            />
                            <label class="form-check-label" for="u_seibetsu2"
                                >女性</label
                            >
                        </div> -->
                    <div class="form-group mt-2">
                        <label for="u_comment">お問い合わせ内容</label>
                        <textarea
                            class="form-control"
                            id="u_comment"
                            rows="3"
                            name="u_comment"
                        >
<?php print $u_comment?></textarea
                        >
                    </div>
                    <p class="text-center">
                        <button
                            type="button"
                            class="btn btn-primary"
                            id="save_bt"
                        >
                            送信
                        </button>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 text-center text-danger" id="report">

                    
</div>
        <footer>
            <div class="container-fluid mt-5">
                <div class="row border-top">
                    <div class="col-12 mt-3">
                        <p class="text-center text-secondary">
                            Copyright &copy; NPO-PC School
                        </p>
                    </div>
                </div>

            </div>
        </footer>
        <script>
            // var seibetsu = "<?php print $u_seibetsu;?>";
            // if (seibetsu == "" || seibetsu == "男性") {
            //     $("#u_seibetsu1").prop('checked', true);
            // } else {
            //     $("#u_seibetsu2").prop('checked', true);
            // }
            $("#save_bt").on("click", function (e) {
                console.log("succsess");

                document.body.style.cursor = "wait";

                var fd = new FormData();

                fd.append("u_name", $("#u_name").val());
                fd.append("u_post", $("#u_post").val());
                fd.append("u_address", $("#u_address").val());
                fd.append("u_tel", $("#u_tel").val());
                fd.append("u_mail", $("#u_mail").val());
                fd.append("u_comment", $("#u_comment").val());
                fd.append(
                    "u_seibetsu",
                    $('input[name="u_seibetsu"]:checked').val()
                );

                $.ajax({
                    url: "",
                    type: "POST",
                    data: fd,
                    mode: "multiple",
                    processData: false,
                    contentType: false,
                    timeout: 10000,
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        err =
                            XMLHttpRequest.status +
                            "\n" +
                            XMLHttpRequest.statusText;
                        alert(err);
                        document.body.style.cursor = "auto";
                    },
                    beforeSend: function (xhr) {

                    },
                }).done(function (res) {
                    document.body.style.cursor = "auto";
                    $("#report").html(res);
                });
            });
        </script>
    </body>
</html>
