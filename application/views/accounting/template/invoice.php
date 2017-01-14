 
<div class="row-fluid">
	<div class="span10 offset1">
		<div class="widget-box transparent invoice-box">
			<div class="widget-header widget-header-large">
				<h3 class="grey lighter pull-left position-relative">
					<i class="icon-leaf green"></i>
					Invoice
				</h3>
				<div class="widget-toolbar no-border invoice-info">
					<span class="invoice-info-label">Invoice:</span>
					<span class="red">#<?php echo $payment->row()->Id; ?></span>
					<br />
					<span class="invoice-info-label">Date:</span>
					<span class="blue"><?php echo date('d-m-Y', strtotime($payment->row()->createdDate)); ?></span>
				</div>

				<div class="widget-toolbar hidden-480">
					<a href="#">
						<i class="icon-print"></i>
					</a>
				</div>
			</div>

			<div class="widget-body">
				<div class="widget-main padding-24">
					<div class="row-fluid">
						<div class="row-fluid">
							<div class="span6">
								<div class="row-fluid">
									<div class="span12 label label-large label-info arrowed-in arrowed-right">
										<b>Organigation Info</b>
									</div>
								</div>

								<div class="row-fluid">
									<ul class="unstyled spaced">
										<li>
											<i class="icon-caret-right blue"></i>
											Street, City
										</li>

										<li>
											<i class="icon-caret-right blue"></i>
											Zip Code
										</li>

										<li>
											<i class="icon-caret-right blue"></i>
											State, Country
										</li>

										<li>
											<i class="icon-caret-right blue"></i>
											Phone:
											<b class="red">111-111-111</b>
										</li>

										<li class="divider"></li>

										<li>
											<i class="icon-caret-right blue"></i>
											Paymant Info
										</li>
									</ul>
								</div>
							</div><!--/span-->

							<div class="span6">
								<div class="row-fluid">
									<div class="span12 label label-large label-success arrowed-in arrowed-right">
										<b>Bill To</b>
									</div>
								</div>

								<div class="row-fluid">
									<ul class="unstyled spaced">
										<li>
											<i class="icon-caret-right green"></i>
											Name: <?php echo $payment->row()->StdName; ?>
										</li>

										<li>
											<i class="icon-caret-right green"></i>
											Class: <?php echo $payment->row()->ClassName.' :: '.$payment->row()->ClassNumaricName; ?>
										</li>

										<li>
											<i class="icon-caret-right green"></i>
											Roll No.<?php echo $payment->row()->StdRollNo; ?>
										</li>

										<li class="divider"></li>

										<li>
											<i class="icon-caret-right green"></i>
											Contact Info: <?php echo $payment->row()->StdContactNo; ?>
										</li>
									</ul>
								</div>
							</div><!--/span-->
						</div><!--row-->

						<div class="space"></div>

						<div class="row-fluid">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th class="center">#</th>
										<th>Date</th>
										<th class="hidden-480">Medium</th>
										<th class="hidden-phone">Amount</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach( $payment->result() as $key =>$row): ?>
									<tr>
										<td class="center"><?php echo $key; ?></td>

										<td>
											<?php echo $row->paymentDate; ?>
										</td>
										
										<td>
											<?php echo $row->medium; ?>
										</td>
										
										<td class="hidden-phone">
											<?php echo $row->paidAmount; @$total +=$row->paidAmount;?>
											
										</td>
									 
									</tr>
									<?php endforeach; ?>	
									 
								</tbody>
							</table>
						</div>

						<div class="hr hr8 hr-double hr-dotted"></div>

						<div class="row-fluid">
							<div class="span5 pull-right">
								<h4 class="pull-right">
									Paid amount :
									<span class="red pull-right"><?php echo $total;?></span> 
								</h4>
							</div>
							<div class="span7 pull-left">  
								<h4 class="">
									Total amount :
									<span class="red pull-right"><?php echo $payment->row()->totalAmount;?></span>
								</h4> 
							</div>
						</div>

						<div class="space-6"></div>

						<div class="row-fluid">
							<div class="span12 well">
									<h4 class="">
									Due amount :
									<span class="red pull-right"><?php echo ($payment->row()->totalAmount-$total); ?></span>
								</h4> 
								</div>
						</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 
 