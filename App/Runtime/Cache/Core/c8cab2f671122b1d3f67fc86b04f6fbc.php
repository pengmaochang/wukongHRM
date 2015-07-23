<?php if (!defined('THINK_PATH')) exit();?><div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel"><b>下级员工列表</b></h4>
		</div>
		<div class="modal-body form-horizontal">
			<table class="table table-striped">
				<thead>
					<tr>
						<td><input type="checkbox" name="check_all" class="check_all"></td>
						<td>姓名</td>
						<td>岗位</td>
						<td>类型</td>
						<td>电话</td>
						<td>邮箱</td>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($subCBUser)): $i = 0; $__LIST__ = $subCBUser;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
							<td><input type="checkbox" name="user_id[]" value="<?php echo ($vo["user_id"]); ?>" /></td>
							<td><?php echo ($vo["name"]); ?></td>
							<td><?php echo ($vo["position_name"]); ?></td>
							<td><?php echo ($vo["type_name"]); ?></td>
							<td><?php echo ($vo["telphone"]); ?></td>
							<td><?php echo ($vo["email"]); ?></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="modal-footer">
				<input type="submit" id="usercb_submit" class="btn btn-primary" value="确定" />
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	/**
	 * 全选
	 *
	 **/
	$(function(){
		$(".check_all").click(function(){
			$("input[name='user_id[]']").prop('checked', $(this).prop("checked"));
		});
	});
	
	/**
	 * 将选择的值传递到上个界面
	 * 父界面通过设置ID： str_user_id 和 str_user_name 来接受数据
	 **/
	var items='';
	var coordinate_name = "";
	$("#usercb_submit").click(function(){
		$("input:checkbox[name='user_id[]']:checked").each(function(index,e){
			if($("input:checkbox[name='user_id[]']:checked")){
				items += $(e).val() + ",";
			}
		});
		$("input[name='coordinate_ids']").val(items);
		$("#str_user_id").val(items);
		
		
		$("input:checkbox[name='user_id[]']:checked").each(function(index,e){
			if("input:checkbox[name='user_id[]']:checked"){
				coordinate_name += $(e).parent().next().html() + ","; 
			}
		});
		$("input[name='coordinate_name']").val(coordinate_name);
		$("#str_user_name").val(coordinate_name);
		$('#alert').modal('hide');
	});
</script>