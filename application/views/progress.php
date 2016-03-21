<script>
    $(document).ready(function () {
        //$("li:has(a)").addClass('done');
        $("li:has(a[href*='Detail'])").addClass('done');
        $("li:has(a[href*='Add'])").addClass('next');
        $("li:has(strong)").addClass('current');
    });
</script>

<ol class="track-progress" data-steps="5">
    <li>
        <span><?= $case_title ?></span>
        <i></i>
    </li><!--
    --><li>
        <span><?= $req_title ?></span>
        <i></i>
    </li><!--
    --><li>
        <span><?= $spec_title ?></span>
    </li><!--
    --><li>
        <span><?= $dev_title ?></span>
        <i></i>
    </li><!--
    --><li>
        <span>5. リリース</span>
        <i></i>
    </li>
</ol>