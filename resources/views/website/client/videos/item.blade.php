@extends('vendor.website.site-bases.layouts.master')

@section('title', $video->title)

@section('desc', strip_tags($video->description))

@section('page_title', $video->title)

@section('img', asset($video->image))

@section('content')
@endsection
