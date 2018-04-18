<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="crawler-tool">
    <div class="content">
        <h1>Web Crawler</h1>
        <form action="<?php echo e(url('crawlersite')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

            URL : <input name="entrypoint" size="35" placeholder="http://www.subinsb.com"/>
            <input type="submit" name="submit" value="Start Crawling"/>
        </form>
        <br/>
        <b>The URL's you submit for crawling are recorded.</b><br/>See All Crawled URL's <a href="url-crawled.html">here</a>.
        <?php
        if(!empty($urls)) {
            echo "Url";
        }
        ?>
        <script src="<?php echo e(asset('js/admin/website-crawler.js')); ?>"></script>
    </div>
</main>
