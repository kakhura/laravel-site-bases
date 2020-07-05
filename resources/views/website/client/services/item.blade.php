@extends('vendor.website.site-bases.layouts.master')

@section('title', $service->title)

@section('desc', strip_tags($service->description))

@section('page_title', $service->title)

@section('img', asset($service->image))

@section('content')
@endsection
