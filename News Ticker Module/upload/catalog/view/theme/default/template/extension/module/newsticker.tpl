<div class="newsticker">
  <div class="ribbon">
    <?php echo $limited_time_offer;

?>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
  </div>
  <div class="newstickers" id="newsticker<?php echo $module; ?>">
    <ul>
      <?php foreach ($newstickers as $newsticker) { ?>
      <li>
        <a href="<?php echo $newsticker['link']; ?>"><?php echo $newsticker['title']; ?></a>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
<script>
  $(window).load(function(e) {
    $("#newsticker<?php echo $module; ?>").newsTickers({
      effect		:"slide-v",
      autoplay	:true,
      timer		:3000,
      color		:'green',
      border		:true
    });
  });
</script>
