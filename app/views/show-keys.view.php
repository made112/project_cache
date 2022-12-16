<?php $this->view("header",["page_title"=>$page_title]); ?>
        <!-- Start Show-Keys Section -->

        <section class="keys container">


            <h2 class="main-title">All Keys</h2>



            <?php if(!empty($keys)): ?>
                <div class="dd">
                <?php foreach ($keys as $key): ?>
                    <div>
                        <span>
                            <a href="<?=ROOT?>show_images/<?=$key->key_value?>">
                                <?= $key->key_value ?>
                            </a>
                        </span>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div role="alert">
                    <strong>No Keys in the System to display.</strong>
                </div>
            <?php endif; ?>

        </section>

        <!-- End Show-Keys Section -->

<?php $this->view("footer"); ?>