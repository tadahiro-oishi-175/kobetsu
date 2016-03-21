<script>
    $(document).ready(function () {
        $('body').Aplus();
        $('#sortable-table tbody').sortable({
            items: 'tr',
            axis: 'y',
            opacity: 0.5,
            update: function(event, ui) {
                var order = $('#sortable-table tbody').sortable('serialize');
                updateSequence(order);
            }
        });
        
        function updateSequence(sort_data) {
            
            $.ajax({
               type: 'post',
               url: '<?= base_url()."DocumentController/UpdateSequence/$category/$id" ?>',
               data: sort_data,
               dataType: "html",
               success: function(data) {
                   location.reload(true);
               }
            });
        }
    });
</script>
<table id="sortable-table">
    <thead>
        <tr><th>No</th><th>ファイル名</th><th></th></tr>
    </thead>
    <tbody>
        <?php foreach ($docs as $index => $doc) : ?>
            <tr id="item-<?= $doc->DocID ?>">
                <td><?= $index + 1 ?></td>
                <td><?= anchor("DocumentController/DownloadFile/$category/$doc->DocID", $doc->DocName) ?></td>
                <td class="delLink"><a class="confirm" title="本当に削除しますか？" href="<?= base_url()."DocumentController/DeleteDocument/$category/$doc->DocID" ?>">×</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>