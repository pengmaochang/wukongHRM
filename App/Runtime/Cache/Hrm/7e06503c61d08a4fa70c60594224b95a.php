<?php if (!defined('THINK_PATH')) exit();?><div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel"><b><?php echo ($appraisalmanager["name"]); ?></b></h4>
		</div>
		<div class="modal-body form-horizontal">
			<p class="form-title">汇总进度...</p>
			<pre id="content"></pre>
		</div>
		<div class="modal-footer" style="display:none;">
			<input type="button" class="btn btn-primary" id="close_summary" data-dismiss="modal" value="关闭" />
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		execute_summary(0);
		$('#close_summary').click(function(){
			location.href="<?php echo U('hrm/appraisalmanager/index');?>";
		});
	});
	
	function execute_summary(user_key){
		$.get(
			"<?php echo U('hrm/appraisalmanager/summary', 'appraisal_manager_id='.$appraisalmanager['appraisal_manager_id'].'&user_key=');?>"+user_key,
			function(data){
				if(data.status == 1){
					str_content = '<span style="color:red;">'+data.tip+'</span> 已完成汇总，考核分数已生成...<br />';
					$('#content').append(str_content);
					user_key++;
					execute_summary(user_key);
				}else{
					str_content = data.tip;
					$('#content').append('<span style="color:red;">'+str_content+'</span>');
					$('.modal-footer').show();
				}
			}
		);
	}
</script>