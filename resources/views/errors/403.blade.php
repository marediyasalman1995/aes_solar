@extends('errors.layout')

@section('title', '403 Access Forbidden')
@section('code', '403')
@section('badge_icon', 'ri-shield-keyhole-line')
@section('badge_text', 'Security Clearance Required')
@section('headline', 'Restricted Solar Sector Access')
@section('message', 'You do not have the required administrative clearance or customer permissions to view this secure sector. Please log in with an authorized account.')
