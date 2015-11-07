<footer class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="title">Connect</h1>
        <?php dynamic_sidebar('sidebar-footer-instagram'); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="footer__twitter">
          <?php $tweets = kebo_twitter_get_tweets(); ?>

          <?php $i = 0; ?>
          <?php if (isset($tweets->{0}->created_at)) : ?>
            <?php foreach ($tweets as $tweet) : ?>
              <?php $twitterUserName = $tweet->user->screen_name; ?>
              <div class="tweet clearfix">
                <div class="tweet__profile-pic">
                  <img src="<?php echo $tweet->user->profile_image_url; ?>" alt="Twitter profile picture"/>
                </div>
                <h5><?php echo $tweet->user->name; ?> <span>@<?php echo $tweet->user->screen_name; ?></span></h5>

                <p class="tweet__text"><?php echo $tweet->text; ?></p>
              </div>

              <?php if (++$i == 2) break; ?>

            <?php endforeach; ?>

          <?php else : ?>

            <p>Tweets could not be displayed.</p>

          <?php endif; ?>
          <a href="http://www.twitter.com/@<?php echo $twitterUserName; ?>" target="_blank" class="btn btn-012"><i
                class="fa fa-twitter fa-fw"></i> Follow us</a>
        </div>
      </div>
      <div class="col-md-7 footer-newsletter-area">
        <div class="footer-newsletter__text">
          <?php dynamic_sidebar('sidebar-footer-newsletter'); ?>
        </div>
        <div class="newsletter-form clearfix">
            <?php echo do_shortcode('[contact-form-7 id="118" title="Newsletter Signup"]'); ?>
        </div>
        <div class="social-links">
          <a href="<?php echo get_theme_mod('twitter'); ?>" class="social-links--twitter"><i
                class="fa fa-twitter fa-fw"></i></a>
          <a href="<?php echo get_theme_mod('facebook'); ?>" class="social-links--facebook"><i
                class="fa fa-facebook-official fa-fw"></i></a>
          <a href="<?php echo get_theme_mod('instagram'); ?>" class="social-links--instagram"><i
                class="fa fa-instagram fa-fw"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-disclaimer">
    <div class="row">
      <div class="col-md-10">
        <div class="footer-disclaimer__content">
          <div class="footer-disclaimer__content-text">
            <span class="nowrap">Copyright &copy; <?php echo date("Y") ?> - <?php echo get_theme_mod('copyright'); ?></span> <span
                class="nowrap"><i class="fa fa-circle fa-fw"></i> <?php echo get_theme_mod('address'); ?></span>
            <?php
            if (has_nav_menu('footer_navigation')) :
              wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'footer-disclaimer__nav']);
            endif;
            ?>
<!--            <ul class="footer-disclaimer__nav">-->
<!--              <li><a href="">Privacy</a></li>-->
<!--              <li><a href="">Terms of use</a></li>-->
<!--              <li><a href="">Cookie policy</a></li>-->
<!--            </ul>-->
          </div>
        </div>
      </div>
      <div class="col-md-2 text-center"><a href="http://www.cityproperty.co.za/" target="_blank"><img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/city-property-logo.jpg"
              alt="City Property Logo"/></a></div>
    </div>
  </div>
</footer>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="pswp__bg"></div>
  <div class="pswp__scroll-wrap">
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>
    <div class="pswp__ui pswp__ui--hidden">
      <div class="pswp__top-bar">
        <div class="pswp__counter"></div>
        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
        <button class="pswp__button pswp__button--share" title="Share"></button>
        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>
      <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
      <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
      <div class="pswp__caption"><div class="pswp__caption__center"></div></div>
    </div>
  </div>
</div>