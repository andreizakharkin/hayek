<script type="text/javascript">
   var clock;

   $(document).ready(function() {

    // Grab the current date
    var currentDate = new Date();

    // Set some date in the future. In this case, it's always Jan 1
    var futureDate  = new Date(<?php echo implode(', ', explode('-', get_option('action_countdown'))); ?>);

    // Calculate the difference in seconds between the future and current date
    var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

    // Instantiate a coutdown FlipClock
    clock = $('.clock').FlipClock(diff, {
     clockFace: 'DailyCounter',
     countdown: true
    });
   });
</script>