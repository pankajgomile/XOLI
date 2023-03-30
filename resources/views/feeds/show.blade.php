@extends('layouts.main')
@section('main-section')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- jQuery -->


@if(session()->has('Message'))
<div class="alert alert-danger">
    {{ session()->get('Message') }}
</div>
@endif
<div class="main-container">
    <div class="banner-box">
        <h1 class="heading">Welcome {{ Auth::user()->name}}</h1>
        <div class="monika">
            <div class="feeds">
                <h3 class="title">Your Feeds</h3>
                <a href="{{url('/feeds')}}" class="botton"> + Add Post</a>
            </div>
            @foreach($fetchdata as $feed)
            <div class="feeds-box">
                @php $likesCount = $query = DB::table('feedslikes')->select('feeds_id')->where('feeds_id',
                $feed->id)->get()->count();@endphp
                @php $commentCount = $query = DB::table('comment')->select('feeds_id')->where('feeds_id',
                $feed->id)->get()->count();@endphp
                <div class="feeds">
                    <h4>{{$feed->getData->email}}</h4>
                    <p>{{$feed->created_at->diffForHumans()}}</p>
                </div>
                <h3 class="sub-heading">{{$feed->title}}</h3>
                <p class="text" clsss="content" class="ontent">{{$feed->description}}

                    <button class="show_hide" data-content="toggle-text">Read More</button>
                </p>

                <a href="{{url('/feeds-details/'.$feed->id)}}"><img class="img"
                        src="{{ asset('feedsimage/'.$feed->file) }}"></a>

                <div class="container-fluid p-0">
                    <div class="row pt-2">
                        <div class="col-md-4">
                            <div class="like-box">
                                <i class="fa fa-thumbs-up like" id="button1" aria-hidden="true"
                                    onclick="ajaxCall({{$feed->id}})"></i>
                                <div class="like-box">

                                    <p><b><span id="like_<?= $feed->id; ?>">{{$likesCount}}</span>&nbsp;</b> Like</p>
                                </div>
                                {{-- <button type="button" class="btn-secondary"></button> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="like-box">
                                <i class="fa fa-commenting" aria-hidden="true"></i>
                                <p><b>{{$commentCount}}</b> Comments</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="dropdown">
                                <div class="like-box">
                                    <i class="fa fa-share share" onclick="myFunction()" aria-hidden="true"></i>
                                    <p><b></b>Share</p>
                                </div>

                                {{-- <button class="dropbtn">share</button> --}}
                                <div id="myDropdown" class="dropdown-content d-none">
                                    <a href="https://www.facebook.com/sharer/sharer.php?{{url('/feeds-details/'.$feed->id)}}"
                                        target="_blank">facebook</a><br>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?{{url('/feeds-details/'.$feed->id)}}"
                                        target="_blank">Linkedin</a><br>
                                    <a href="https://twitter.com/share?{{url('/feeds-details/'.$feed->id)}}"
                                        target="_blank">twitter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="robert">
                    <p class="read-more" style="text-align: start;">2coment</p>
                    <div id="showComments_{{$feed->id}}"></div>
                    {{-- @forelse ($feed->comment as $item)


                    {{-- <div class="feeds">
                        <h4>{{$item->users->name}}</h4>
                        <p>{{$item->created_at->diffForHumans()}}</p>
                    </div> --}}

                    {{-- <p class="text{{$feed->id}}">{{$item->comment}}</p> --}}


                    {{-- <div>
                        @empty
                        <h6>no comment </h6>

                        @endforelse --}}


                        {{-- <input type="hidden" name="feeds_id" id="feed_id" value="{{$feed->id}}"> --}}
                        {{-- <div class="feed-form-box border-B">
                            <label>comment</label>
                            <input type="text" name="comment" id="comments{{$feed->id}}" placeholder="comment here">
                        </div> --}}
                        <input type="hidden" name="feed" id="feedid_{{$feed->id}}" value="{{$feed->id}}" />
                        <input type="hidden" name="commentId" id="commentId_{{$feed->id}}" value="0" />

                        <div class="form-group">
                            <textarea name="comment" id="comment_{{$feed->id}}" class="form-control"
                                placeholder="Enter Comment" rows="5" required></textarea>
                        </div>
                        <span class="text-danger">
                            @error('comment')
                            {{$message}}
                            @enderror </span>
                        <button name="submit" onclick="ajaxsubmit({{$feed->id}})" class="btn btn-primary"
                            value="Post Comment">Comment</button>

                        {{-- <button id="submitButton" UniqueID="{{$feed->id}}" class="botton">leave comment</button>
                        --}}
                    </div>
                    {{-- <i class="fa fa-play play" aria-hidden="true"></i>
                </div> --}}
            </div>
            @endforeach
            <div class="previous-next-btn">
                @if(isset($fetchdata))
                @if($fetchdata->currentPage() > 1)
                <a class="next" href="{{ $fetchdata->previousPageUrl() }}">Previous</a>
                @endif

                @if($fetchdata->hasMorePages())
                <a class="next" href="{{ $fetchdata->nextPageUrl() }}">Next</a>
                @endif
                @endif
            </div>
        </div>

    </div>
</div>
<script>
    function ajaxCall(id) {
        $.ajax({
            type: 'post',
            url: "{{ url('like') }}",
            dataType: 'json',
            data: { id: id, _token: "{{csrf_token()}}" },
            success: function (response) {
                $('#like_' + id).html(response);
            }
        });
    }

</script>

<script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
        //document.getElementById("myDropdown").toggleClass("show");
        $('#myDropdown').toggleClass("d-none");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function (event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

{{-- this is for read more act --}}
<script>
    $(document).ready(function () {
        $(".content").hide();
        $(".show_hide").on("click", function () {
            var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
            $(".show_hide").text(txt);
            $(this).next('.content').slideToggle(20);
        });
    });
</script>
<script>
    // $(document).ready(function () {
    //     $('.botton').click(function () {
    //         var Feedid = $(this).attr("UniqueID");
    //         var comment = $('#comments' + Feedid).val();

    //         // alert(Feedid);

    //         $.ajax({
    //             url: "{{ url('comment-store') }}",
    //             method: "POST",
    //             data: {
    //                 id: Feedid,
    //                 comment: comment,
    //                 _token: "{{csrf_token()}}"
    //             },
    //             dataType: "json",
    //             success: function (data) {
    //                 alert('success');
    //                 $('.text' + Feedid).html(data);
    //             }
    //         });
    //     });
    // });


    function ajaxsubmit(id) {
        var feedid = $('#feedid_' + id).val();
        var comment = $('#comment_' + id).val();
        var commentId = $('#commentId_' + id).val();
        var name = $('#name_' + id).val();
        $.ajax({
            url: "{{ url('comment-store') }}",
            method: "POST",
            data: {
                id: feedid, comment: comment, parent_id: commentId,
                name: name, _token: "{{csrf_token()}}"
            },
            dataType: "JSON",
            success: function (response) {
                if (!response.error) {
                    $('#commentId_' + id).val('0');
                    $('#comment_' + id).val('');
                    showComments(feedid, commentId);
                } else if (response.error) {
                    $('#message').html(response.message);
                }
            }
        })
    }

    $(document).on('click', '.reply', function () {

        var commentId = $(this).attr("id");
        var feedId = $(this).attr("data-feed");
        $('#commentId_' + feedId).val(commentId);
        $('#comment_' + feedId).focus();
    });

    function showComments(feedid, parent_id) {
        $.ajax({
            url: "{{ url('comment-store') }}",
            method: "POST",
            data: { id: feedid, parent_id: parent_id, reply: 1, _token: "{{csrf_token()}}" },
            //dataType: "JSON",
            success: function (response) {

                // console.log(response);
                $('#showComments_' + feedid).html(response);
            }
        })
    }
</script>
@endsection