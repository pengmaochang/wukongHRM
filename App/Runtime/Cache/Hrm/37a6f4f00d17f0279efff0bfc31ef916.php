<?php if (!defined('THINK_PATH')) exit();?><div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel"><b>编辑考核内容</b></h4>
		</div>
		<form action="<?php echo U('hrm/appraisaltemplate/editScoreDialog');?>" method="post">
			<div class="modal-body form-horizontal">
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">名称</label>
					<div class="col-sm-8">
						<input type="hidden" name="score_id" value="<?php echo ($score["score_id"]); ?>"/>
						<input class="form-control" type="text" name="score_name" value="<?php echo ($score["name"]); ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">标准分</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="standard_score" value="<?php echo ($score["standard_score"]); ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">评分范围</label>
					<div class="col-sm-7">
						<input class="form-control" style="width:41%" type="text" name="low_scope" value="<?php echo ($score["low_scope"]); ?>"/>&nbsp;至&nbsp;
						<input class="form-control" style="width:41%"type="text" name="high_scope" value="<?php echo ($score["high_scope"]); ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">评分细则</label>
					<div class="col-sm-9">
						<textarea name="description" class="form-control" style="min-height:100px;"><?php echo ($score["description"]); ?></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" id="control_submit" class="btn btn-primary" value="保存" />
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</form>
	</div>
</div>