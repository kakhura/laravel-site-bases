@extends('vendor.website.site-bases.layouts.master')

@section('title', $project->title)

@section('desc', strip_tags($project->description))

@section('page_title', $project->title)

@section('img', asset($project->image))

@section('content')
@endsection
