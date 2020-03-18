    <?php
    include_once("include/header.php");
    include_once("include/asidebar.php");
    ?>
    <article class="col-md-9 col-lg-9 ">
        <ol class="breadcrumb">
            <li><a href="index.php">الرئيسيه</a></li>
            <li><a href="#">عنوان القسم </a></li>

            <li class="active"> عنوان المقال</li>
        </ol>
        <div class="col-lg-12 art_bg">
            <div class="post-1">
                <h2 class="post-h2">عنوان المقال</h2>
                <div class="col-md-12">
                    <h2 class="post-h2">عنوان المقال</h2>
                    <img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" alt="" width="100%">
                </div>

                <div class="col-md-12">
                    <p class=" pull-right" style="margin: 10px 0px;background-color: #eae6e2"><i class="fas  fa-user-edit"></i> الكاتب<a href="profile.php"> | جلال</a> </p>
                    <p class=" pull-left" style="margin: 10px 0px;background-color: #eae6e2"> 21-8-2019 <i class="far fa-clock"></i></p>

                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde recusandae quia voluptatibus cupiditate placeat amet labore, velit quis itaque vitae ipsa explicabo eos, dolores, ullam exercitationem possimus at error ratione?</p>
                </div>
                <div class="col-md-12">
                    <hr style="margin-buttom:8px; margin-top:0px">



                </div>
                <div class="clearfix"></div>

            </div>
            <!-- التعليقات -->
            <div class="col-lg-12 art_bg" style="margin-top:10px">
                <div class="post-1">
                    <div class="col-md-2">
                        <img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" alt="" width="100%">
                    </div>
                    <div class="col-md-10">
                        <h2 class="post-h2"> <i class="fas fa-comments"></i> عنوان التعليق </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde recusandae quia voluptatibus cupiditate placeat amet labore, velit quis itaque vitae ipsa explicabo eos, dolores, ullam exercitationem possimus at error ratione?</p>
                    </div>
                    <div class="col-md-12">
                        <hr style="margin-buttom:8px; margin-top:0px">

                        <p class=" pull-right"><i class="fas  fa-user-edit"></i> تم التعليق بواسطه : <a href="profile.php">جلال</a> </p>
                        <p class=" pull-left"><i class="fas  fa-user-edit"></i> <i class="far fa-clock"></i> 21-8-2019 </p>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="post-1">
                    <div class="col-md-2">
                        <img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" alt="" width="100%">
                    </div>
                    <div class="col-md-10">
                        <h2 class="post-h2"> <i class="fas fa-comments"></i> عنوان التعليق </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde recusandae quia voluptatibus cupiditate placeat amet labore, velit quis itaque vitae ipsa explicabo eos, dolores, ullam exercitationem possimus at error ratione?</p>
                    </div>
                    <div class="col-md-12">
                        <hr style="margin-buttom:8px; margin-top:0px">

                        <p class=" pull-right"><i class="fas  fa-user-edit"></i> تم التعليق بواسطه : <a href="profile.php">جلال</a> </p>
                        <p class=" pull-left"><i class="fas  fa-user-edit"></i> <i class="far fa-clock"></i> 21-8-2019 </p>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="post-1">
                    <div class="col-md-2">
                        <img src="http://placehold.it/460x250/e67e22/ffffff&text=HTML5" alt="" width="100%">
                    </div>
                    <div class="col-md-10">
                        <h2 class="post-h2"> <i class="fas fa-comments"></i> عنوان التعليق </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde recusandae quia voluptatibus cupiditate placeat amet labore, velit quis itaque vitae ipsa explicabo eos, dolores, ullam exercitationem possimus at error ratione?</p>
                    </div>
                    <div class="col-md-12">
                        <hr style="margin-buttom:8px; margin-top:0px">

                        <p class=" pull-right"><i class="fas  fa-user-edit"></i> تم التعليق بواسطه : <a href="profile.php">جلال</a> </p>
                        <p class=" pull-left"><i class="fas  fa-user-edit"></i> <i class="far fa-clock"></i> 21-8-2019 </p>


                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 art_bg " style="padding-top:15px">
            <h1> <i class="fas fa-comment "></i> اضافه تعليق جديد </h1>
            <form class="form-horizontal">
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-2 control-label">عنوان التعليق</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"> التعليق</label>
                    <div class="col-sm-6">
                        <textarea type="password" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group">

                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"> اضافه تعليق </button>
                    </div>
                </div>
            </form>
        </div>
    </article>
    <?php
    include_once("include/footer.php");
    ?>