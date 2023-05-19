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

            <div class="col-sm-12 col-xl-6">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                  <h5><i data-feather="file-text"></i> Detail Calander</h5>
                  <div class="setting-list">
                    <ul class="list-unstyled setting-option">
                      <li>
                        <div class="setting-primary"><i class="icon-settings"></i></div>
                      </li>
                      <li><i class="view-html fa fa-code font-primary"></i></li>
                      <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                      <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                      <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                      <li><i class="icofont icofont-error close-card font-primary"></i></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <ol>
                    <li style="background: #0000FF; color: aliceblue;">1. Belajar</li>
                    <li class="bg-danger" style="margin-top: 1rem;">2. Libur</li>
                    <li style="background: #0cf95f; color: aliceblue; margin-top: 1rem;">3. Uas</li>
                    <li style="background: #f90cf9; color: aliceblue; margin-top: 1rem;">4. Uts</li>
                  </ol>
                </div>
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
