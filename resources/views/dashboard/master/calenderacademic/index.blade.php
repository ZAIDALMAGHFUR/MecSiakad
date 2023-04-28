{{-- @extends('layouts.app')
@section('content')
  @pushOnce('css')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  @endPushOnce
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <!-- Bookmark Start-->
            <div class="bookmark">
              <ul>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                  <form class="form-inline search-form">
                    <div class="form-group form-control-search">
                      <input type="text" placeholder="Search..">
                    </div>
                  </form>
                </li>
              </ul>
            </div>
            <!-- Bookmark Ends-->
          </div>
        </div>
      </div>
    </div>
    <div class=" d-flex justify-content-center">
      <div class="container-fluid">
  <!-- Modal -->
  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Booking title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" id="title">
          <span id="titleError" class="text-danger"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">FullCalendar js Laravel series with Career Development Lab</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">

                    <div id="calendar">

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
  @pushOnce('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
      $(document).ready(function() {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          var booking = @json($events);

          $('#calendar').fullCalendar({
              header: {
                  left: 'prev, next today',
                  center: 'title',
                  right: 'month, agendaWeek, agendaDay',
              },
              events: booking,
              selectable: true,
              selectHelper: true,
              select: function(start, end, allDays) {
                  $('#bookingModal').modal('toggle');

                  $('#saveBtn').click(function() {
                      var title = $('#title').val();
                      var start = moment(start).format('YYYY-MM-DD');
                      var end = moment(end).format('YYYY-MM-DD');

                      $.ajax({
                          url:"{{ route('calendar.store') }}",
                          type:"POST",
                          dataType:'json',
                          data:{ title, start, end  },
                          success:function(response)
                          {
                              $('#bookingModal').modal('hide')
                              $('#calendar').fullCalendar('renderEvent', {
                                  'title': response.title,
                                  'start' : response.start,
                                  'end'  : response.end,
                                  'color' : response.color
                              });

                          },
                          error:function(error)
                          {
                              if(error.responseJSON.errors) {
                                  $('#titleError').html(error.responseJSON.errors.title);
                              }
                              console.log(error)
                          },
                      });
                  });
              },
              editable: true,
              eventDrop: function(event) {
                  var id = event.id;
                  var start = moment(event.start).format('YYYY-MM-DD');
                  var end = moment(event.end).format('YYYY-MM-DD');

                  $.ajax({
                          url:"{{ route('calendar.update', '') }}" +'/'+ id,
                          type:"PATCH",
                          dataType:'json',
                          data:{ start, end  },
                          success:function(response)
                          {
                              swal("Good job!", "Event Updated!", "success");
                          },
                          error:function(error)
                          {
                              console.log(error)
                          },
                      });
              },
              eventClick: function(event){
                  var id = event.id;

                  if(confirm('Are you sure want to remove it')){
                      $.ajax({
                          url:"{{ route('calendar.destroy', '') }}" +'/'+ id,
                          type:"DELETE",
                          dataType:'json',
                          success:function(response)
                          {
                              $('#calendar').fullCalendar('removeEvents', response);
                              // swal("Good job!", "Event Deleted!", "success");
                          },
                          error:function(error)
                          {
                              console.log(error)
                          },
                      });
                  }

              },
              selectAllow: function(event)
              {
                  return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
              },



          });


          $("#bookingModal").on("hidden.bs.modal", function () {
              $('#saveBtn').unbind();
          });

          $('.fc-event').css('font-size', '13px');
          $('.fc-event').css('width', '20px');
          $('.fc-event').css('border-radius', '50%');


      });
  </script>

  @endPushOnce
@endsection --}}

@extends('layouts.app')
@section('content')
  @pushOnce('css')
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" />
  @endPushOnce
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>KHS</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data KHS</li>
              <li class="breadcrumb-item active">KHS</li>
            </ol>
          </div>
          <div class="col-sm-6">
            <!-- Bookmark Start-->
            <div class="bookmark">
              <ul>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                  <form class="form-inline search-form">
                    <div class="form-group form-control-search">
                      <input type="text" placeholder="Search..">
                    </div>
                  </form>
                </li>
              </ul>
            </div>
            <!-- Bookmark Ends-->
          </div>
        </div>
      </div>
    </div>
    <div class=" d-flex justify-content-center">
      <div class="container-fluid">
        <div class="container"><p><h1>Calender Academic </h1></p>
            <div class="panel panel-primary">
                <div class="panel-heading">
                       Calender Academic 
                </div>
                <div class="panel-body" >
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
  @pushOnce('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function () {
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                navLinks: true,
                editable: true,
                events: "getevent",           
                displayEventTime: false,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD'); 
                    var end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD'); 
                    $.ajax({ 
                        url: "{{ URL::to('createevent') }}",
                        data: 'title=' + title + '&start=' + start + '&end=' + end +'&_token=' +"{{ csrf_token() }}",
                        type: "post",
                        success: function (data) {
                            alert("Added Successfully");
                            $('#calendar').fullCalendar('refetchEvents');
                        }
                    });
                }
            },
            eventClick: function (event) {
                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) { 
                   $.ajax({
                        type: "POST",
                        url: "{{ URL::to('deleteevent') }}",
                        data: "&id=" + event.id+'&_token=' +"{{ csrf_token() }}",
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                alert("Deleted Successfully");
                            }
                        }
                    });
                }
            }
            });
        });
    </script>


  @endPushOnce
@endsection
