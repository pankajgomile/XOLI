@extends('layouts.main')
@section('main-section')

    <div class="banner-box">
        <h2 class="heading">Welcome {{ Auth::user()->name}}</h2>


        <div class="monika">
            <h3 class="title">Your Feeds</h3>

            <form  action="{{url('feeds-store')}}" class="feed-form"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="feed-form-box border-B">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="Enter title">
                </div>
                    <span class="text-danger">
                      @error('title')
                      {{$message}}
            @enderror </span>
                

                <div class="feed-form-box">
                    <label>Description</label><br>
                    <textarea placeholder=" Add description" name="description" rows="5"></textarea>
                </div>
                    <span class="text-danger">
                      @error('description')
                      {{$message}}
            @enderror
            </span>
               
                <div class="feed-form-box">
                    <label>Add image</label><br>
                    <div class="upload-btn-wrapper">
                        <button class="upload-btn">+ Add Item Photos</button>
                        <input type="file" name="file" id="fileToUpload">
                    </div>
                        <span class="text-danger">
                          @error('file')
                          {{$message}}
                      @enderror
                      </span>
                   
                </div>
                <button type="submit" class="botton">Apply Now</button>
            </form>
        </div>
    </div>

       
@endsection
           
