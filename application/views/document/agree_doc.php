<html>
    <head>
        <meta charset="utf-8">
        <link href="<?= base_url() ?>application/css/agreedoc.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <h2>個別対応ドライバリリース確認書</h2>
        <div style="text-align: right;">
            <p>No. CDD-SpecialRel-<?= $caseObj->CaseSeqNo ?></p>
            <p>コントローラ開発本部 CTPF第3開発部</p>
            <p><?= mdate("%Y年%m月%d日") ?></p>
        </div>
        <p>本個別対応の実施にあたって以下の記載内容に対して同意いただける場合は、文末の同意欄の項目に<u>直筆署名</u>を記入いただき、<u>DWでスキャンした文書</u>を返送いただけますようお願い致します。</p>
        
        <br>
        <p style="text-align: center">--- 記 ---</p>
        <br>
        
        <ol type="1">
            <li><p>案件名</p></li>
            <blockquote>
                <p><?= $title ?></p>
            </blockquote>
            <li><p>個別対応の内容</p></li>
            <ol type="1">
                <li><p>対応内容:</p></li>
                <blockquote>
                    <p>市場導入版Multi-model Print Driver 2 (v2.7.７.5)英語版と同時にインストール可能な日本語版ドライバーを開発します。仕様詳細は以下の通りです。</p>
                </blockquote>

                <li><p>対応内容:</p></li>
                <blockquote>
                    <p>※ 英語OS (MUI日本語表示 : システムロケール日本語)</p>
                    <p>英語OSでMUIのない環境では，英語版の標準MMD2を利用いただく。</p>
                </blockquote>
            </ol>

            <li><p>ドライバーモデル名</p></li>
            <blockquote>
                <p>「Multi-model Print Driver2 Jpn」</p>
            </blockquote>

            <li><p>ドライバーモデル名</p></li>
            <blockquote>
                <p>ドライバーバージョン</p>
                <blockquote>
                    <p>v2.7.7.90</p>
                </blockquote>
            </blockquote>

                <li><blockquote>
                        <p>セットアップツール</p>
                    </blockquote></li>
            </ul>
            <blockquote>
                <p>本個別ドライバーは，セットアップツールを提供しない</p>
            </blockquote>
            <ul>
                <li><blockquote>
                        <p>その他，機能仕様等</p>
                    </blockquote></li>
            </ul>
            <blockquote>
                <p>提供する機能や各機能の仕様は標準ドライバーと同一である。</p>
            </blockquote>
            <p>3. 提供形態</p>
            <blockquote>
                <p>自己解凍exe形式</p>
            </blockquote>
            <p>4. 仕様制限事項</p>
            <blockquote>
                <p>本個別対応ドライバーには以下の○印の仕様制限項目があります。</p>
            </blockquote>
            <table>
                <tbody>
                    <tr class="odd">
                        <td style="text-align: left;">○</td>
                        <td style="text-align: left;">インストーラーの使用不可　(“プリンターの追加”によりインストールすること)</td>
                    </tr>
                    <tr class="even">
                        <td style="text-align: left;">○</td>
                        <td style="text-align: left;">既存ドライバーからのバージョンアップはサポートしない</td>
                    </tr>
                    <tr class="odd">
                        <td style="text-align: left;"></td>
                        <td style="text-align: left;">本個別版ドライバー以外の市場導入版/個別版ドライバーとの共存は不可とする</td>
                    </tr>
                    <tr class="even">
                        <td style="text-align: left;">○</td>
                        <td style="text-align: left;">共有プリンターと追加ドライバー(もしくは代替ドライバー)の両者を使用する場合、一方に市場導入版ドライバーを使用し他方に個別版ドライバーを使用することはできない</td>
                    </tr>
                    <tr class="odd">
                        <td style="text-align: left;"></td>
                        <td style="text-align: left;">本個別ドライバーと市場導入版ドライバーの間に機能差がある場合がある</td>
                    </tr>
                    <tr class="even">
                        <td style="text-align: left;">○</td>
                        <td style="text-align: left;">ヘルプファイル、Readmeファイルは市場導入版プリンタードライバーのものから変更されません</td>
                    </tr>
                    <tr class="odd">
                        <td style="text-align: left;">○</td>
                        <td style="text-align: left;">WHQLは取得しない</td>
                    </tr>
                </tbody>
            </table>
            <p>5. 対応条件</p>
            <blockquote>
                <p>大型個別案件の案件対応条件に従うこと。</p>
            </blockquote>
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
        </ol>
    </body>
</html>
