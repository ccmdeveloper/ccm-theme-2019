<?php 
function themeSlider(
  $backgroundImage = false,
  $backgroundSlider = false, 
  $backgroundColor = false,
  $settingsContainer = 'container-fluid', 
  $settingsBreadcrumbs = false,
  $sectionClass = '',
  $bannerContent = false,
  $bannerContentClass = 'col-12',
  $bannerSliderAutoplay = true,
  $bannerSliderSpeed = 5,
  $bannerTransition = 'fade',
  $bannerArrows = false,
  $bannerDots = false
){


  $backgroundImage =$backgroundImage ? 'data-src="'.$backgroundImage['url'].'"' : '';  
  $backgroundImageClass =$backgroundImage ? 'lazy background-image' : '';
  $backgroundColor =$backgroundColor ? 'style="background-color:'.$backgroundColor.'"' : '';
  $settingsContainer = $settingsContainer ? 'container' : 'container-fluid';
  $contentClass =   $bannerContentClass ? $bannerContentClass : 'col-12';

?>
<section  class="banner-area <?php echo $backgroundImageClass; ?> <?php echo $sectionClass; ?>" <?php echo $backgroundImage; ?> <?php echo $backgroundColor; ?>>
  <div class="<?php echo $settingsContainer; ?>"> 
      <div class="row ">
        <div class="<?php echo $contentClass; ?>">
          <?php echo apply_filters('the_content',$bannerContent); ?>
        </div>
      </div>
    </div>
  </div>
  
  <?php 
  if ($settingsBreadcrumbs && function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<div class="breadcrumbs"><div class="'.$settingsContainer.'"><div class="row"><div class="col-12">','</div></div></div></div>' );
  }?>

  <?php if($backgroundSlider){ ?>
    <div class="bg" 
      data-autoplay="<?php echo $bannerSliderAutoplay ? 'true' : 'false'; ?>"
      data-speed="<?php echo $bannerSliderSpeed * 1000; ?>"
      data-transition="<?php echo $bannerTransition; ?>"
    >
      <?php foreach($backgroundSlider as $slide) { ?>
      <img src="<?php echo $slide['url']; ?>" class="img-fluid" data-title="<?php echo $slide['title']; ?>">
      <?php } ?>


      <?php if($bannerArrows){ ?>
        <a href="javascript:;" class="slider-arrows prev"><i class="fas fa-chevron-left"></i></a>
        <a href="javascript:;" class="slider-arrows next"><i class="fas fa-chevron-right"></i></a>
      <?php } ?>

      <?php if($bannerDots){ ?>
      <ul class="slider-dots">
        <?php foreach($backgroundSlider as $slide) { ?>
        <li><a href="javascript:;" class="dots"><i class="far fa-circle"></i></a></li>
        <?php } ?>
      </ul>
      <?php } ?>
    </div>
  <?php } ?>
</section>

<?php 
} //end of function
?>