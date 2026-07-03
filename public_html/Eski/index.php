<?php

	include "ust.php";

?>

		<div class="at-homesliderarea">
			<div id="at-homeslidervone" class="at-haslayout at-homeslidervone at-homeslider">
				
				<?php
					$sorgu = "select * from slayt_resim order by id asc";
					$listele = $dw->getResults(''.$sorgu.'');
					foreach($listele as $row){
				?>
				
				<div class="pogoSlider-slide" data-transition="fade" data-duration="1500">
					<figure data-transition="fade" data-duration="1500" style="background:url(yukleme/slayt/<?php echo $row->resim;?>) no-repeat scroll 0 0;"></figure>
				</div>
				
				<?php } ?>
				
			</div>
			<div class="at-counter"></div>
			<a class="at-infoemail" href="mailto:info@vistatekstil.com">info@vistatekstil.com</a>
		</div>
		
		
<?php

	include "alt.php";

?>