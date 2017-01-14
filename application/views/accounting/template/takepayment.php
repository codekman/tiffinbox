<h3 class="grey lighter pull-left position-relative">
	<i class="icon-leaf green"></i>
	Payment History
</h3>
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
			<?php foreach( $payment_history->result() as $key =>$row): ?>
			<tr>
				<td class="center"><?php echo $key+1; ?></td>

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
			<span class="red pull-right"><?php echo $payment_history->row()->totalAmount;?></span>
		</h4> 
	</div>
</div>

<div class="space-6"></div>

<div class="row-fluid">
	<div class="span12 well">
			<h4 class="">
			Due amount :
			<span class="red pull-right"><?php echo ($payment_history->row()->totalAmount-$total); ?></span>
		</h4> 
		</div>
</div>

<h4>Take Payment</h4><hr/>
<?php echo form_open_multipart(base_url().'accounting/takenewpayment','class="form-horizontal"'); ?>
	<div class="control-group">
		<label class="control-label" for=" ">
			Payment Amount <span class="red">*</span>:
		</label>
		<div class="controls">
			<?php
	
			$paidAmount = array(
				'name'			=>'paidAmount',
				'id'			=>'form-field-1',
				'placeholder'	=>'Payment Amount',
				'required'		=>'required'
			);
			echo form_input($paidAmount).'&nbsp;&nbsp;&nbsp;';
			echo form_error('paidAmount'); 
			?>
		 </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="">
			  Date <span class="red">*</span>:
		</label>
	 	<div class="controls">
			<input class="date-picker input-append" name="paymentDate" id="id-date-picker-1"   type="text" data-date-format="dd-mm-yyyy" required/>
			<span class="add-on">
				<i class="icon-calendar"></i>
			</span>
		</div> 
	</div>
	<div class="control-group">
			<label class="control-label" for="">
			Payment Method  :
			</label>
			<div class="controls">
				<label class="span4">
					<input id=" " name="medium" checked  value="Cash" type="radio">
					<span class="lbl" for=""> Cash</span>
				</label>
				<label class="span4">
					<input id=" " name="medium" value="Check" type="radio">
					<span class="lbl" for=""> Check</span>
				</label>
				<label class="span4">
					<input id=" " name="medium" value="Card" type="radio">
					<span class="lbl" for=""> Card</span>
				</label>
			</div>
	</div>
	<?php echo form_hidden('paymentId', $payment_history->row()->Id);?>
	<div class="control-group">	
		<button class="btn btn-mini btn-info pull-right" type="submit">
			<i class="icon-ok bigger-110"></i>
			Submit New Payment
		</button>
	</div>
<?php echo form_close(); ?>	
 <script src="<?php echo base_url();?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
<script>
$('.date-picker').datepicker().next().on(ace.click_event, function(){
	$(this).prev().focus();
});

</script>	