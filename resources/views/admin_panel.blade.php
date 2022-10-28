<!DOCTYPE html>
<html lang="en">
<head>
  
    @include('admin/header', ['titulo' => 'Mantenimientos'])
<style>
  .fill {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden
}
.fill img {
    flex-shrink: 0;
    min-width: 100%;
    min-height: 100%
}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('admin/navbar')

<div class="content-wrapper">
    

    <div id="contenido">
      <div class="fill">
        <img src="{{asset('images/bg.jpg')}}">
      </div>
    </div>

</div>

  @include('admin/footer')

</body>
</html>
