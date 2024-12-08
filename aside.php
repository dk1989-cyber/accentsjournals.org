 <aside id="sj-sidebar" class="sj-sidebar">
			<div class="sj-widget sj-widgetrelatedarticles">
					
				<div class="sj-widgetcontent">
					<ul>
						<?php
							$sql = "SELECT * FROM front_menu where status='Enable' and journals_id='$journalsId' order by order_b";
							$stmt = $conn->query($sql);
							while(($row=$stmt->fetchAssociative())!==false){
							extract($row);
							?>
							<li>
							<div class="sj-description">
								<a href="<?=base_url("$menu_url?journalsId=")?><?=$journalsId?>"><p class='j_menu'><?=$menu_name?> <i class='fa fa fa-angle-right'></i></p> </a>
							</div>
						</li>
						<?php
						}
						?>
				 	</ul>
				</div>
			</div>
</aside>