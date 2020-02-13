<div class="banner-panel">
<div id="banner<?php echo $module; ?>" class="owl-carousel">
  <?php foreach ($banners as $banner) { ?>
  <div class="item">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
</div>

<?php if(count($banners)==1) { ?>
	<script type="text/javascript">
	$('#banner<?php echo $module; ?>').removeClass( "owl-carousel" );
	</script>
<?php } else { ?>
	<script type="text/javascript">
	$('#banner<?php echo $module; ?>').owlCarousel({
		items: 6,
		autoPlay: 6000,
		singleItem: true,
		navigation: true,
		pagination: true
	});
	</script>
<?php } ?>