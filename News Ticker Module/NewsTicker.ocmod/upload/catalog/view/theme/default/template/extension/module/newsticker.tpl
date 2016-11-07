<style>
    .ribbon {
        padding: 0px 10px;
        line-height: 33px;
        margin: 0px;
        position: relative;
        color: #fff;
        font-size: small;
        text-align: center;
        text-transform: uppercase;
        background: <?php echo $color; ?>;
        -webkit-animation: main 250ms;
        -moz-animation: main 250ms;
        -ms-animation: main 250ms;
        animation: main 250ms;
        float: left;
    }
    .ribbon i {
        position: absolute
    }
    .ribbon i:last-child, .ribbon i:nth-child(3) {
        width: 44px;
        bottom: -13px;
        left: -31px;
        z-index: -2;
        border: 16px solid <?php echo $color; ?>;
        border-left-color: transparent;
        -webkit-animation: back 600ms;
        -moz-animation: back 600ms;
        -ms-animation: back 600ms;
        animation: back 600ms;
        -webkit-transform-origin: 100% 0;
        -moz-transform-origin: 100% 0;
        -ms-transform-origin: 100% 0;
        transform-origin: 100% 0
    }
    .bn-green {
        border-color: <?php echo $color; ?>;
    }
    .newstickers {
        height: 33px;
        background: #FFF;
        position: relative;
        border: solid 1px <?php echo $color; ?>;
        overflow: hidden;
    }
    @media (max-width: 767px) {
        .ribbon {
            width: 100%;
        }
        .ribbon i:last-child, .ribbon i:nth-child(3){
            left:-20px;
        }
        .newstickers{
            margin-left: 20px;
        }
    }
</style>

<div class="newsticker">
  <div class="ribbon">
    <?php echo $limitedtime; ?>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
  </div>
  <div class="newstickers" id="newsticker<?php echo $module; ?>">
    <ul>
      <?php foreach ($newstickers as $newsticker) { ?>
      <li>
        <a href="<?php echo $newsticker['name']; ?>"><?php echo $newsticker['message']; ?></a>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>


<script>
  $(window).load(function(e) {
    $("#newsticker<?php echo $module; ?>").newsTickers({
      effect	:"slide-v",
      autoplay	:true,
      timer		:3000,
      border	:true
    });
  });
</script>
