@extends('layouts.site.default')

@section('page_header')
	@if($page->showtitle==1)
	<h1 class="page-header">
		{{{ $page->title }}}
	</h1>
	@endif
@stop

{{-- Add page scripts --}}
@section('page_scripts')
	<style>
	{{{ $page->page_css }}}
	</style>
	<script>
	{{ $page->page_javascript}}
	</script>
@stop

{{-- Sidebar left --}}
@section('sidebar_left')
@if(!empty($sidebar_left))
<br>
	<div class="col-xs-6 col-lg-4">
	@foreach ($sidebar_left as $item)
	
		  <div class="well">			
			{{ $item['content'] }}
		</div>
	@endforeach 
	</div>
@endif
@stop

{{-- Content --}}
@section('content')
<div class="col-xs-12 col-sm-6 col-lg-8">
	<br>
	@foreach ($content as $item)
		 {{ $item['content'] }}
	@endforeach 
</div>
<br>
@stop

{{-- Sidebar right --}}
@section('sidebar_right')
@if(!empty($sidebar_right))
	<br>
	<div class="col-xs-6 col-lg-4">			 
		@foreach ($sidebar_right as $item)
			  <div class="well">			
				{{ $item['content'] }}
			</div>
		@endforeach 
	</div>
	@endif
@stop