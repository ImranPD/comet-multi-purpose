<!DOCTYPE html>
<html lang="en">




<head>



     @include('comet.layouts.head')

  </head>

  <body>



    {{--@include('comet.layouts.partials.preloader')--}}



    @include('comet.layouts.header')





    @include('comet.layouts.partials.page-header')




   @section('main-content')
   @show




    @include('comet.layouts.footer')

    @include('comet.layouts.partials.scripts')


  </body>

</html>
