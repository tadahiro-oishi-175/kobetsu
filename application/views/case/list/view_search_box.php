<div id ="searchmenubox">
    <div id="quickfilter">
        <span>クイックフィルター</span><?= form_input('', '', 'id="searchbox" placeholder="キーワードを入力 (例： 案件番号、案件名、顧客名、タグ等)"'); ?>
    </div>
    <div>
        <div id="searchmenubox1">
            <div>条件で絞り込む</div>
            <table>
                <tr><th>ステイタス</th><td><?= form_dropdown('StatusFilter', $stasus, '', 'id="dropdown_status"') ?></td><th>対象機種</th><td><?= form_dropdown('ProductFilter', $products, '', 'id="dropdown_product"') ?></td></tr>
                <tr><th>担当者</th><td><?= form_dropdown('WorkerFilter', $workers, '', 'id="dropdown_worker"') ?></td><th>対象PDL</th><td><?= form_dropdown('PDLFilter', $pdls, '', 'id="dropdown_pdl"') ?></td></tr>
            </table>
        </div>
        <div id="searchmenubox2">
            <div>日付で絞り込む</div>
            <table>
                <tr><th>登録日</th><td><?= form_input('RegDate', '', 'id="regDate"') ?><?= form_dropdown('', $stasus) ?></td></tr>
                <tr><th>完了日</th><td><?= form_input('FinDate', '', 'id="finDate"') ?><?= form_dropdown('', $workers) ?></td></tr>
            </table>
        </div>

    </div>
</div>