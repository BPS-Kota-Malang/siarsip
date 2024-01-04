@extends('layouts.master')

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">SI ARSIP</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header active">Dashboard</li>
        <li class="active"><a class="nav-link" href="/index"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
        <li class="menu-header">Kegiatan</li>
        <li><a class="nav-link" href="{{ route('activity') }}"><i class="far fa-square"></i> <span>Data Kegiatan</span></a></li>
        <li><a class="nav-link" href="{{ route('division.index') }}"><i class="far fa-square"></i> <span>Data Tim Kerja</span></a></li>
        <li class="menu-header">Archive</li>
        <li><a class="nav-link" href="/archive"><i class="far fa-square"></i> <span>Arsip</span></a></li>
        @if (auth()->user()->role=='superadmin')
        <li class="menu-header">User</li>
        <li><a class="nav-link" href="{{ route('employee') }}"><i class="far fa-square"></i> <span>Data Pegawai</span></a></li>
        @endif
    </aside>
  </div>
