<?php $this->view("header",["page_title"=>$page_title]) ?>
    <section class="config container">

        <form method="POST">


            <div class="config-cache">

                <label for="cache-capcity">Cache Capcity :</label>

                <div>

                    <input class="slider" type="range" value="<?= $row ? $row->capacity : 1 ?>" name="capacity" max="4" min="1" step="0.01"
                           id="cache-capcity" oninput="slider_value()">

                    <span id="value"><?= $row ? $row->capacity : 1?> MB</span>

                </div>


            </div>

            <div class="policy">

                <p>Please choose one of the following replacement policies:</p>


                <div class="radio">

                    <input type="radio" <?php if($row && $row->policy == "random"){ echo "checked";}else{echo "";} ?> id="choice-one" name="policy"  value="random">
                    <label class="iii"  for="choice-one"> Random Replacement</label>

                </div>

                <div class="radio">

                    <input type="radio" <?php if($row && $row->policy == "LRU"){ echo "checked";}else{echo "";} ?> id="choice-two" name="policy" value="LRU">
                    <label for="choice-two">Least Recently Used</label>

                </div>

            </div>



            <div class="separator sep">


                <button class="btn " type="submit">Ok</button>
                <button class="btn" name="clear" type="submit" id="reset">Clear Cache</button>


            </div>





        </form>

        <!-- <div class="icon">

            <img src="<?= ASSETS ?>logo/Settings.png" alt="">

        </div> -->





    </section>


    <!-- End Configration Section -->
<?php $this->view("footer") ?>