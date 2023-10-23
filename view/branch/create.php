<?php include('./view/header.php'); ?>
<section id="add" class="add">
	<fieldset class="scheduler-border border rounded-3 p-3">
		<form onsubmit="return mySubmitFunction(event)" action="./?action=branch<?php if($branch_id != ""):?>&branch_id=<?=$branch_id;?><?php endif; ?>" method="post" id="formBranch" class="list__header_select">
			<?= csrf(); ?>
			<?php if($branch_id): ?>
				<input type="hidden" name="method" value="PUT">
			<?php endif; ?>
			<legend class="alternative-font float-none w-auto px-3"><b><?= $label; ?> Branch</b></legend>
			<hr>
			<?php if(isset($_GET['error'])): ?>
				<p class="alert alert-danger"><b>Note: Branch Code "<?= $_GET['error'];?>" is already taken!</b></p>
			<?php endif; ?>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Branch Code:</label>

						<input onblur="checkBranchCode()" id="branch_code" class=" form-control" type="text" name="branch_code" maxlength="191" placeholder="Branch Code" value="<?= $branch_code; ?>"/>
						<span id="branch_code_notif" class="help-block text-danger" style="display: none">
	                        <strong>Branch Code is required</strong>
	                    </span>
						<span id="branch_code_notif1" class="help-block text-danger" style="display: none">
	                        <strong>Branch Code already taken</strong>
	                    </span>
	                </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Branch Name:</label>

						<input id="branch_name" class=" form-control" type="text" name="branch_name" maxlength="191" placeholder="Branch Name" value="<?= $branch_name; ?>"/>
						<span id="branch_name_notif" class="help-block text-danger" style="display: none">
	                        <strong>Branch Name is required</strong>
	                    </span>
	                </div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label>Address:</label>

						<input id="address" class=" form-control" type="text" name="address" maxlength="191" placeholder="Address" value="<?= $address; ?>"/>
						<span id="address_notif" class="help-block text-danger" style="display: none">
	                        <strong>Address is required</strong>
	                    </span>
	                </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Barangay:</label>

						<input id="barangay" class=" form-control" type="text" name="barangay" maxlength="191" placeholder="Barangay" value="<?= $barangay; ?>"/>
						<span id="barangay_notif" class="help-block text-danger" style="display: none">
	                        <strong>Barangay is required</strong>
	                    </span>
	                </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>City:</label>

						<input id="city" class=" form-control" type="text" name="city" maxlength="191" placeholder="City" value="<?= $city; ?>"/>
						<span id="city_notif" class="help-block text-danger" style="display: none">
	                        <strong>City is required</strong>
	                    </span>
	                </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Permit No:</label>

						<input id="permit_no" class=" form-control" type="text" name="permit_no" maxlength="191" placeholder="Permit No" value="<?= $permit_no; ?>"/>
						<span id="permit_no_notif" class="help-block text-danger" style="display: none">
	                        <strong>Permit No is required</strong>
	                    </span>
	                </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Branch Manager:</label>
						<select id="branch_manager" class="form-select mySelect2" name="branch_manager_id">
							<option value="">Search an Employee</option>
							<?php if($employee != ""): ?>
								<option value="<?= $employee['id']; ?>" selected><?= $employee['last_name']; ?>, <?= $employee['first_name']; ?> <?= $employee['middle_name']; ?></option>
							<?php endif; ?>
						</select>
	                </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Date Open:</label>
						<input id="date_open" class=" form-control" type="date" name="date_open" value="<?= $open_at; ?>" maxlength="191" placeholder="Date Open"/>
						<span id="date_open_notif" class="help-block text-danger" style="display: none">
	                        <strong>Date Open is required</strong>
	                    </span>
	                </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>&nbsp;</label>
						<div class="form-check">
						  <input class="form-check-input" type="checkbox" name="is_active" value="1" id="flexCheckDefault"
						  <?php if($is_active == 1): ?>
						  	checked
						  <?php endif; ?>
						  >
						  <label class="form-check-label" for="flexCheckDefault">
						    isActive
						  </label>
						</div>
	                </div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<a href="./?action=branch" class="btn btn-warning"><i class="fa fa-arrow-left"></i> <span>Back</span></a>
						<button class="btn btn-success"/><i class='fa fa-floppy-o'></i> <?= $label1; ?></div>
	                </div>
				</div>
			</div>
		</form>
	</fieldset>
</section>
<?php include('./view/footer.php'); ?>
<script>

function checkBranchCode(){

	branch_code = $("#branch_code").val();

	$.ajax({
		url: "./?action=check_branch_code",
		type: "POST",
    	dataType: "json",
		data: {
			"branch_code": branch_code,
			"branch_id": "<?= $branch_id; ?>",
	    	"token": "<?= csrf_token(); ?>"
		},
		success: function(data){

			if(data.status === true){
				$("#branch_code_notif1").show();
				swal("","Branch Code Already Exist!","warning", {
				  timer: 1500,
				});
				swal.close();
			} else {
				$("#branch_code_notif1").hide();
			}
		}        
	});
}

$(".mySelect2").select2({
	    ajax: {
	      url: "./?action=fetchEmployeeSourceViaSearch",
	      "type": "POST",
	      "dataType": 'json',
	      "data": (params) => {
	        return {
	          "q": params.term,
	          "token": "<?= csrf_token(); ?>",
	        }
	      },
	      processResults: (data, params) => {

	      	// console.log(data.items);

	        const results = data.items.map(item => {
	          return {
	            id: item.id,
	            text: item.name,
	          };
	        });

	        return {
	          results: results,
	        }
	      },
	    },
 	});

	function mySubmitFunction(e){
		var err = false;
		var branch_code = $("#branch_code").val();
		var branch_name = $("#branch_name").val();
		var address = $("#address").val();
		var barangay = $("#barangay").val();
		var city = $("#city").val();

		if(branch_code == ""){
			$("#branch_code_notif").show();
			err = true;
		} else {
			$("#branch_code_notif").hide();
		}

		if(branch_name == ""){
			$("#branch_name_notif").show();
			err = true;
		} else {
			$("#branch_name_notif").hide();
		}

		if(address == ""){
			$("#address_notif").show();
			err = true;
		} else {
			$("#address_notif").hide();
		}

		if(barangay == ""){
			$("#barangay_notif").show();
			err = true;
		} else {
			$("#barangay_notif").hide();
		}

		if(city == ""){
			$("#city_notif").show();
			err = true;
		} else {
			$("#city_notif").hide();
		}

		if(err){

			e.preventDefault();
			swal("","Please input all filed", "warning");

		} else {
			$("#formBranch").submit();
		}
	}
</script>