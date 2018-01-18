
<!-- ---------------------------section------------------------- -->
<div class="faq">
    <div class="container">

        <div class="row">

            <div class="col-sm-12">
                <div class="fq-txt">
                    <h4><?php if ($faq->title) {
    echo $faq->title;
} ?></h4></div>
            </div>

            <div class="col-sm-12">
<?php if ($faq->content) {
    echo $faq->content;
} ?>
            </div>
        </div>

    </div>
</div>
