<?php
echo("
<script>
let notification_queue = [];

function queue_notification(type, message) {
    notification_queue.push({ type, message });
}

document.addEventListener('DOMContentLoaded', () => {
    notification_queue.forEach(n => {
        create_notification(n.type, n.message);
    });
});
</script>
");