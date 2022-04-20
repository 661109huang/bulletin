<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no minimal-ui" />
	<link href="<?= base_url("public/css/bootstrap.min.css"); ?>" rel="stylesheet">
	<link href="<?= base_url("public/css/materialdesignicons.min.css"); ?>" rel="stylesheet">
	<link href="<?= base_url("public/css/animate.css"); ?>" rel="stylesheet">
	<link href="<?= base_url("public/js/jconfirm/jquery-confirm.min.css"); ?>" rel="stylesheet">
	<link href="<?= base_url("public/css/style.min.css"); ?>" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="Public/js/html5shiv.js"></script>
		<script src="Public/js/respond.min.js"></script>
	<![endif]-->
	<title>布告欄</title>
</head>

<body>
	<!--页面主要内容-->
	<div class="container-fluid">

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-toolbar clearfix">
						<form class="pull-right search-bar" method="get" role="form">
							<div class="input-group">
								<input type="text" class="form-control" name="keyword" placeholder="請輸入關鍵字..." value="<?= (!empty($_GET["keyword"])) ? $_GET["keyword"] : ""; ?>">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button">搜索</button>
								</span>
							</div>
						</form>
						<div class="toolbar-btn-action">
							<a class="btn btn-primary m-r-5" data-toggle="modal" data-target="#new"><i class="mdi mdi-plus"></i> 新增</a>
							<a class="btn btn-success m-r-5" id="on_btn"><i class="mdi mdi-check"></i> 啟用</a>
							<a class="btn btn-warning m-r-5" id="off_btn"><i class="mdi mdi-block-helper"></i> 停用</a>
							<a class="btn btn-danger" id="del_btn"><i class="mdi mdi-window-close"></i> 刪除</a>
						</div>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>
											<label class="lyear-checkbox checkbox-primary">
												<input type="checkbox" id="check-all"><span></span>
											</label>
										</th>
										<th>狀態</th>
										<th>標題</th>
										<th>內容</th>
										<th>創建時間</th>
										<th>更新時間</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data as $val) { ?>
										<tr>
											<td>
												<label class="lyear-checkbox checkbox-primary">
													<input type="checkbox" name="ids[]" value="<?php echo $val['id']; ?>"><span></span>
												</label>
											</td>
											<td>
												<?php if ($val["status"] == 1) { ?>
													<font class="text-success">啟用</font>
												<?php } else { ?>
													<font class="text-danger">停用</font>
												<?php } ?>
											</td>
											<td><?= $val["title"]; ?></td>
											<td><?= $val["content"]; ?></td>
											<td><?= $val["create_date"]; ?></td>
											<td><?= $val["update_date"]; ?></td>
											<td>
												<div class="btn-group">
													<a class="btn btn-xs btn-default edit_btn" data-id="<?php echo $val['id']; ?>" title="編輯" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
												</div>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<?= $pageinfo; ?>
					</div>
				</div>
			</div>

		</div>

	</div>
	<!-- 新增資料的modal -->
	<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="newLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form method="post" class="form-horizontal" id="add_form" action="<?php echo site_url('Api/add') ?>">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="newLabel">新增公告</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-md-3 control-label" for="add_title">標題</label>
							<div class="col-md-7">
								<input class="form-control" type="text" id="add_title" name="add_title" placeholder="請輸入標題...">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="add_content">公告內容</label>
							<div class="col-md-7">
								<textarea class="form-control" id="add_content" name="add_content" rows="6" placeholder="請輸入公告內容..."></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
						<button type="submit" class="btn btn-primary">確定新增</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- 修改資料的modal -->
	<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form method="post" class="form-horizontal" id="edit_form" action="<?php echo site_url('Api/update') ?>">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="editLabel">修改公告</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-md-3 control-label" for="edit_title">標題</label>
							<div class="col-md-7">
								<input class="form-control" type="text" id="edit_title" name="edit_title" placeholder="請輸入標題...">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="edit_content">公告內容</label>
							<div class="col-md-7">
								<textarea class="form-control" id="edit_content" name="edit_content" rows="6" placeholder="請輸入公告內容..."></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id="edit_id" name="edit_id">
						<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
						<button type="submit" class="btn btn-primary">確定修改</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--End 页面主要内容-->
	<script type="text/javascript" src="<?= base_url("public/js/jquery.min.js"); ?>"></script>
	<script type="text/javascript" src="<?= base_url("public/js/bootstrap.min.js"); ?>"></script>
	<script type="text/javascript" src="<?= base_url("public/js/ajax.js?v=1"); ?>"></script>
	<!--消息提示-->
	<script type="text/javascript" src="<?= base_url("public/js/bootstrap-notify.min.js"); ?>"></script>
	<script type="text/javascript" src="<?= base_url("public/js/lightyear.js"); ?>"></script>
	<!--对话框-->
	<script type="text/javascript" src="<?= base_url("public/js/jconfirm/jquery-confirm.min.js"); ?>"></script>

	<script type="text/javascript" src="<?= base_url("public/js/main.min.js?v=2"); ?>"></script>

	<script type="text/javascript">
		$(function() {
			ajaxStatus = true;

			// 新增開啟modal
			$('#new').on('shown.bs.modal', function() {
				$('#add_title').focus();
			});
			// 新增關閉modal
			$("#new").on("hide.bs.modal", function(e) {
				document.getElementById("add_form").reset();
			});
			// 新增
			$("#add_form").on("submit", function(event) {
				event.preventDefault();
				submitAjax('#add_form');
				return false;
			});

			// 編輯開啟modal
			$(".edit_btn").on("click", function() {
				var url = "<?= site_url("Api/edit") ?>";
				var id = $(this).data("id");
				var data = {
					"id": id
				};
				var success = success || function(data) {
					if (data.status) { //服务器处理成功
						// lightyear.notify(data.msg, 'success', 100);
						$("#edit_id").val(data.data['0'].id);
						$("#edit_title").val(data.data['0'].title);
						$("#edit_content").val(data.data['0'].content);
						$("#edit").modal("show");
					} else { //服务器处理失败
						lightyear.notify(data.msg, 'danger', 100);
						if (alone) { //改变ajax提交状态
							ajaxStatus = true;
						}
					}
					lightyear.loading('hide');
				};
				post(url, data, success);
			});
			$('#edit').on('shown.bs.modal', function() {
				$('#edit_title').focus();
			});
			// 編輯關閉modal
			$("#edit").on("hide.bs.modal", function(e) {
				document.getElementById("edit_form").reset();
			});
			// 編輯
			$("#edit_form").on("submit", function(event) {
				event.preventDefault();
				submitAjax('#edit_form');
				return false;
			});
			// 啟用
			$("#on_btn").on("click", function() {
				post('<?php echo site_url('Api/on') ?>', $("input[name='ids[]']:checked"));
				return false;
			});
			// 停用
			$("#off_btn").on("click", function() {
				post('<?php echo site_url('Api/off') ?>', $("input[name='ids[]']:checked"));
				return false;
			});
			// 刪除
			$("#del_btn").on("click", function() {
				$.confirm({
					title: '警告',
					content: '是否確定刪除數據?',
					type: 'orange',
					typeAnimated: true,
					buttons: {
						omg: {
							text: '確定',
							btnClass: 'btn-orange',
							action: function() {
								post('<?php echo site_url('Api/del') ?>', $("input[name='ids[]']:checked"));
								return false;
							}
						},
						close: {
							text: '取消',
						}
					}
				});
			});

		});
	</script>

</body>

</html>