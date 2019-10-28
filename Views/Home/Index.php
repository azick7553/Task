<?php
session_start();
$admin = false;
if (isset($_SESSION['User'])) {
    $admin = true;
}
if (isset($_SESSION['pagination'])) {
    $pagination = $_SESSION['pagination'];
    $total_pages = $pagination['total_pages'];
    $pageno = $pagination['pageno'];
    $sortUserName = $pagination['sortUserName'] == 'asc' ? 'desc' : 'asc';
    $sortEmail = $pagination['sortEmail'] == 'asc' ? 'desc' : 'asc';
    $sortStatus = $pagination['sortStatus'] == 'asc' ? 'desc' : 'asc';
}
?>
<div>
    <?php
    if (isset($_SESSION['successMessage'])) {
        
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Успешно добавлен!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        
        $_SESSION['successMessage'] = null;
    }
    if (isset($_SESSION['successMessageModify'])) {
        
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Успешно изменен!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        
        $_SESSION['successMessage'] = null;
    }
    ?>
</div>
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>
                <a style="color:white" href="?sortUserName=<?php echo $sortUserName ?>&pageno=<?php echo $pageno ?>">Пользователь<?php echo $sortUserName == 'asc' ? ' &darr;' : ' &uarr;' ?></a>
            </th>
            <th>
                <a style="color:white" href="?sortEmail=<?php echo $sortEmail ?>&pageno=<?php echo $pageno ?>">Email<?php echo $sortEmail == 'asc' ? ' &darr;' : ' &uarr;' ?></a>
            </th>
            <th>
                Текст задачи
            </th>
            <th>
                <a style="color:white" href="?sortStatus=<?php echo $sortStatus ?>&pageno=<?php echo $pageno ?>">Статус<?php echo $sortStatus == 'asc' ? ' &darr;' : ' &uarr;' ?></a>
                <!-- public $IsModified; -->
            </th>
            <?php
            if ($admin)
                echo '<th></th>';
            ?>
        </tr>
    </thead>
    <tbody class="">
        <?php
        foreach ((array) $data as $task) {
            $IsCompleted = $task['IsCompleted'] == '1' ? 'Выполнено' : 'В процессе';
            $IsModified = $task['IsModified'] == '1' ? ' Отредактировано администратором' : '';
            if (!$admin) {
                echo
                    '<tr>
                <td>' . $task['UserName'] . '</td>
                <td>' . $task['Email'] . '</td>
                <td>' . $task['TaskMessage'] . '</td>
                <td>' . $IsCompleted . $IsModified . '</td>
             </tr>';
            } else {
                echo
                    '<tr>
                <td>' . $task['UserName'] . '</td>
                <td>' . $task['Email'] . '</td>
                <td>' . $task['TaskMessage'] . '</td>
                <td>' . $IsCompleted . $IsModified . '</td>
                <td style="width:100px"><a style="color:black" href="/TaskManager/EditTask/?id='.$task['ID'].'">Именить</a></td>
             </tr>';
            }
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">
                <nav aria-label="" class="<?php if ($total_pages == 0) echo 'collapse' ?>">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($pageno <= 1) echo 'disabled' ?>">
                            <a class="page-link" href="?pageno=1" aria-label="First">
                                <span aria-hidden="true">&laquo;&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item <?php if ($pageno <= 1) echo 'disabled' ?>">
                            <a class="page-link" href="<?php echo "?pageno=" . ($pageno - 1) ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <?php
                        if ($total_pages > 1) {
				$pageCount=0;
                            if ($pageno <= 5) {
                                for ($i = 1; $i <= 5; $i++) {
				if($pageCount==$total_pages) break;
				$pageCount++;
                                    if ($pageno == $i) {
                                        echo '<li class="page-item active"><a class="page-link" href="?pageno=' . $i . '">' . $i . '<span class="sr-only">(current)</span></a></li>';
                                    } else
                                        echo '<li class="page-item"><a class="page-link" href="?pageno=' . $i . '">' . $i . '<span class="sr-only">(current)</span></a></li>';
                                }
                            } else if (($total_pages - $pageno) <= 5) {
                                for ($i = $total_pages - 5; $i <= $total_pages; $i++) {
                                    if ($pageno == $i) {
                                        echo '<li class="page-item active"><a class="page-link" href="?pageno=' . $i . '">' . $i . '<span class="sr-only">(current)</span></a></li>';
                                    } else
                                        echo '<li class="page-item"><a class="page-link" href="?pageno=' . $i . '">' . $i . '<span class="sr-only">(current)</span></a></li>';
                                }
                            } else {
				$pageCount=0;
                                for ($i = $pageno; $i <= $total_pages; $i++) {
				if($pageCount==5) break;
				$pageCount++;
				if ($pageno == $i) {
                                        echo '<li class="page-item active"><a class="page-link" href="?pageno=' . $i . '">' .$i . '<span class="sr-only">(current)</span></a></li>';
                                    } else
                                        echo '<li class="page-item"><a class="page-link" href="?pageno=' . $i . '">' . $i . '<span class="sr-only">(current)</span></a></li>';
				  
                                }
                            }
                        }
                        ?>
                        <li class="page-item <?php if (($total_pages - $pageno) < 1) echo 'disabled' ?>">
                            <a class="page-link" href="<?php echo "?pageno=" . ($pageno + 1) ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <li class="page-item <?php if ($total_pages == $pageno) echo 'disabled' ?>">
                            <a class="page-link" href="?pageno=<?php echo $total_pages ?>" aria-label="First">
                                <span aria-hidden="true">&raquo;&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </td>
        </tr>
    </tfoot>
</table>