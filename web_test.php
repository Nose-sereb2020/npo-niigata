<?php
include_once 'head.php';

?>

<?php print makeHeader("ページタイトル"); ?>
<link rel="stylesheet" href="custom.css">

</head>

<body class="bg-dark p-0">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <a class="navbar-brand" href="#">Sample site</a>
            <button class="navbar-toggler b" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">ホーム <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">リンク1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">リンク2</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            メニュー
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-light" href="#">製品案内</a>
                            <a class="dropdown-item text-light" href="#">会社案内 </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-light" href="#">問い合わせ</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light disabled" href="#">無効なサンプル</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section id="top_img">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/lake_for_web_php.jpg" class="w-100" alt="" srcset="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide1</h5>
                        <p>Description</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/paris_for_web_php.jpg" class="w-100" alt="" srcset="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide2</h5>
                        <p>Description</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/tree_for_web_php.jpg" class="w-100" alt="" srcset="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide3</h5>
                        <p>Description</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5"></div>
                <div class="col-md-12 mt-5">
                    <h1 class="text-md-center lt2 p-3" style="color: black;">
                        Catchy copy
                    </h1>
                    <p class="lh5 lt1 mt-4 mx-5 px-3 " style="color: black;">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque, hic quae exercitationem dolore
                        dicta repudiandae excepturi officia numquam unde velit consequatur, fuga pariatur. Labore
                        reprehenderit eum omnis, enim commodi voluptatem!
                    </p>
                </div>

                <div class="col-md-12 mt-5"></div>
                <div class="col-md-4 mt-3 px-3">
                    <div class="p-0 border-light border rounded">

                        <p>
                            <img src="images/polynesia_for _web_php.jpg" class="w-100 show_img" title="Polynesia" alt=""
                                srcset="">
                        </p>
                        <h5 class="px-2 text-light" >Title1</h5>
                        <p class="px-2 text-light">
                            Description
                        </p>
                        <p class="text-center"><button type="button" class="btn btn-outline-light"> Show details
                            </button></p>
                    </div>
                </div>
                <div class="col-md-4 mt-3 px-3">
                    <div class="p-0 border-light border rounded">

                        <p>
                            <img src="images/train_for_web_php.jpg" class="w-100 show_img" title="Train" alt=""
                                srcset="">
                        </p>
                        <h5 class="px-2 text-light">Title2</h5>
                        <p class="px-2 text-light">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. In corporis possimus nisi quam
                            necessitatibus, repellendus error ipsum deserunt labore cumque repellat nihil deleniti
                            minima vel ad, iure repudiandae quis quibusdam.
                        </p>
                        <p class="text-center"><button type="button" class="btn btn-outline-light"> Show details
                            </button></p>
                    </div>

                </div>
                <div class="col-md-4 mt-3 px-3">
                    <div class="p-0 border-light border rounded">

                        <p>
                            <img src="images/waterfall_for_web_php.jpg" class="w-100 show_img" title="Waterfall" alt=""
                                srcset="">
                        </p>
                        <h5 class="px-2 text-light">Title3</h5>
                        <p class="px-2 text-light">
                            Description
                        </p>
                        <p class="text-center"><button type="button" class="btn btn-outline-light"> Show details
                            </button></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="sub" class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-3 bg-transparent">
                    <div class="card h-100 bg-transparent boder border-light">
                        <img src="images/red_lady_for_web_php.jpg" class="w-100" alt="" srcset="">
                        <div class="card-body bg-transparent">
                            <h5 class="card-title text-light">Title</h5>
                            <p class="card-text text-light">Description</p>
                        </div>
                        <div class="text-center bg-transparent border-top-0 card-footer">
                            <a href="#" class="btn btn-outline-light">Show details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-3 bg-transparent">
                    <div class="card h-100 bg-transparent boder border-light">
                        <img src="images/red_bicycle_for_web_php.jpg" class="w-100" alt="" srcset="">
                        <div class="card-body bg-transparent">
                            <h5 class="card-title text-light">Title</h5>
                            <p class="card-text text-light">Description</p>
                        </div>
                        <div class="text-center bg-transparent border-top-0 card-footer">
                            <a href="#" class="btn btn-outline-light">Show details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-3 bg-transparent">
                    <div class="card h-100 bg-transparent boder border-light">
                        <img src="images/red_heart_for_web_php.jpg" class="w-100" alt="" srcset="">
                        <div class="card-body bg-transparent">
                            <h5 class="card-title text-light">Title</h5>
                            <p class="card-text text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Dignissimos, voluptas? Eaque tenetur ipsam architecto maxime, aliquid itaque voluptatum,
                                illo obcaecati facere, et quam sequi asperiores optio ratione totam necessitatibus
                                aliquam?</p>
                        </div>
                        <div class="text-center bg-transparent border-top-0 card-footer">
                            <a href="#" class="btn btn-outline-light">Show details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-3 bg-transparent">
                    <div class="card h-100 bg-transparent boder border-light">
                        <img src="images/red_maple_for_web_php.jpg" class="w-100" alt="" srcset="">
                        <div class="card-body bg-transparent">
                            <h5 class="card-title text-light">Title</h5>
                            <p class="card-text text-light">Description</p>
                        </div>
                        <div class="text-center bg-transparent border-top-0 card-footer">
                            <a href="#" class="btn btn-outline-light">Show details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModal" style="display: none;"
        id="show_m_btn">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php print makeFooter("NPO-PC");?>
    <script>
    $('.carousel').carousel({
        interval: 2000
    });

    $('.show_img').on("click", function(e) {
        $('#modal_body').html("");
        $('#exampleModalLabel').html($(this).attr("title"));
        $(this).clone().appendTo('#modal_body');
        $('#show_m_btn').trigger("click");

    });
    </script>
</body>

</html>