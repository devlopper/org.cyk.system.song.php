@extends('layouts.page.up_right_bottom_left')

@section('head')
  <script>
    $(document).ready(function() {
      var table = $('#{{ $table->identifier }}').DataTable( {
        dom: 'Bfrtip',
        "processing": true
        ,"serverSide": true
        ,"ajax": "song/get/many"
        ,"language": {
          "lengthMenu": 'Display <select>'+
            '<option value="3">3</option>'+
            '<option value="5">5</option>'+
            '<option value="10">10</option>'+
            '<option value="30">30</option>'+
            '<option value="40">40</option>'+
            '<option value="50">50</option>'+
            '</select> records'
        }
        ,"pageLength": 3
        ,buttons: {
        buttons: [
            {
                text: 'Ajouter',
                action: function ( dt ) {
                     window.location.href = '{{ route('showSongCreatePage') }}'
                     //$('#myModal').modal('show');
                }
            }
          ]
        }
        ,select: 'single'     // enable single row selection
        ,responsive: true     // enable responsiveness

      });
    });
  </script>
@endsection

@section('content')
  @include('layouts/collection/table', ['table' => $table])
@endsection
