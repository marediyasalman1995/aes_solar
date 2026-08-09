@extends('errors.layout')

@section('title', $__env->yieldContent('title', 'System Notice'))
@section('code', $__env->yieldContent('code', '404'))
@section('headline', $__env->yieldContent('title', 'Page Not Found'))
@section('message', $__env->yieldContent('message', 'We could not locate the requested page on our solar network.'))
