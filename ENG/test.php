<div class="progress-card">
									<div class="progress-status">
										<span class="text-muted">Progress</span>
										<span class="text-muted fw-bold"> <?php echo $row['progress'] ?>%</span>
									</div>
									<div class="progress">
										<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $row['progress'] ?>%" aria-valuenow="<?php echo $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $row['progress'] ?>%"></div>
									</div>
								</div>