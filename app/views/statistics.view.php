<?php $this->view("header",["page_title"=>$page_title]); ?>
    <!-- Start Detalils Section -->


    <section class=" details container" style="height: fit-content">


        <div class="items">


            <span>Number Of Items :</span>
            <?php if($statistics && isset($statistics[0]->numberOfItems)): ?>
                <span><?= (int)$statistics[0]->numberOfItems?> items</span>
            <?php else: ?>
                <span>0 item</span>
            <?php endif; ?>


        </div>
        <!-- modification -->
        <div class="items">


            <span>Number Of Requests Made:</span>
            <?php if($statistics && isset($statistics[0]->numberOfRequest)): ?>
                <span><?= (int)$statistics[0]->numberOfRequest?> Request</span>
            <?php else: ?>
                <span>0 Request</span>
            <?php endif; ?>


        </div>

        <div class="results">

            <div class="result-box">

                <div class="result-name">

                    Cache Utilization
                    <div class="before"></div>

                </div>

                <div class="result-progress">

                    <?php if($statistics && isset($statistics[0]->total_size)): ?>

                        <span data-progress="<?=getSizeUtilize($statistics[0]->total_size) ?>%"></span>
                    <?php else: ?>
                        <span data-progress="0%"></span>
                    <?php endif; ?>

                </div>

            </div>


            <div class="result-box">

                <div class="result-name">
                    Hit Rate
                    <div class="before"></div>
                </div>
                <div class="result-progress">
                    <?php if($statistics && isset($statistics[0]->hit_rate)): ?>
                        <span data-progress="<?=(int)$statistics[0]->hit_rate ?>%"></span>
                    <?php else: ?>
                        <span data-progress="0%"></span>
                    <?php endif; ?>
                </div>

            </div>


            <div class="result-box">

                <div class="result-name">
                    Miss Rate
                    <div class="before"></div>
                </div>
                <div class="result-progress">
                    <?php if($statistics && isset($statistics[0]->miss_rate)): ?>
                        <span data-progress="<?=(int)$statistics[0]->miss_rate ?>%"></span>
                    <?php else: ?>
                        <span data-progress="0%"></span>
                    <?php endif; ?>
                </div>

            </div>


        </div>


    </section>


    <!-- End Detalils Section -->
<?php $this->view("footer"); ?>