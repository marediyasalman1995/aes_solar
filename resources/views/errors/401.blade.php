@extends('errors.layout')

@section('title', '401 Unauthorized')
@section('code', '401')
@section('badge_icon', 'ri-lock-password-line')
@section('badge_text', 'Authentication Required')
@section('headline', 'Authentication Credentials Required')
@section('message', 'Please sign in with valid credentials to access this protected solar account service.')
