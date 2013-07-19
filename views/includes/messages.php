<div class='messages'>
    <?php

    if (isset($msgs)) {
        if (isset($msgs['err'])) {
            display_error($msgs['err']);
        } else if (isset($msgs['success'])) {
            display_success($msgs['success']);
        }
    }

    ?>
</div>
