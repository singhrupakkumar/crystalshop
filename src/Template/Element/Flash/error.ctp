<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-danger flash-msg" onclick="this.classList.add('hidden');"><?= $message ?></div>   
