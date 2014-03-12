@extends('layouts.admin.default')
{{-- Web site Title --}}
@section('title')
{{{ $title }}} ::
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1> {{{ $title }}}
	<div class="pull-right">
		<a href="{{{ URL::to('admin/pages/navigationgroups/create') }}}" class="btn btn-small btn-info iframe">
			<i class="icon-plus-sign icon-white"></i> {{{ Lang::get('admin/general.create') }}}</a>
	</div></h1>
</div>

<table id="pages" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th class="span2">{{{ Lang::get('admin/navigation/table.title') }}}</th>
			<th class="span3">{{{ Lang::get('admin/navigation/table.slug') }}}</th>
			<th class="span2">{{{ Lang::get('table.actions') }}}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
@stop

{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
	var oTable;
	$(document).ready(function() {
		oTable = $('#pages').dataTable({
			"sDom" : "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			"sPaginationType" : "bootstrap",
			"oLanguage" : {
				"sLengthMenu" : "_MENU_ {{{ Lang::get('admin/general.records_per_page') }}}"
			},
			"bProcessing" : true,
			"bServerSide" : true,
			"sAjaxSource" : "{{ URL::to('admin/pages/navigationgroups/data') }}",
			"fnDrawCallback" : function(oSettings) {
				$(".iframe").colorbox({
					iframe : true,
					width : "80%",
					height : "80%"
				});
			}
		});
	}); 
</script>
@stop