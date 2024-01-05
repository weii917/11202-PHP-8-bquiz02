<form action="./api/edit_user.php" method="post">
    <table style="width:75%;margin:auto;text-align:center">
        <tr>
            <td style="width:10%">編號</td>
            <td style="width:70%">標題</td>
            <td style="width:10%">顯示</td>
            <td style="width:10%">刪除</td>
        </tr>
        <?php
        $total = $News->count();
        $div = 3;
        $pages = ceil($total / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;
        $rows = $News->all(" limit $start,$div");
        foreach ($rows as $idx => $row) {


        ?>
            <tr>
                <td class="clo"><?= $idx+1+$start;?>.</td>
                <td><?= $row['title'] ?></td>
                <td>
                    <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>"  <?=($row['sh']==1)?'checked':'';?>>
                </td>
                <td>
                    <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
                </td>
            </tr>
        <?php

        }
        ?>
    </table>
    <div class="ct">

        <?php
        if ($now > 1) {
            $prev = $now - 1;
            echo "<a href='?do=$do&p=$prev'> < </a>";
        }

        for ($i = 1; $i <= $pages; $i++) {
            $fontsize = ($now == $i) ? '24px' : '16px';
            echo "<a href='?do=$do&p=$i' style='font-size:$fontsize'> $i </a>";
        }

        if ($now < $pages) {
            $next = $now + 1;
            echo "<a href='?do=$do&p=$next'> > </a>";
        }
        ?>
    </div>
    <div class="ct">
        <input type="submit" value="確定修改">
    </div>

</form>