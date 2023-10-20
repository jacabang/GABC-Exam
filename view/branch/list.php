<?php include('./view/header.php'); ?>
<section>
	<header class="list__row list_header">
		<div class="jumbotron text-center">
			<h1>Branch</h1>
			<br>
		</div>
		<div class="container">
			<?php if(count($employees) != 0): ?>
				<a href="./?action=branch&method=create" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
			<?php else: ?>
				<p class="alert alert-danger"><b>Note: Please create employee first!</b></p>
			<?php endif; ?>
		</div>
		<br>
	</header>
	<table id="example" class="display table table-bordered table-striped mb-none" style="width:100%">
        <thead>
            <tr>
                <th>Branch Code</th>
                <th>Branch Name</th>
                <th>Branch Manager</th>
                <th>Date Open</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
		
		</tbody>
	</table>
</section>
<?php include('./view/footer.php'); ?>
<script>
	$(function(){
		myTable();
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
			    url: "./?action=fetchBranch",
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

		swal("Are you sure?", "You will not be able to recover this Branch!",{
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
				url: "./?action=branch",
				type: "POST",
				data: {
					"method": 'DELETE',
					"branch_id": getid,
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
	}
</script>