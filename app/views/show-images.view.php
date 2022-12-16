<?php $this->view("header",["page_title"=>$page_title]); ?>

        <!-- Start Show-Images Section -->
        <?php if(!empty($messages)): ?>
            <div class="alert">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg"><?= reset($messages) ?></span>
            </div>
        <?php endif; ?>
        <?php if(isset($status) && $status == "Cache Miss"
            && $error == null && !isset($messages["key"])): ?>
            <div class="alert">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg"><?= $status ?></span>
            </div>
        <?php elseif(isset($status) && $status == "Cache Hit"): ?>
            <div class="suc">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg"><?= $status ?></span>
            </div>
        <?php elseif(isset($error)): ?>
        <div class="alert">
            <span class="fas fa-exclamation-circle"></span>
            <span class="msg"><?= $error ?></span>
        </div>
        <?php endif; ?>
        <section class="landing display-img container ">

            <form method="POST">



                <div>

                    <label for="key">Key</label>
                    <input value="<?= $key ?>" type="text" id="key" name="key" placeholder="Enter Your Key">

                </div>



                <div class="separator">
                    <button type="submit" class="btn submit">Ok</button>
                </div>



            </form>



            <div class="image  show-img">
                <?php  if(isset($keyAndImage["cacheStatus"]) && $keyAndImage["cacheStatus"] == "hit"):
                        $_SESSION["image"] = $keyAndImage["image"];
                    ?>
                    <img src="<?= ROOT ?>show_image.php" class="" alt="">
                <?php else: ?>
                    <img src="<?= display_image($keyAndImage,$key) ?>" class="" alt="">
                <?php endif; ?>
            </div>



        </section>

        <!-- End Show-Images Section -->
<?php $this->view("footer"); ?>

