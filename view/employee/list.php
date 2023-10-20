<?php include('./view/header.php'); ?>
<style>
	img.output:hover {
	cursor: pointer;
	}

	img.output1:hover {
	cursor: pointer;
	}

	label span input {
		z-index: 999;
		line-height: 0;
		font-size: 50px;
		position: absolute;
		top: -6px;
		left: 0px;
		opacity: 0;
		filter: alpha(opacity = 0);
		-ms-filter: "alpha(opacity=0)";
		cursor: pointer;
		_cursor: hand;
		margin: 0;
		padding:0;
	}

	.arrow.vtl {
	    background-position: 0 0;
	    width: 47px;
	    height: 96px;
	}
	.arrow {
	    background: transparent url(./assets/images/arrows.png) no-repeat 0 0;
	    width: 47px;
	    height: 120px;
	    display: inline-block;
	    position: relative;
	}
</style>
<section>
	<header class="list__row list_header">
		<div class="jumbotron text-center">
			<h1>Employee</h1>
			<br>
		</div>
		<div class="container">
			<!-- <button onclick="clickTab()" class="btn btn-success"><i class="fa fa-plus"></i> Click Tab</a> -->
		</div>
		<br>
	</header>
	<div id="horizontalTab">
        <ul>
            <li><a onclick="cancelForm();" id="employeeList" href="#tab-1">Employee List</a></li>
            <li><a id="addNew" href="#tab-2"><span id="tabLabel">Add New</span></a></li>
        </ul>

        <div id="tab-1">
			<table id="example" class="display table table-bordered table-striped mb-none" style="width:100%">
		        <thead>
		            <tr>
		                <th>First Name</th>
		                <th>Middle Name</th>
		                <th>Last Name</th>
		                <th>Date Hired</th>
		                <th></th>
		            </tr>
		        </thead>
		        <tbody>
				
				</tbody>
			</table>
		</div>
		<div id="tab-2">
			<div class="form-group">
				<form id="formEmployee" class="form-horizontal" enctype="multipart/form-data" action="./?action=employee" method="post" onsubmit="return mySubmitFunction(event)">
					<?= csrf(); ?>
					<div class="row">
						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>First Name:</label>
										<input id="first_name" class=" form-control" type="text" name="first_name" maxlength="191" placeholder="First Name"/>
										<span id="first_name_notif" class="help-block text-danger" style="display: none">
					                        <strong>First Name is required</strong>
					                    </span>
					                </div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Middle Name:</label>
										<input id="middle_name" class=" form-control" type="text" name="middle_name" maxlength="191" placeholder="Middle Name"/>
										<span id="middle_name_notif" class="help-block text-danger" style="display: none">
					                        <strong>Middle Name is required</strong>
					                    </span>
					                </div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Last Name:</label>
										<input id="last_name" class=" form-control" type="text" name="last_name" maxlength="191" placeholder="Last Name"/>
										<span id="last_name_notif" class="help-block text-danger" style="display: none">
					                        <strong>Last Name is required</strong>
					                    </span>
					                </div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Date Hired:</label>
										<input id="date_hired" class=" form-control" type="date" name="date_hired" maxlength="191" placeholder="Date Hired"/>
										<span id="date_hired_notif" class="help-block text-danger" style="display: none">
					                        <strong>Date Hired is required</strong>
					                    </span>
					                </div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<a id="canccelForm" onclick="formCancel()" class="btn btn-warning"><i class="fa fa-arrow-left"></i> <span>Cancel</span></a>
										<button  class="btn btn-success"><i class="fa fa-floppy-o"></i> <span id="buttonLabel">Save</span></button>
					                </div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
                            <center>
                                <label class="filebutton" style="width: 100%;">
                                <img class="card" onclick="$('#myFile').click();" style="width: 40%;" id="output" src="<?= $image_file; ?>"/>
                                <span><input style="" type="file" id="myfile" name="banner" onchange="loadFile(event)" accept=".jpg, .png, .PNG, .JPG" 
                                ></span>
                                </label>
                                <span class="arrow vtl"></span>
                                <p>Click on photo to upload</p>
                            </center>
                            <script>
                              var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                              };
                            </script>
                        </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php include('./view/footer.php'); ?>
<script>

	function formCancel(){
		$("#employeeList").click();
	}

	function cancelForm(){
		$("#formEmployee").attr('action', './?action=employee');
		$("#method").remove();
		$("#employee_id").val('');
		$("#first_name").val('');
		$("#last_name").val('');
		$("#date_hired").val('');
		$("#middle_name").val('');
		$("#buttonLabel").html('Submit');
		$("#tabLabel").html('Add New');
		$("#canccelForm").hide();
		$("#first_name_notif").hide();
		$("#last_name_notif").hide();
		$("#date_hired_notif").hide();
		$('#output').attr('src','<?= $image_file; ?>');

	}

	function mySubmitFunction(e){
		var err = false;
		var first_name = $("#first_name").val();
		var last_name = $("#last_name").val();
		var middle_name = $("#middle_name").val();
		var date_hired = $("#date_hired").val();

		if(first_name == ""){
			$("#first_name_notif").show();
			err = true;
		} else {
			$("#first_name_notif").hide();
		}

		if(last_name == ""){
			$("#last_name_notif").show();
			err = true;
		} else {
			$("#last_name_notif").hide();
		}

		if(date_hired == ""){
			$("#date_hired_notif").show();
			err = true;
		} else {
			$("#date_hired_notif").hide();
		}

		if(err){

			e.preventDefault();
			swal("","Please input all filed", "warning");

		} else {
			$("#formEmployee").submit();
		}
	}

	$(function(){
		myTable();
		cancelForm();
	});

	function myTable(){
		var table1 = $('#example').DataTable();
		table1.destroy();
		var table1 = $('#example').DataTable( {
		    responsive: true,
		    // "searching": false,
		    'columnDefs': [],
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		    order: [[0, 'asc']],
	      	"language": {
	      		"emptyTable": "No data found. click on <b>Add New</b> button"
	      	},
		    "ajax": {
			    url: "./?action=fetchEmployee",
			    "type": "POST",
			    "data" : {
			    	"token": "<?= csrf_token(); ?>"
			    }
			},
		} );

	$('#example tbody').on( 'click', 'a.icon-delete', function () {
		var getid = $(this).data('id');

		var row;

		if($(this).closest('table').hasClass("collapsed")) {
		    var child = $(this).parents("tr.child");
		    row = $(child).prevAll(".parent");
		  } else {
		    row = $(this).parents('tr');
	  	}

	  	myrow = table1
	        .row(row);

		swal("Are you sure?", "You will not be able to recover this Employee!",{
          icon: 'warning',
          buttons: ["Cancel", {
            text: "Yes!",
            closeModal: false,
            className: "btn-danger",
          }],
        })
        .then(name => {
          if (!name) throw null;
          myrow.remove().draw();
           $.ajax({
				url: "./?action=employee",
				type: "POST",
				data: {
					"method": 'DELETE',
					"employee_id": getid,
			    	"token": "<?= csrf_token(); ?>"
				},
				success: function(data){
					swal("","Data has successfully deleted","success", {
					  timer: 1500,
					});
					swal.close()

				}        
		   });
          
          
        })
        .then(results => {
            // swal("","Data has successfully deleted","success");

        });
	    
	} );

	$('#example tbody').on( 'click', 'a.icon-update', function () {
		var id = $(this).data('id');
		var first_name = $(this).data('first_name');
		var last_name = $(this).data('last_name');
		var middle_name = $(this).data('middle_name');
		var hired_at = $(this).data('hired_at');
		var image_path = $(this).data('image_path');

		if(image_path === ''){
			$('#output').attr('src','<?= $image_file; ?>');
		} else{
			$('#output').attr('src',image_path);
		}

		$("#formEmployee").attr('action', './?action=employee&employee_id='+id);
		$("#formEmployee").append('<input id="method" type="hidden" name="method" value="PUT">');
		$("#employee_id").val(id);
		$("#employee_id").val(id);
		$("#first_name").val(first_name);
		$("#last_name").val(last_name);
		$("#middle_name").val(middle_name);
		$("#date_hired").val(hired_at);

		$("#addNew").click();
		$("#buttonLabel").html('Update');
		$("#tabLabel").html('Update Data');
		$("#canccelForm").show();
	    
	} );

	}
</script>
<script>
$(function(){

	$('#horizontalTab').responsiveTabs({
	    rotate: false,
        startCollapsed: 'accordion',
        collapsible: 'accordion',
        setHash: false,
        activate: function(e, tab) {
            $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
        },
        activateState: function(e, state) {
            //console.log(state);
            $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
        }
	});

});
</script>