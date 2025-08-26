@extends('errors.layout')

@section('title', 'Too Many Requests')
@section('code', '429')
@section('message', 'Too Many Requests')
@section('description', 'Anda melakukan terlalu banyak permintaan dalam waktu singkat. Silakan coba lagi nanti.')
