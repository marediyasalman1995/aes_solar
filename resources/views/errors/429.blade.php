@extends('errors.layout')

@section('title', '429 Rate Limit Exceeded')
@section('code', '429')
@section('badge_icon', 'ri-speed-line')
@section('badge_text', 'Traffic Load Limit')
@section('headline', 'Too Many Network Requests')
@section('message', 'You have transmitted too many requests in a short period. Please pause for a few moments and try reloading the page.')
