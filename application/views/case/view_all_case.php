<title>全案件表示</title>
<script>
</script>
<body>
    <div id="main">
        <script>
            $(document).ready(function () {
                $("div#searchmenubox select").change(function () {
                    var statusFilterID = $('#dropdown_status option:selected').val();
                    var pdlFilterID = $('#dropdown_pdl option:selected').val();
                    var productFilterID = $('#dropdown_product option:selected').val();
                    var workerFilterID = $('#dropdown_worker option:selected').val();
                    viewCase(statusFilterID, pdlFilterID, productFilterID, workerFilterID);
                });

                function viewCase(statusFilterID, pdlFilterID, productFilterID, workerFilterID) {
                    $.ajax({
                        type: 'post',
                        url: '<?= base_url() . "CaseController/ViewFilteredCase/" ?>',
                        data: {statusFilterID: statusFilterID, pdlFilterID: pdlFilterID, productFilterID: productFilterID, workerFilterID: workerFilterID},
                        cache: false,
                        success: function (html) {
                            alert(html);
                            $('#hogehoge').html(html);
                        }
                    });
                }
            });
        </script>
        <script>
            $(function () {
                $('#searchbox').quicksearch('ul#caseList li.dataRow', {
                    'delay': 300,
                    'noResults': 'li#noresults',
                    'loader': 'span.loading'
                });
            });

        </script>
        <div id="submain">
            <?= form_open('CaseController/SearchCase/'); ?>
            <?= $searchBoxView ?>
            <ul id="caseList">
                <li class="titleRow">
                    <div>
                        <table id="caseTable">
                            <tbody>
                                <tr class="caseTitleRow">
                                    <td id="status">ステイタス</td>
                                    <td id="product">対象機種</td>
                                    <td id="pdl">対象PDL</td>
                                    <td id="os">対象OS</td>
                                    <td id="csw">CSW</td>
                                    <td id="sut">SUT</td>
                                    <td id="whql">WHQL</td>
                                    <td id="worker">担当者</td>
                                    <td id="regdate">登録日</td>
                                    <td id="findate">完了日</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
                <div id="hogehoge">
                    <?= $caseViewList ?>
                </div>
                <li id="noresults" style="list-style: none"><strong>該当する案件が見つかりませんでした。</strong></li>
            </ul>
        </div>
    </div>