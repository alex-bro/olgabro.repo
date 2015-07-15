<?php if($data){
    foreach($data as $items) {
        ?>
        <div class="portfolio">
            <a href="<?php echo $items['link']?>.jpg">
                <div class="portfolioImg">
                    <img src="<?php echo $items['link']?>.png"
                         alt="<?php echo $items['type']?> <?php echo $items['name']?>">
                </div>
                <div class="portfolioText">
                    <div class="portfolioType">
                        <?php echo $items['type']?>
                    </div>
                    <div class="portfolioName">
                        <?php echo $items['name']?>
                    </div>

                </div>
            </a>
        </div>
    <?php
    }
}
?>