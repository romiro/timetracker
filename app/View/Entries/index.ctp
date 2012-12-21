
<button type="button" id="TestButton">Test Entry Update Ajax</button>

<script type="text/javascript">

    $('#TestButton').click(function(){
        $.ajax({
            type: 'post',
            url: '/entries/ajaxUpdate',
            data: {
                id: 4,
                field: 'comment',
                value: 'This is a test update'
            }
        });
    });

    $.extend()
</script>


<?php
pr($entries);
?>