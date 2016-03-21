<link href="<?= base_url() ?>application/css/agreedoc.css" rel="stylesheet" type="text/css"/>
<script src="<?= base_url(); ?>application/js/jQuery.jPrintArea.js" type="text/javascript" charset="utf-8"></script>
<title>個別対応確認書プレビュー</title>

<script>
    $(function () {
        $('#btn_print').click(function () {
            $.jPrintArea("#printContent");
        });
    });
</script>
<?= form_open("SpecController/EditAgreeDoc/$specObj->SpecID") ?>
<?= form_submit('editAgreeDoc', '部分修正', 'class="notPrint"') ?>
<input type="button" value="印刷" class="notPrint" id="btn_print"/>
<?= form_close() ?>
<article id="printContent">
    <div id="documentContent">
        <h2>個別対応ドライバリリース確認書</h2>
        <div style="text-align: right;">
            <p>No. CDD-SpecialRel-<?= $caseObj->CaseSeqNo ?></p>
            <p>コントローラ開発本部 CTPF第3開発部</p>
            <p><?= mdate("%Y年%m月%d日") ?></p>
        </div>
        <p>本個別対応の実施にあたって以下の記載内容に対して同意いただける場合は、文末の同意欄の項目に<u>直筆署名</u>を記入いただき、<u>DWでスキャンした文書</u>を返送いただけますようお願い致します。</p>

        <br>
        <p style="text-align: center">--- 記 ---</p>

        <ol type="1">
            <li>
                <p>案件名</p>
                <p><?= $title ?></p>
            </li>
            <br>
            <li>
                <p>個別対応の内容</p>
                <ol type="square">
                    <li><p>対応内容:</p>
                        <blockquote>
                            <p><?= $specObj->SpecDetail ?></p>
                        </blockquote>
                    </li>

                    <li><p>対象OS:</p>
                        <blockquote>
                            <p>本個別対応ドライバは以下の○印のOSに対応します。</p>
                            <table>
                                <tr><th><?= in_array('Win2000_1', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows 2000</td><th><?= in_array('Win2000_1', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows 2000</td></tr>
                                <tr><th><?= in_array('WinXP_1', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows XP(32bit版)</td><th><?= in_array('WinXP_1', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows XP(32bit版)</td></tr>
                                <tr><th><?= in_array('Srv2003_1', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows Server 2003(32bit版)</td><th><?= in_array('Srv2003_1', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows Server 2003(32bit版)</td></tr>
                                <tr><th><?= in_array('WinVista_1', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows Vista(32bit版)</td><th><?= in_array('WinVista_1', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows Vista(32bit版)</td></tr>
                                <tr><th><?= in_array('Srv2008_1', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows Server 2008(32bit版)</td><th><?= in_array('Srv2008_1', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows Server 2008(32bit版)</td></tr>
                                <tr><th><?= in_array('Win7_1', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows 7(32bit版)</td><th><?= in_array('Win7_1', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows 7(32bit版)</td></tr>
                                <tr><th><?= in_array('Win8_1', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows 8(32bit版)</td><th><?= in_array('Win8_1', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows 8(32bit版)</td></tr>
                                <tr><th><?= in_array('Win8.1_1', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows 8.1(32bit版)</td><th><?= in_array('Win8.1_1', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows 8.1(32bit版)</td></tr>
                                <tr><th><?= in_array('Win10_1', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows 10(32bit版)</td><th><?= in_array('Win10_1', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows 10(32bit版)</td></tr>
                                <tr><th><?= in_array('WinXP_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows XP(64bit版)</td><th><?= in_array('WinXP_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows XP(64bit版)</td></tr>
                                <tr><th><?= in_array('Srv2003R2_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows Server 2003 R2(64bit版)</td><th><?= in_array('Srv2003R2_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows Server 2003 R2(64bit版)</td></tr>
                                <tr><th><?= in_array('WinVista_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows Vista(64bit版)</td><th><?= in_array('WinVista_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows Vista(64bit版)</td></tr>
                                <tr><th><?= in_array('Srv2008R2_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows Server 2008 R2(64bit版)</td><th><?= in_array('Srv2008R2_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows Server 2008 R2(64bit版)</td></tr>
                                <tr><th><?= in_array('Win7_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows 7(64bit版)</td><th><?= in_array('Win7_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows 7(64bit版)</td></tr>
                                <tr><th><?= in_array('Win8_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows 8(64bit版)</td><th><?= in_array('Win8_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows 8(64bit版)</td></tr>
                                <tr><th><?= in_array('Win8.1_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows 8.1(64bit版)</td><th><?= in_array('Win8.1_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows 8.1(64bit版)</td></tr>
                                <tr><th><?= in_array('Win10_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows 10(64bit版)</td><th><?= in_array('Win10_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows 10(64bit版)</td></tr>
                                <tr><th><?= in_array('Srv2012_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows Server 2012(64bit版)</td><th><?= in_array('Srv2012_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows Server 2012(64bit版)</td></tr>
                                <tr><th><?= in_array('Srv2012R2_2', $supportedOSName) && in_array('JPN', $supportedLangName) ? '○' : '' ?></th><td>日本語版Windows Server 2012 R2(64bit版)</td><th><?= in_array('Srv2012R2_2', $supportedOSName) && in_array('ENG', $supportedLangName) ? '○' : '' ?></th><td>英語版Windows Server 2012 R2(64bit版)</td></tr>
                            </table>
                        </blockquote>
                    </li>
                </ol>
            </li>
            <br>
            <li><p>対象ドライバー</p>
                <blockquote>
                    <p>本個別対応ドライバは以下のドライバーモデルを代替するものです。</p>
                </blockquote>
            </li>
            <br>
            <li><p>提供形態</p>
                <blockquote>
                    <p><?= isset($specObj->deliverType)&&$specObj->deliverType ? $specObj->deliverType : '自己解凍exe形式' ?></p>
                </blockquote>
            </li>
            <br>
            <li><p>仕様制限事項</p>
                <blockquote>
                    <p>本個別対応ドライバーには以下の○印の仕様制限項目があります。</p>
                </blockquote>
                <table id="limitationTable">
                    <tr style="display: block;">
                        <th><?= $specObj->SpecCSW ? '' : '○' ?></th>
                        <td>インストーラーの使用不可　(“プリンターの追加”によりインストールすること)。</td>
                    </tr>
                    <tr style="display: block;">
                        <th><?= isset($specObj->PlugandPlayInstall) ? $specObj->PlugandPlayInstall : '○' ?></th>
                        <td>Plug&Playインストール不可。</td>
                    </tr>
                    <tr style="display: block;">
                        <th><?= isset($specObj->SupportVersionUp) ? $specObj->SupportVersionUp : '○' ?></th>
                        <td>既存ドライバーからのバージョンアップはサポートしない。</td>
                    </tr>
                    <tr style="display: block;">
                        <th><?= isset($specObj->SupportKyouzon) ? $specObj->SupportKyouzon : '○' ?></th>
                        <td>本個別版ドライバー以外の市場導入版/個別版ドライバーとの共存は不可とする。</td>
                    </tr>
                    <tr style="display: block;">
                        <th><?= isset($specObj->SupportExclusive) ? $specObj->SupportExclusive : '○' ?></th>
                        <td>共有プリンターと追加ドライバー(もしくは代替ドライバー)の両者を使用する場合、一方に市場導入版ドライバーを使用し他方に個別版ドライバーを使用することはできない。</td>
                    </tr>
                    <tr style="display: block;">
                        <th><?= isset($specObj->HasDifference) ? $specObj->HasDifference : '○' ?></th>
                        <td>本個別ドライバーと市場導入版ドライバーの間に機能差がある場合がある。</td>
                    </tr>
                    <tr style="display: block;">
                        <th><?= isset($specObj->SupportNewFuncHelp) ? $specObj->SupportNewFuncHelp : '○' ?></th>
                        <td>UIに新たなコントロール(コンボボックス等)が追加された場合は、そのコントロールに対するヘルプは追加されない。</td>
                    </tr>
                    <tr style="display: <?= (isset($specObj->NewLimitation1) && $specObj->NewLimitation1) ? 'block' : 'none' ?>">
                        <th><?= isset($specObj->NewLimitation1) && $specObj->NewLimitation1 ? '○' : '' ?></th>
                        <td><?= isset($specObj->NewLimitation1) ? $specObj->NewLimitation1 : '' ?></td>
                    </tr>
                </table>
            </li>
            <br>
            <li><p>対応条件</p>
                <blockquote>
                    <p>大型個別案件の案件対応条件に従うこと。</p>
                </blockquote>

                <div id="signature">
                    <p>****************************************************************************</p>
                    <p>同意欄</p>
                    <p>****************************************************************************</p>
                    <blockquote>
                        <p>以上の記載内容に同意いたします。</p>
                        <p>顧客名/事業所名:</p>
                        <p>社名(協力会社の場合のみ):</p>
                        <p>部門名:</p>
                        <p>担当者名/連絡先:　　　　　</p>
                    </blockquote>
                </div>
            </li>
        </ol>
    </div>
</article>