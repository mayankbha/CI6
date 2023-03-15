<script>
	function delete_user(user_id) {
		var con = confirm('Are you sure you want to delete user?');

		if(con == true) {
			$.post('<?php echo c_site_url(); ?>admin/users/delete/'+user_id, {'user_id' : user_id}, function(r){
				alert(r);
			})
		}
	}
	
</script>

<div class="show-grid"></div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <b>Users : Manage All </b>       
            </div>
			<?php if(isset($message) && !empty($message)): ?>
				<div id="infoMessage" class="alert alert-warning"><?php echo $message; ?></div>
			<?php endif; ?>
                
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive" id="users_table">
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script type="text/javascript">

    $("#users_table").datatable({
        title: '',
        perPage: 10,
        allowTableinfo: false,
        url: '<?php echo c_site_url() ?>admin/users/get_all_users',
        showPagination: true,
        showFilter: true,
        showFilterRow: true,
        toggleColumns: false,
        allowOverflow: false,
        columns: [
            {
                title: "User ID",
                sortable: false,
                field: "id",
                filter: false,
            },
            {
                title: "Name",
                sortable: true,
                field: "first_name",
                filter: true,
                callback: function(data, cell) {
                    //name = data['first_name'] + " " + data['last_name'];
                    
                    return data['name'];
                }
            },
            {
                title: "Email",
                sortable: true,
                field: "email",
                filter: true
            },
            {
                title: "Actions",
                sortable: false,
                filter: false,
                callback: function(data, cell) {
                    return '<div class="btn-group">' +                            
                            '<a class="btn btn-info" href="<?php echo c_site_url(); ?>admin/users/edit_user/' + data['id'] + '"><i class="glyphicon glyphicon-eye-open"></i></a>' +
                            '<a class="btn btn-danger" href="<?php echo c_site_url(); ?>admin/users/change_password/' + data['id'] + '" ><i class="glyphicon glyphicon-edit"></i></a>'+
                            '<a class="btn btn-info" href="javascript:void(0);" onclick="delete_user('+data['id']+');"><i class="glyphicon glyphicon-trash"></i></a>' +
                    '</div>';
                }
            }
        ],
		"fnCreatedRow": function(nRow, aData, iDataIndex) {
        	$(nRow).attr('id', aData[0]);
    	}
    });
</script>