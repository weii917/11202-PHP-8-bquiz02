<fieldset>
    <legend>目前位置:首頁 > 最新文章區</legend>
    <table style="width:95%;margin:auto">
        <tr>
            <th width="30%">標題</th>
            <th width="50%">內容</th>
            <th></th>
        </tr>

        <?php
        $total = $News->count(['sh' => 1]);
        $div = 5;
        $pages = ceil($total / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * 5;
        $rows = $News->all(['sh' => 1], " limit $start,$div");
        foreach ($rows as $row) {
        ?>
            <!-- 1.title裡附帶id，要讓js點擊時得到id，2.在存進簡短內容例如:id="s1" 完整內容例如: id="a1 -->
            <tr>
                <td>
                    <div class='title' data-id="<?= $row['id']; ?>" style='cursor: pointer'><?= $row['title']; ?></div>
                </td>
                <td>
                    <div id="s<?= $row['id']; ?>"><?= mb_substr($row['news'], 0, 25); ?>...</div>
                    <div id="a<?= $row['id']; ?>" style='display:none'><?= $row['news']; ?></div>
                </td>
                <td>
                    <?php
                    if (isset($_SESSION['user'])) {
                        if ($Log->count(['news' => $row['id'], 'acc' => $_SESSION['user']]) > 0) {
                            echo "<a href=''>收回讚</a>";
                        } else {
                            echo "<a href=''>讚</a>";
                        }
                    }


                    ?>
                </td>
            </tr>

        <?php
        }
        ?>
    </table>
    <div>
        <?php
        if ($now - 1 > 0) {
            $prev = $now - 1;
            echo "<a href='?do=news&p=$prev'> ";
            echo " < ";
            echo " </a>";
        }
        for ($i = 1; $i <= $pages; $i++) {
            $fontsize = ($i == $now) ? "font-size:22px;" : "font-size:16px;";
            echo "<a href='?do=news&p=$i' style='$fontsize'> $i </a>";
        }
        if ($now + 1 <= $pages) {
            $next = $now + 1;
            echo "<a href='?do=news&p=$next'> ";
            echo " > ";
            echo " </a>";
        }
        ?>
    </div>

</fieldset>
<script>
    // 先取得id，在選取簡短內容例如:id="s1" 完整內容例如: id="a1"
    // toggle 會切換對應的id，隱藏時會顯示，顯示時會隱藏
    // 當點title，#s${id}原本顯示25字的會隱藏，#a${id}顯示完整內容
    $(".title").on('click', (e) => {
        let id = $(e.target).data('id');
        $(`#s${id},#a${id}`).toggle();
    })
</script>