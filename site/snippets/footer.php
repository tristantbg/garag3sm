</div>

</div>

<?php if($site->googleanalytics()->isNotEmpty()): ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115150448-2"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', '<?= $site->googleanalytics() ?>');
	</script>
<?php endif ?>

<script>
	var $sitetitle = '<?= $site->title()->escape() ?>';
</script>

<?= js('assets/js/build/app.min.js'); ?>
	
<?php if ($site->shopRocketShopID()->isNotEmpty()): ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>var $=jQuery.noConflict();</script>
<script language="javascript" src="https://space.shoprocket.co/frontend/sr.min.js?cid=<?= $site->shopRocketShopID() ?>"></script>
<?php endif ?>

</body>
</html>