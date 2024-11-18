<?php if(Session::get('user_id')==''){ return redirect('/login'); } ?>
@include('admin.header')
@include('admin.nav')
@include('admin.home')
@include('admin.footer')

