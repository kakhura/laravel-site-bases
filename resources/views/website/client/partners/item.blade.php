@extends('vendor.website.site-bases.layouts.master')

@section('title', $partner->title)

@section('desc', strip_tags($partner->description))

@section('page_title', $partner->title)

@section('img', asset($partner->image))

@section('content')
@endsection
