<?php
function message($message, $type) {
    $type = $type ?? 'success';

    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    if ($type == 'error') {
        return "<div class='message message--error message--y-4'>
            <i data-lucide='alert-circle'></i>
            <span class='message-text'>$safeMessage</span>
        </div>";
    }

    if ($type == 'success') {
        // Escapar caracteres especiales por seguridad
        return "<div class='message message--success message--y-4'>
            <i data-lucide='check-circle'></i>
            <span class='message-text'>$safeMessage</span>
        </div>";
    }
}
?>
