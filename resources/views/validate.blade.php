
<script>

@if ($errors->any())


        swal('validation error','{{ $errors ->first() }}','warning');



@endif

@if (Session::has('success'))

    swal('success','{{ Session::get('success') }}','warning');


@endif

</script>
