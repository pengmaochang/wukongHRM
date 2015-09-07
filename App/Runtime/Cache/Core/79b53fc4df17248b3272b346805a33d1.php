<?php if (!defined('THINK_PATH')) exit();?><div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">选择员工</h4>
		</div>
		<div class="modal-body">
			<div class="form-inline" >
				<div class="form-group">
					<label for="department">部门</label>
					<select class="form-control" id="department">
						<option value="0">全部</option>
						<?php if(is_array($department_list)): $i = 0; $__LIST__ = $department_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["department_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="positions">岗位</label>
					<select class="form-control" id="positions">
						<option value="0">全部</option>
					</select>
				</div>
			</div>
			<table class="table" id="users_list">
				<thead>
					<tr>
						<th><input type="checkbox" id="checkall"></th>
						<th>用户名</th>
						<th>性别</th>
						<th>部门 - 岗位</th>
						<th>手机</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td><input type="checkbox" name="to_user_id[]" value="<?php echo ($vo["user_id"]); ?>"></td>
						<td><?php echo ($vo["name"]); ?></td>
						<td><?php if($vo['sex'] == 1): ?>男<?php elseif($vo['sex'] == 2): ?>女<?php else: ?>未知<?php endif; ?></td>
						<td><?php echo ($vo["department_name"]); ?> - <?php echo ($vo["position_name"]); ?></td>
						<td><?php echo ($vo["telephone"]); ?></td>
						<td><?php echo ($vo["email"]); ?></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<input type="button" class="btn btn-primary" id="check_ed" value="确定" />
			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#check_ed').click(function(){
			str = '';
			name = '';
			$("input[name='to_user_id[]']:checked").each(function(){
				str+=$(this).val()+",";
				name+=$(this).parent().next().html()+",";
            })
			$('#to_name').val(name);
			$('#to_user_id').val(str);
			$('#alert').modal('hide');
		});
        //一个一个进行选择的时候进行的操作

		$("#checkall").click(function(){
			$("input[name='to_user_id[]']").prop('checked', $(this).prop("checked"));
		});
        //全选进行的操作

		$('#department').change(function(){
			var department_id = $(this).val();
			$.get('<?php echo U("hrm/structure/getdepartmentposition","id=");?>'+department_id,function(data){
				if(data){
					var options = '<option value="0">全部</option>';
					$.each(data, function(k, v){
						options += '<option value="'+v.position_id+'">'+v.name+'</option>';
					});
					$("#positions").html(options);
				}else{
					$("#positions").html('<option value="0">全部</option>');
				}
			},'json');
			$.get('<?php echo U("core/user/getdepartmentuser","id=");?>'+department_id,function(user_list){
				if(user_list){
					var user_str = '';
					$.each(user_list, function(k, v){
						var sex = v.sex == 1 ? '男':'女';
						user_str += '<tr><td><input type="checkbox" value="'+v.user_id+'" name="to_user_id[]"></td><td>'+v.name+'</td><td>'+sex+'</td><td>'+v.department_name+'-'+v.position_name+'</td><td>'+v.telephone+'</td><td>'+v.email+'</td></tr>';
					});
					$("#users_list tbody").html(user_str);
				}else{
					$("#users_list tbody").html('');
				}
			},'json');
		});

		$('#positions').change(function(){
			var position_id = $(this).val();
			if(position_id == 0){
				var department_id = $('#department').val();
				$.get('<?php echo U("core/user/getdepartmentuser","id=");?>'+department_id,function(user_list){
					if(user_list){
						var user_str = '';
						$.each(user_list, function(k, v){
							var sex = v.sex == 1 ? '男':'女';
							user_str += '<tr><td><input type="checkbox" value="'+v.user_id+'" name="to_user_id[]"></td><td>'+v.name+'</td><td>'+sex+'</td><td>'+v.department_name+'-'+v.position_name+'</td><td>'+v.telephone+'</td><td>'+v.email+'</td></tr>';
						});
						$("#users_list tbody").html(user_str);
					}else{
						$("#users_list tbody").html('');
					}
				},'json');
			}else{
				$.get('<?php echo U("core/user/getpositionuser","id=");?>'+position_id,function(user_list){
					if(user_list){
						var user_str = '';
						$.each(user_list, function(k, v){
							var sex = v.sex == 1 ? '男':'女';
							user_str += '<tr><td><input type="checkbox" value="'+v.user_id+'" name="to_user_id[]"></td><td>'+v.name+'</td><td>'+sex+'</td><td>'+v.department_name+'-'+v.position_name+'</td><td>'+v.telephone+'</td><td>'+v.email+'</td></tr>';
						});
						$("#users_list tbody").html(user_str);
					}else{
						$("#users_list tbody").html('');
					}
				},'json');
			}
		});
	});
</script>