<?php
$result = (array) $data;
$single = $result[0];
?>
<form method="post" action="/TaskManager/ModifyTask">
    <div class="card  mx-auto" style="">
        <div class="card-body">
            <h5 class="card-title text-center"></h5>
            <input name="ID" id="ID" type="hidden" value="<? echo $result['ID']; ?>" />
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label><strong>Исполняющий</strong></label>
                        <br>
                        <label>
                            <?php echo $result['UserName'];  ?>
                        </label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label><strong>Email</strong></label>
                        <br>
                        <label>
                            <?php echo $result['Email'];  ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="TaskMessage"><strong>Текст задачи</strong></label>
                <textarea required name="TaskMessage" id="TaskMessage" class="form-control" style="min-height:150px" aria-describedby="TaskMessage" placeholder="Введите содержание задачи"><?php echo $result['TaskMessage']; ?></textarea>
            </div>

            <div class="form-check">
                <input class="form-check-input" <?php echo $result['IsCompleted'] == 1 ? 'checked' : ''; ?> type="checkbox" value="1" id="IsCompleted" name="IsCompleted">
                <label class="form-check-label" for="IsCompleted">
                    Статус выполнено
                </label>
            </div>
            <div class="form-group">
                <input class="btn btn-primary float-right" type="submit" value="Изменить" />
            </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="">
    $(document).ready(function() {
        setInterval(function() {
            ajaxRequest();
        }, 1000);
    });

    function ajaxRequest() {
       $.get('/Check.php', function (data){
            if(data !=1){
                window.location.href = "/Account/";
            }
       });
    }
</script>