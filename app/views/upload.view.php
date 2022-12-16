<?php $this->view("header",["page_title"=>$page_title]); ?>

        <!-- Start Landing -->
            <?php if(isset($success) && $success != ""):?>
            <div class="suc">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg"><?= $success ?></span>
            </div>
            <?php endif; ?>
            <?php if(!empty($messages)): ?>
                <div class="alert">
                    <span class="fas fa-exclamation-circle"></span>
                    <span class="msg"><?= reset($messages) ?></span>
                </div>
            <?php endif; ?>

        <section class="landing container d-flex">

            <form method="POST" enctype="multipart/form-data">



                <div>

                    <label for="key">Key</label>
                    <input type="text" id="key" name="key" placeholder="Enter Your Key">

                </div>


                <div class="second">
                    <label for="img" class="i-lable">Upload Image</label>
                    <input type="file" id="img" name="img" placeholder="Enter Your image" accept="image/*">
                </div>

                <div class="separator">
                    <button type="submit" class="btn submit">Ok</button>
                </div>



            </form>


<!-- 
            <div class="image">

                <img src="<?= ASSETS ?>logo/upload.png" alt="">
            </div> -->


        </section>

        <!-- End Landing -->

<?php $this->view("footer"); ?>