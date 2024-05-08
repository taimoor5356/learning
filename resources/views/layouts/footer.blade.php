<footer class="main-footer">

    @php
    $setting = \App\Models\Setting::where('id', 1)->first();
    @endphp
    <strong>Copyright &copy; 2024 <a href="#">{{$setting->school_name}}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->